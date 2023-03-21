<?php

namespace models;

use service\Exception\InvalidArgumentException;

class User extends BaseModel
{
    protected string $username;

    protected string $email;

    protected string $passwordHash;

    protected string $icon;

    protected $createdDt;

    protected string $authToken;


    public function getAuthToken()
    {
        return $this->authToken;
    }

    public function setAuthToken($authToken): void
    {
        $this->authToken = $authToken;
    }

    public function getPasswordHash()
    {
        return $this->passwordHash;
    }

    public function setPasswordHash($passwordHash): void
    {
        $this->passwordHash = $passwordHash;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon($icon): void
    {
        $this->icon = $icon;
    }

    public function getCreatedDt()
    {
        return $this->createdDt;
    }

    public function setCreatedDt($createdDt): void
    {
        $this->createdDt = $createdDt;
    }

    public static function getTableName(): string
    {
        return 'users';
    }

    /**
     * @throws InvalidArgumentException
     */
    public static function signUp(array $userData, array $userIcon = []): User
    {
        if (empty($userData['username'])) {
            throw new InvalidArgumentException('Empty username');
        }

        if (mb_strlen($userData['username']) < 5) {
            throw new InvalidArgumentException('The username must be at least 5 characters');
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $userData['username'])) {
            throw new InvalidArgumentException('Username can consist only of Latin alphabet characters and numbers');
        }

        if (static::findByColumn('username', $userData['username']) !== null) {
            throw new InvalidArgumentException('User with this username already exists');
        }

        if (empty($userData['email'])) {
            throw new InvalidArgumentException('Empty email');
        }

        if (static::findByColumn('email', $userData['email']) !== null) {
            throw new InvalidArgumentException('User with this email already exists');
        }

        if (empty($userData['password'])) {
            throw new InvalidArgumentException('Empty password');
        }

        if (mb_strlen($userData['password']) < 5) {
            throw new InvalidArgumentException('The password must be at least 5 characters');
        }

        if ($userData['password'] != $userData['repeat_password']) {
            throw new InvalidArgumentException('Password mismatch');
        }

        if ($userIcon['name'] != '') {
            if ($userIcon['size'] == 0) {
                throw new InvalidArgumentException('File size exceeded, image not uploaded');
            }
        }

        $user = new User();
        $user->username = $userData['username'];
        $user->email = $userData['email'];
        $user->passwordHash = password_hash($userData['password'], PASSWORD_DEFAULT);
        $iconName = '';

        if ($userIcon['name'] != '') {
            $iconName = uniqid();
            copy($userIcon['tmp_name'], 'res/photo/' . $iconName);
        }

        $user->icon = $iconName;
        $user->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));

        $user->save();

        return $user;
    }

    /**
     * @throws InvalidArgumentException
     */
    public static function login(array $loginData): User
    {
        if (empty($loginData['email'])) {
            throw new InvalidArgumentException("Empty email");
        }

        if (empty($loginData['password'])) {
            throw new InvalidArgumentException("Empty password");
        }

        $user = User::findOneByColumn('email', $loginData['email']);
        if ($user === null) {
            throw new InvalidArgumentException("User with this email does not exist");
        }

        if (!password_verify($loginData['password'], $user->getPasswordHash())) {
            throw new InvalidArgumentException('Incorrect password');
        }

        $user->refreshAuthToken();
        $user->save();

        return $user;
    }

    private function refreshAuthToken()
    {
        $this->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
    }
}

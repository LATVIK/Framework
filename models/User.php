<?php

namespace models;

use service\Exception\InvalidArgumentException;
use service\Exception\UnknownException;

class User extends BaseModel
{
    protected string $username;

    protected string $email;

    protected string $passwordHash;

    protected ?string $icon;

    protected ?string $createdDt = null;

    protected ?string $authToken;


    public function getAuthToken(): ?string
    {
        return $this->authToken;
    }

    private function setAuthToken($authToken): void
    {
        $this->authToken = $authToken;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setPasswordHash($passwordHash): void
    {
        if (!$passwordHash) {
            throw new InvalidArgumentException('Empty password');
        }

        if (mb_strlen($passwordHash) < 5) {
            throw new InvalidArgumentException('The password must be at least 5 characters');
        }

        $this->passwordHash = password_hash($passwordHash, PASSWORD_DEFAULT);
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setUsername(?string $username): void
    {
        if (!$username) {
            throw new InvalidArgumentException('Empty username');
        }

        if (mb_strlen($username) < 5) {
            throw new InvalidArgumentException('The username must be at least 5 characters');
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
            throw new InvalidArgumentException('Username can consist only of Latin alphabet characters and numbers');
        }

        if (static::findByColumn('username', $username) !== null) {
            throw new InvalidArgumentException('User with this username already exists');
        }

        $this->username = $username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setEmail(?string $email): void
    {
        if (!$email) {
            throw new InvalidArgumentException('Empty email');
        }

        if (static::findByColumn('email', $email) !== null) {
            throw new InvalidArgumentException('User with this email already exists');
        }

        $this->email = $email;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setIcon(array $icon): void
    {
        $iconName = '';
        if ($icon['name'] != '') {
            if ($icon['size'] == 0) {
                throw new InvalidArgumentException('File size exceeded, image not uploaded');
            }
            $iconName = uniqid();
            copy($icon['tmp_name'], 'res/photo/' . $iconName);
        }

        $this->icon = $iconName;
    }

    public function getCreatedDt(): ?string
    {
        return $this->createdDt;
    }

    public static function getTableName(): string
    {
        return 'users';
    }

    /**
     * @throws InvalidArgumentException
     * @throws UnknownException
     */
    public static function signUp(array $userData, array $userIcon = []): User
    {
        if ($userData['password'] != $userData['repeat_password']) {
            throw new InvalidArgumentException('Password mismatch');
        }

        $user = new User();
        $user->setUsername($userData['username']);
        $user->setEmail($userData['email']);
        $user->setPasswordHash($userData['password']);

        try {
            $user->setIcon($userIcon);
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException($e->getMessage());
        } finally {
            $user->refreshAuthToken();

            $user->save();

            return $user;
        }
    }

    /**
     * @throws InvalidArgumentException
     * @throws UnknownException
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

    /**
     * @throws UnknownException
     */
    private function refreshAuthToken(): void
    {
        try {
            $this->setAuthToken(sha1(random_bytes(100)) . sha1(random_bytes(100)));
        } catch (\Exception $e) {
            throw new UnknownException($e->getMessage());
        }
    }
}

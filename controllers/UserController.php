<?php

namespace controllers;

use models\User;
use service\Exception\InvalidArgumentException;
use service\UsersAuthService;

class UserController extends BaseController
{
    public function signUpAction()
    {
        if (!empty($_POST)) {
            $user = null;

            try {
                //$user with empty id
                $user = User::signUp($_POST, $_FILES['icon']);
                //Get filled user
                $user = User::findOneByColumn('username', $user->getUsername());
                UsersAuthService::createToken($user);
            } catch (InvalidArgumentException $exception) {
                $error = $exception->getMessage();
            }
            if ($user instanceof User) {
                header('Location: /profile');
            }
        }

        include "views/sign_up.php";
    }

    public function loginAction()
    {
        if (!empty($_POST)) {
            try {
                $user = User::login($_POST);
                UsersAuthService::createToken($user);
                header('Location: /');
            } catch (InvalidArgumentException $e) {
                $error = $e->getMessage();
            }
        }
        include 'views/login.php';
    }

    public function profileAction()
    {
        if (isset($_GET['search'])) {
            header('Location: /?search=' . $_GET['search']);
        }
        $this->checkAuthorization();

        include "views/profile.php";
    }

    public function exitAction(): void
    {
        UsersAuthService::deleteToken();
        header('Location: /login');
    }
}

<?php

namespace controllers;

use models\User;
use service\Exception\InvalidArgumentException;

class UserController extends BaseController
{
    public function signUpAction()
    {
        if (!empty($_POST)) {
            $user = null;

            try {
                $user = User::signUp($_POST, $_FILES['icon']);
            } catch (InvalidArgumentException $exception) {
                $error = $exception->getMessage();
            }
            if ($user instanceof User) {
                $success = 'Account registered successfully';
                include "views/sign_up.php";
                return;
                //TODO: change to profile (this->indexAction(){... include "...profile.php" ...}
            }
        }

        include "views/sign_up.php";
    }
}

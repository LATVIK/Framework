<?php

namespace controllers;

class ProfileController extends BaseController
{
    public function indexAction()
    {
        $user = [
            'username' => 'Ivan',
            'email' => 'myemail@ggg.com',
        ];
        include "views/profile.php";
    }
}
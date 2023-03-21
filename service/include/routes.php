<?php
return [
    '' => [\controllers\Controller::class, 'indexAction'],
    'profile' => [\controllers\ProfileController::class, 'indexAction'],
    'my-posts' => [\controllers\MyPostController::class, 'myPostsAction'],
    'login' => [\controllers\UserController::class, 'loginAction'],
    'sign-up' => [\controllers\UserController::class, 'signUpAction'],

];

<?php
return [
    '' => [\controllers\PostController::class, 'indexAction'],
    'my-posts' => [\controllers\PostController::class, 'myPostsAction'],
    'sign-up' => [\controllers\UserController::class, 'signUpAction'],
    'login' => [\controllers\UserController::class, 'loginAction'],
    'profile' => [\controllers\UserController::class, 'profileAction'],

];

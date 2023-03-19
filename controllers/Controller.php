<?php

namespace controllers;

use models\Post;

class Controller extends BaseController
{
    public function indexAction(array $param)
    {
        $posts = Post::findAll();
        include 'views/posts.php';
    }
}

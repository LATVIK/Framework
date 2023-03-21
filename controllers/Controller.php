<?php

namespace controllers;

use models\Post;

class Controller extends BaseController
{
    public function indexAction()
    {
        $posts = Post::findAll();
        include 'views/posts.php';
    }
}

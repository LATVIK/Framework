<?php

namespace controllers;

use models\Post;

class PostController extends BaseController
{
    public function indexAction()
    {
        $posts = Post::findAll();
        include 'views/posts.php';
    }

    public function myPostsAction()
    {
        $posts = Post::findByAuthor($this->user->getId());
        if (is_array($posts)) {
            include 'views/posts.php';
        }
    }
}

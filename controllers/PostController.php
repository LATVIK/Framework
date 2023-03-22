<?php

namespace controllers;

use models\Post;

class PostController extends BaseController
{
    public function indexAction()
    {
        $posts = Post::findAll($_GET['search'] ?? '');
        $this->displayPosts($posts);
    }

    public function myPostsAction()
    {
        $this->checkAuthorization();
        $this->displayCreatePostForm();
        $posts = Post::findByAuthor($this->user->getId(), $_GET['search'] ?? '');
        $this->displayPosts($posts);
    }

    private function displayPosts(?array $posts)
    {
        if ($posts) {
            include 'views/posts.php';
        } else {
            echo '<h2>Posts no found</h2>';
        }
    }

    private function displayCreatePostForm()
    {
        include 'views/create_post_form.php';
    }
}

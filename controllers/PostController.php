<?php

namespace controllers;

use models\Post;
use service\Exception\InvalidArgumentException;

class PostController extends BaseController
{
    public function indexAction()
    {
        $posts = Post::findAll($_GET['search'] ?? '');
        $this->displayPosts($posts);
    }

    public function myPostsAction()
    {
        $error = '';

        $this->checkAuthorization();
        if (!empty($_POST)) {
            try {
                $this->sendPost($_POST);
            } catch (InvalidArgumentException $e) {
                $error = $e->getMessage();
            }
        }
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


    /**
     * @throws InvalidArgumentException
     */
    private function sendPost(?array $data)
    {
        if (empty($data['title'])) {
            throw new InvalidArgumentException('Empty title');
        }
        if (empty($data['text'])) {
            throw new InvalidArgumentException('Empty text');
        }

        $post = new Post();
        $post->setTitle($data['title']);
        $post->setText($data['text']);
        $post->setAuthorId($this->user->getId());
        $post->save();
    }
}

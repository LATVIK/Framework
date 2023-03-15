<?php

namespace controllers;

class MyPostController extends BaseController
{
    public function indexAction()
    {
//         change to Post::findByAuthorId()... or call a procedure from DB.
//        $posts = Database::getInstance()->query(
//            "SELECT * FROM posts WHERE posts.author_id= :authorId",
//            [':authorId' => $param['authorId']],
//            Post::class
//        );
        include 'views/posts.php';
    }

    public function editAction(){

    }
}

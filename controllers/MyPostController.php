<?php

namespace controllers;

class MyPostController extends BaseController
{
    public function indexAction()
    {
        include "service/include/tmp_post_data.php";
        include 'views/posts.php';
    }
}

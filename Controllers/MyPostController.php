<?php

namespace Controllers;

class MyPostController extends BaseController
{
    public function indexAction()
    {
        include "tmp_post_data.php";
        include 'views/posts.php';
    }
}

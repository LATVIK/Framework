<?php

namespace controllers;

class Controller extends BaseController
{
    public function indexAction(array $param)
    {
        include "tmp_post_data.php";

        include 'views/posts.php';
    }
}

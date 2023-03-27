<?php

namespace controllers;

use models\User;
use service\UsersAuthService;

abstract class BaseController
{
    protected ?User $user;

    public function __construct(User $user = null)
    {
        if (!$user) {
            $this->user = UsersAuthService::getUserByToken();
        } else {
            $this->user = $user;
        }
    }

    public function getUnknownPage(): void
    {
        http_response_code(404);
        include 'views/unknown_page.php';
    }

    protected function checkAuthorization(): void
    {
        if (!$this->user) {
            header('Location: /login');
        }
    }
}

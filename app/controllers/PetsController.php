<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;
use app\core\AuthHelper;
use app\core\RedirectHelper;
use app\core\RequestHelper;

class PetsController extends Controller
{
    public function new(): void
    {
        if (!AuthHelper::isUserLoggedIn()) {
            RedirectHelper::redirectToLogin();
        }

        $this->view('pets/new');
    }

    public function create(): void 
    {
        if (!AuthHelper::isUserLoggedIn()) {
            RedirectHelper::redirectToLogin();
        }

        if (!RequestHelper::isPostRequest()) {
            RedirectHelper::redirectToHome();
        }


        dd($_POST);

        RedirectHelper::redirectToHome();
    }
}

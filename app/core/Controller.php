<?php 
namespace app\core;

class Controller
{
    protected function view(string $view, array $viewData = []): void {
        extract($viewData);

        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        
        if (!file_exists($viewFile)) {
            throw new \Exception("View file not found: " . $viewFile);
        }

        require_once $viewFile;
    }

    protected function ensureAuthenticated(): void
    {
        if (!AuthHelper::isUserLoggedIn()) {
            RedirectHelper::redirectToLogin();
        }
    }

    protected function redirectIfAuthenticated(): void
    {
        if (AuthHelper::isUserLoggedIn()) {
            RedirectHelper::redirectToHome();
        }
    }

    protected function ensurePostRequest(?callable $redirectCallback = null): void
    {
        if (!RequestHelper::isPostRequest()) {
            if ($redirectCallback !== null) {
                $redirectCallback();
            }
            throw new \Exception('Invalid request method');
        }
    }
}
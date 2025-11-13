<?php
declare(strict_types=1);

require_once '../app/core/Controller.php';

class HttpErrorController extends Controller
{
    public function notFound(): void
    {
        http_response_code(404);
        $this->view('errors/404');
    }

    public function internalServerError(): void
    {
        http_response_code(500);
        $this->view('errors/500');
    }

    public function forbidden(): void
    {
        http_response_code(403);
        $this->view('errors/403');
    }
}

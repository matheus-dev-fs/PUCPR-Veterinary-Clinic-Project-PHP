<?php
declare(strict_types=1);

namespace app\controllers\errors;

use app\core\Controller;

class HttpErrorController extends Controller
{
    public function notFound(): void
    {
        http_response_code(404);
        $this->view('errors/404', [
            'view' => 'errors/404'
        ]);
    }

    public function internalServerError(): void
    {
        http_response_code(500);
        $this->view('errors/500', [
            'view' => 'errors/500'
        ]);
    }

    public function forbidden(): void
    {
        http_response_code(403);
        $this->view('errors/403', [
            'view' => 'errors/403'
        ]);
    }
}

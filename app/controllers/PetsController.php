<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;
use app\core\AuthHelper;
use app\core\RedirectHelper;
use app\core\RequestHelper;
use app\services\PetService;
use app\mappers\PetMapper;
use app\dtos\CreatePetDTO;

class PetsController extends Controller
{
    private PetService $petService;
    private PetMapper $petMapper;

    public function __construct()
    {
        $this->petService = new PetService();
        $this->petMapper = new PetMapper();
    }

    public function index(): void
    {
        if (!AuthHelper::isUserLoggedIn()) {
            RedirectHelper::redirectToLogin();
        }

        $this->view('pets/index');
    }

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

        $createPetDTO = $this->getCreatePetDTO();
        $petResponseResult = $this->petService->save($createPetDTO);

        if (!$petResponseResult->isSuccess()) {
            $this->view('pets/new', [
                'errors' => $petResponseResult->getErrors(),
                'old' => $_POST
            ]);
            return;
        }

        RedirectHelper::redirectToHome();
    }

    private function getCreatePetDTO(): CreatePetDTO
    {
        return $this->petMapper->toCreatePetDTO(
            AuthHelper::getUserLoggedId(),
            $_POST['name'],
            $_POST['type'],
            $_POST['gender'],
        );
    }
}

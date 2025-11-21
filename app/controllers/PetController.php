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
use app\dtos\UpdatePetDTO;

class PetController extends Controller
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

        $pets = $this->petService->getAllByUserId(AuthHelper::getUserLoggedId());

        $this->view('pet/index', [
            'pets' => $pets ?? [],
            'view' => 'pet/index'
        ]);
    }

    public function new(): void
    {
        if (!AuthHelper::isUserLoggedIn()) {
            RedirectHelper::redirectToLogin();
        }

        $this->view('pet/new', [
            'errors' => [],
            'old' => [],
            'view' => 'pet/new'
        ]);
    }

    public function create(): void
    {
        if (!AuthHelper::isUserLoggedIn()) {
            RedirectHelper::redirectToLogin();
        }

        if (!RequestHelper::isPostRequest()) {
            RedirectHelper::redirectToPets();
        }

        $createPetDTO = $this->getCreatePetDTO();
        $petResponseResult = $this->petService->save($createPetDTO);

        if (!$petResponseResult->isSuccess()) {
            $this->view('pet/new', [
                'errors' => $petResponseResult->getErrors(),
                'old' => $_POST,
                'view' => 'pet/new'
            ]);
            return;
        }

        RedirectHelper::redirectToPets();
    }

    public function delete(): void {
        if (!AuthHelper::isUserLoggedIn()) {
            RedirectHelper::redirectToLogin();
        }

        if (!RequestHelper::isPostRequest()) {
            RedirectHelper::redirectToPets();
        }

        $deleteMapDTO = $this->petMapper->toDeletePetDTO(
            (string) AuthHelper::getUserLoggedId(),
            $_POST['pet-id']
        );

        $petResponseResult = $this->petService->delete($deleteMapDTO);

        if (!$petResponseResult->isSuccess()) {
            $errors = $petResponseResult->getErrors();

            if (isset($errors['pet_not_found'])) {
                RedirectHelper::redirectToPets();
            } else if (isset($errors['unauthorized'])) {
                RedirectHelper::redirectTo403();
            } else {
                RedirectHelper::redirectToPets();
            }
        }

        RedirectHelper::redirectToPets();
    }

    public function edit(?int $petId): void
    {
        if (!AuthHelper::isUserLoggedIn()) {
            RedirectHelper::redirectToLogin();
        }

        if ($petId === null || !\is_numeric($petId)) {
            RedirectHelper::redirectToPets();
        }

        $petResponseResult = $this->petService->getPetId($petId);

        if (!$petResponseResult->isSuccess()) {
            $errors = $petResponseResult->getErrors();

            if (isset($errors['pet_not_found'])) {
                RedirectHelper::redirectToPets();
            } else if (isset($errors['unauthorized'])) {
                RedirectHelper::redirectTo403();
            } else {
                RedirectHelper::redirectToPets();
            }
        }

        $this->view('pet/edit', [
            'pet' => $petResponseResult->getPet(),
            'errors' => [],
            'old' => [],
            'view' => 'pet/edit'
        ]);
    }

    public function update(): void {
        if (!AuthHelper::isUserLoggedIn()) {
            RedirectHelper::redirectToLogin();
        }

        if (!RequestHelper::isPostRequest()) {
            RedirectHelper::redirectToPets();
        }

        $updatePetDTO = $this->getUpdatePetDTO();
        $petResponseResult = $this->petService->update($updatePetDTO);

        if (!$petResponseResult->isSuccess()) {
            $errors = $petResponseResult->getErrors();

            if (isset($errors['pet_not_found'])) {
                RedirectHelper::redirectToPets();
            } else if (isset($errors['unauthorized'])) {
                RedirectHelper::redirectTo403();
            } else {
                $this->view('pet/edit', [
                    'pet' => $updatePetDTO,
                    'errors' => $errors,
                    'old' => $_POST,
                    'view' => 'pet/edit'
                ]);
                return;
            }
        }

        RedirectHelper::redirectToPets();
    }

    private function getCreatePetDTO(): CreatePetDTO
    {
        return $this->petMapper->toCreatePetDTO(
            AuthHelper::getUserLoggedId(),
            $_POST['name'] ?? null,
            $_POST['type'] ?? null,
            $_POST['gender'] ?? null
        );
    }

    private function getUpdatePetDTO(): UpdatePetDTO
    {
        return $this->petMapper->toUpdatePetDTO(
            $_POST['id'] ?? null,
            $_POST['name'] ?? null,
            $_POST['type'] ?? null,
            $_POST['gender'] ?? null
        );
    }
}
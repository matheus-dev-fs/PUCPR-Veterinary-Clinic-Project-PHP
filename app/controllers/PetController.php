<?php

declare(strict_types=1);

namespace app\controllers;

use app\core\Controller;
use app\core\AuthHelper;
use app\core\RedirectHelper;
use app\services\PetService;
use app\mappers\PetMapper;
use app\responses\PetResponseResult;

class PetController extends Controller
{
    private PetService $petService;

    public function __construct()
    {
        $this->petService = new PetService();
    }

    public function index($errors = []): void
    {
        $this->ensureAuthenticated();

        $pets = $this->petService->getAllByUserId(AuthHelper::getUserLoggedId());

        $this->view('pet/index', [
            'pets' => $pets,
            'errors' => $errors,
            'view' => 'pet/index'
        ]);
    }

    public function new(): void
    {
        $this->ensureAuthenticated();

        $this->view('pet/new', [
            'errors' => [],
            'old' => [],
            'view' => 'pet/new'
        ]);
    }

    public function create(): void
    {
        $this->ensureAuthenticated();
        $this->ensurePostRequest(RedirectHelper::redirectToPets(...));

        if (!AuthHelper::validateCsrfToken()) {
            RedirectHelper::redirectTo403();
            return;
        }

        $createPetDTO = PetMapper::toCreatePetDTO(
            AuthHelper::getUserLoggedId(),
            $_POST['name'] ?? null,
            $_POST['type'] ?? null,
            $_POST['gender'] ?? null
        );

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

    public function edit(?int $petId): void
    {
        $this->ensureAuthenticated();

        if ($petId === null) {
            RedirectHelper::redirectToPets();
        }

        $petResponseResult = $this->petService->getPetById($petId);
        $this->handlePetResponseErrors($petResponseResult);

        $this->view('pet/edit', [
            'pet' => $petResponseResult->getPet(),
            'errors' => [],
            'old' => [],
            'view' => 'pet/edit'
        ]);
    }

    public function update(): void
    {
        $this->ensureAuthenticated();
        $this->ensurePostRequest(RedirectHelper::redirectToPets(...));

        if (!AuthHelper::validateCsrfToken()) {
            RedirectHelper::redirectTo403();
            return;
        }

        $updatePetDTO = PetMapper::toUpdatePetDTO(
            $_POST['id'] ?? null,
            $_POST['name'] ?? null,
            $_POST['type'] ?? null,
            $_POST['gender'] ?? null
        );

        $petResponseResult = $this->petService->update($updatePetDTO);

        if (!$petResponseResult->isSuccess()) {
            $errors = $petResponseResult->getErrors();

            if ($this->shouldRedirectOnError($errors)) {
                $this->handlePetResponseErrors($petResponseResult);
            }

            $pet = $this->petService->getPetById($updatePetDTO->getId());
            
            $this->view('pet/edit', [
                'pet' => $pet->getPet(),
                'errors' => $errors,
                'old' => $_POST,
                'view' => 'pet/edit'
            ]);
            return;
        }

        RedirectHelper::redirectToPets();
    }

    public function delete(): void
    {
        $this->ensureAuthenticated();
        $this->ensurePostRequest(RedirectHelper::redirectToPets(...));

        if (!AuthHelper::validateCsrfToken()) {
            RedirectHelper::redirectTo403();
            return;
        }

        $deletePetDTO = PetMapper::toDeletePetDTO(
            (string) AuthHelper::getUserLoggedId(),
            $_POST['pet-id'] ?? null
        );

        $petResponseResult = $this->petService->delete($deletePetDTO);
        $this->handlePetResponseErrors($petResponseResult);

        RedirectHelper::redirectToPets();
    }

    private function handlePetResponseErrors(PetResponseResult $result): void
    {
        if ($result->isSuccess()) {
            return;
        }

        $errors = $result->getErrors();

        if (isset($errors['pet_not_found'])) {
            RedirectHelper::redirectToPets();
        }

        if (isset($errors['unauthorized'])) {
            RedirectHelper::redirectTo403();
        }

        if (isset($errors['pet_has_appointments'])) {
            RedirectHelper::redirectToPets($errors);
        }

        if (isset($errors['deletion_failed'])) {
            RedirectHelper::redirectToPets();
        }
    }

    private function shouldRedirectOnError(array $errors): bool
    {
        return isset($errors['pet_not_found']) || 
               isset($errors['unauthorized']) || 
               isset($errors['deletion_failed']);
    }
}
<?php

namespace App\Http\Services;

use App\Http\Repositories\InstructionRepository;

class InstructionService
{
    private InstructionRepository $instructionRepository;

    public function __construct()
    {
        $this->instructionRepository = new InstructionRepository();
    }

    public function getInstructions()
    {
        return $this->instructionRepository->getAll();
    }

    public function getById(String $id)
    {
        $instruction = $this->instructionRepository->getById($id);
        return $instruction;
    }

    public function delete(String $id)
    {
        $instruction = $this->instructionRepository->delete($id);
        return $instruction;

    }
}
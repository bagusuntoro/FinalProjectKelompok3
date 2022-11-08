<?php

namespace App\Http\Repositories;

use App\Helpers\MongoModel;

class InstructionRepository
{
    private MongoModel $instructions;

    public function __construct()
    {
        $this->instructionModel = new MongoModel('instruction');
    }

    public function getAll()
    {
        $instructions = $this->instructionModel->get([]);
        return $instructions;
    }

    public function getById(String $id)
    {
        $instruction = $this->instructionModel->get(['_id' => $id]);
        return $instruction;
    }

    public function delete(String $id)
    {
        $instruction = $this->instructionModel->deleteQuery(['_id' => $id]);
        return $instruction;
    }
}

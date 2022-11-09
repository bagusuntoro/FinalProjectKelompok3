<?php

namespace App\Http\Repositories;

use App\Helpers\MongoModel;
use App\Models\Instruction;
use App\Models\NotesByInternals;

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

    //untuk menyimpan data Instruction
    public function create($data)
    {
        $newData = [
            'instruction_id' => $data['instruction_id'],
            'link_to' => $data['link_to'],
            'instruction_type' => $data['instruction_type'],
            'assigned_vendor' => $data['assigned_vendor'],
            'attention_of' => $data['attention_of'],
            'quotation_no' => $data['quotation_no'],
            'customer_po' => $data['customer_po'],
            'status' => 'On Progress',
            'cost_detail' => $data['detail_cost'],
            'attachment' => null,
            'note' => $data['note'],
            'link_to' => $data['link_to'],
            'vendor_invoice' => [],
        ];

        if ($data['attachment'] !== null) {
            $attachment = "atch-" . time() . '.' . $data['attachment']->extension();
            $data['attachment']->move(public_path('attachment'), $attachment);
            $newData["attachment"] = $attachment;
        }

        $history = [
            'instruction_id' => $data['instruction_id'],
            'history_data' => [
                'action' => 'Created',
                'by_user' => $data['user'],
                'notes' => '',
                'attachment' => '',
            ]
        ];

		$id = $this->instructionModel->save($newData);
        NotesByInternals::create($history);
        return $id;
    }
}

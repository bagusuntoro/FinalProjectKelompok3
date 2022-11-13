<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Instruction;
use App\Models\NotesByInternals;
use App\Models\User;
use Illuminate\Http\Request;

class InstructionController extends Controller
{
    public function showAll()
    {
        $instructionsModel = new Instruction();
        $instructions = $instructionsModel->get();

        return response()->json($instructions);
    }

    public function storeData(Request $request)
    {
        $request->validate([
            'instruction_id' => 'required',
            'link_to' => 'required',
            'instruction_type' => 'required',
            'assigned_vendor' => 'required',
            'attention_of' => 'required',
            'quotation_no' => 'required',
            'customer_po' => 'required',
            'attachment' => 'required',
            'note' => 'required',
            'link_to' => 'required',
        ]);

        $detail_cost = [
            'description' => $request['description'],
            'qty' => $request['qty'],
            'uom' => $request['uom'],
            'unit_price' => $request['unit_price'],
            'gst_vat' => $request['gst_vat'],
            'currency' => $request['currency'],
            'total' => $request['total'],
            'charge_to' => $request['charge_to'],
        ];

        $data = [
            'instruction_id' => $request['instruction_id'],
            'link_to' => $request['link_to'],
            'instruction_type' => $request['instruction_type'],
            'assigned_vendor' => $request['assigned_vendor'],
            'attention_of' => $request['attention_of'],
            'quotation_no' => $request['quotation_no'],
            'customer_po' => $request['customer_po'],
            'status' => 'On Progress',
            'cost_detail' => $detail_cost,
            'attachment' => $request['attachment'],
            'note' => $request['note'],
            'link_to' => $request['link_to'],
            'vendor_invoice' => [],
        ];

        $user = auth()->user()->name;

        $history = [
            'instruction_id' => $request['instruction_id'],
            'history_data' => [
                'action' => 'Created',
                'by_user' => $user,
                'notes' => '',
                'attachment' => '',
            ]
        ];

        // $this->instService->addData($data);
        // $this->notesService->addData($history);
        
        Instruction::create($data);
        NotesByInternals::create($history);
    }

    public function getDraft()
    {
        $key = "Draft";
        $instruction = $this->instructionService->getByStatus($key);
        return $this->responseMessage(true, 'Instructions on Draft', $instruction, 200);
    }

    public function getOnProgress()
    {
        $key = "On Progress";
        $instruction = $this->instructionService->getByStatus($key);
        return $this->responseMessage(true, 'Instructions On Progress', $instruction, 200);
    }

    public function getCompleted()
    {
        $key = "Completed";
        $instruction = $this->instructionService->getByStatus($key);
        return $this->responseMessage(true, 'Completed Instructions', $instruction, 200);
    }

    public function getTerminated()
    {
        $key = "Terminated";
        $instruction = $this->instructionService->getByStatus($key);
        return $this->responseMessage(true, 'Terminated Instructions', $instruction, 200);
    }

    public function search(Request $request)
    {
        $key = $request['key'];
        $instruction = $this->instructionService->search($key);
        return $this->responseMessage(true, 'Search Result', $instruction, 200);
    }
}

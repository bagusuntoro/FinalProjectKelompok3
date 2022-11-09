<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Instruction;
use Illuminate\Http\Request;
use App\Models\NotesByInternals;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\InstructionService;

class InstructionController extends Controller
{
    // service repository pattern
    private InstructionService $instructionService;

    public function __construct()
    {
        $this->instructionService = new InstructionService();
    }

    public function showInstructions()
    {
        $instructions = $this->instructionService->getInstructions();
        return $this->responseMessage(true, 'Instructions', $instructions, 200);
    }

    public function detailInstruction(String $id)
    {
        $instruction = $this->instructionService->getById($id);
        return $this->responseMessage(true, 'Detail Instruction', $instruction, 200);
    }

    public function deleteInstruction(Request $request)
    {
        // men-validasi data
        $validator = Validator::make($request->all(), [
            'instruction_id' => 'required'
        ]);

        // pesan error jika data yang dikirim gagal di validasi
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // mencari data instruction sesuai id
        $instructionId = $request->input('instruction_id');
        $instruction = $this->instructionService->getById($instructionId);

        // pesan jika data instruction tidak dapat ditemukan
        if (!$instruction) {
            return $this->responseMessage(false, 'Instruction not found', null, 201);
        }

        // jika data instruction dapat ditemukan, maka akan dihapus
        $this->instructionService->delete($instructionId);

        // pesan setelah data instruction berhasil dihapus
        return $this->responseMessage(true, 'Instruction deleted', null, 201);
    }

    public function responseMessage($status, $message, $data, $statusCode)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }
    // end service repository pattern

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
            'note' => 'required',
            'link_to' => 'required',
        ]);
        $validateFile = Validator::make($request->all(), ['attachment' => 'required|mimes:pdf,zip']);
        if ($validateFile->fails()) {
            return response()->json($validateFile->errors(), 400);
        }
        //mapping detail cost
        $detail_cost = $this->insertMultipleCostDetail($request);

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
            'attachment' => null,
            'note' => $request['note'],
            'link_to' => $request['link_to'],
            'vendor_invoice' => [],
        ];
        $user = auth()->user()->name;
        if ($request->has('attachment')) {
            $attachment = "atch-" . time() . '.' . $request['attachment']->extension();
            $request['attachment']->move(public_path('attachment'), $attachment);
            $data["attachment"] = $attachment;
        }
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

        return response()->json([
            "statusCode" => 200,
            "message" => "Berhasil menambah instruksi",
            "data" => $data,
        ], 200);
    }


    protected function insertMultipleCostDetail(Request $request)
    {
        $data = [];
        $detail = [];
        for ($i = 1; $i <= count($request["cost_detail"]); $i++) {
            $data["_id"] = $i;
            $data["description"] = $request["cost_detail.detail$i.description"];
            $data["qty"] = $request["cost_detail.detail$i.qty"];
            $data["uom"] = $request["cost_detail.detail$i.uom"];
            $data["unit_price"] = $request["cost_detail.detail$i.unit_price"];
            $data["gst_vat"] = $request["cost_detail.detail$i.gst_vat"];
            $data["currency"] = $request["cost_detail.detail$i.currency"];
            $data["total"] = $request["cost_detail.detail$i.total"];
            $data["charge_to"] = $request["cost_detail.detail$i.charge_to"];
            array_push($detail, $data);
        }
        return $detail;
    }
}

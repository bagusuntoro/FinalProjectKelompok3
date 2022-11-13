<?php

namespace App\Http\Controllers;

use App\Models\Instruction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\InstructionService;
use Exception;

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
        $req = (array) $request->all();
        try {
            $kondisi = true;
            $statusCode = 200;
            $message = "Berhasil menambah instruksi";
            $data = $this->instructionService->create($req);
        } catch (Exception $e) {
            $kondisi = false;
            $statusCode = 400;
            $message = "Gagal menambah instruksi";
            $data = json_decode($e->getMessage());
        }
        return $this->responseMessage($kondisi, $message, $data, $statusCode);
    }

    public function showAll()
    {
        $instructionsModel = new Instruction();
        $instructions = $instructionsModel->get();

        return response()->json($instructions);
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

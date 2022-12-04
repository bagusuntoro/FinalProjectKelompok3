<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\HistoryService;
use App\Http\Services\InstructionService;
use App\Http\Services\InternalFilesService;
use Exception;
use Illuminate\Http\Request;

class InternalFilesController extends Controller
{
    protected $internalFileService;
    protected $instructionService;
    protected $historyService;

    public function __construct(InternalFilesService $internalFileService, InstructionService $instructionService, HistoryService $historyService)
    {
        $this->internalFileService = $internalFileService;
        $this->instructionService = $instructionService;
        $this->historyService = $historyService;
    }

    /*
    *
    * Menampilkan semua attachment di collection internal_file
    *
    */
    public function getAllAttachment()
    {
        $attachments = $this->internalFileService->getAll();
        return response()->json([
            "statusCode" => 200,
            "message" => "List of internals' attachments",
            "data" =>$attachments
        ],200);
    }

    /*
    *
    * Menampilkan semua attachment berdasarkan id attachment
    *
    */
    public function getById(string $id)
    {
        $attachment = $this->internalFileService->getById($id);
        return response()->json([
            "statusCode" => 200,
            "message" => "Detail attachment",
            "data" =>$attachment
        ],200);
    }

    /*
    *
    * Menambah attachment
    *
    */
    public function addAttachment(Request $request)
    {
        $req = (array) $request->all();
        $status = 'Added attachment at internal only section';
        $id = $request['instruction_id'];
        try {
            $kondisi = true;
            $statusCode = 200;
            $message = "Successfully added attachment at internal only section";
            // dd($req);
            $data = $this->internalFileService->addAttachment($req);
            $this->historyService->updateHistory($id, $status);
        } catch (Exception $e) {
            $kondisi = false;
            $statusCode = 400;
            $message = "Failed to add attachment at internal only section";
            $data = json_decode($e->getMessage());
        }
        return response()->json([
            'status' => $kondisi,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /*
    *
    * Menampilkan attachment berdasarkan id instruction
    *
    */
    public function getAllInternalAttachment(string $idInstruction)
    {
        $instruction = $this->instructionService->getById($idInstruction);
        if($instruction == null)
         return response()->json([
            "statusCode" => 404,
            "message" => "Instruction not found",
        ],200);
        $attachments = $this->internalFileService->getAllInternalAttachment($idInstruction);
        return response()->json([
            "statusCode" => 200,
            "message" => "List internals' attachments of ". $instruction[0]["instruction_id"],
            "data" => $attachments
        ],200);
    }

    /*
    *
    * Menghapus attachment
    *
    */
    public function destroy($id)
    {
        $data = $this->internalFileService->getById($id);
        if($data == null)
         return response()->json([
            "statusCode" => 404,
            "message" => "Attachment not found",
        ],200);
        $status = "Deleted attachment at internal only section";
        $this->historyService->updateHistory($data["instruction_id"], $status);
        $id = $this->internalFileService->deleteAttachment($data);
         return response()->json([
            "statusCode" => 200,
            "message" => "Successfully deleted attachment $id",
        ],200);
    }

}

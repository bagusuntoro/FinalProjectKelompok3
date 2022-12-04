<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\HistoryService;
use App\Http\Services\InstructionService;
use App\Http\Services\InternalNotesService;
use Exception;
use Illuminate\Http\Request;

class InternalNotesController extends Controller
{
    protected $internalNoteService;
    protected $instructionService;
    protected $historyService;

    public function __construct(InternalNotesService $internalNoteService, InstructionService $instructionService, HistoryService $historyService)
    {
        $this->internalNoteService = $internalNoteService;
        $this->instructionService = $instructionService;
        $this->historyService = $historyService;
    }

    /*
    *
    * Menampilkan semua notes di collection internal_notes
    *
    */
    public function getAllNotes()
    {
        $notes = $this->internalNoteService->getAll();
        return response()->json([
            "statusCode" => 200,
            "message" => "Internals' notes",
            "data" =>$notes
        ],200);
    }

    /*
    *
    * Menampilkan note berdasarkan id
    *
    */
    public function getById(string $id)
    {
        $note = $this->internalNoteService->getById($id);
        return response()->json([
            "statusCode" => 200,
            "message" => "Detail Note",
            "data" =>$note
        ],200);
    }

    /*
    *
    * Menambah note
    *
    */
    public function addNote(Request $request)
    {
        $req = (array) $request->all();
        $status = 'Added note at internal only section';
        $id = $request['instruction_id'];
        try {
            $kondisi = true;
            $statusCode = 200;
            $message = "Successfully added note at internal only section";
            // dd($req);
            $data = $this->internalNoteService->addNote($req);
            $this->historyService->updateHistory($id, $status);
        } catch (Exception $e) {
            $kondisi = false;
            $statusCode = 400;
            $message = "Failed to add note at internal only section";
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
    * Mengedit note
    *
    */
    public function editNote(Request $request, $id)
    {
        $note = $this->internalNoteService->getById($id);
        if ($note == null)
        {
            return response()->json([
                "statusCode" => 404,
                "message" => "Data not found",
            ],200);
        }
        
        $data = $request->all();
        $updatedData = $this->internalNoteService->editNote($note, $data);

        $result = $this->internalNoteService->getById($updatedData);
        $status = "Updated notes at internal only section";

        $this->historyService->updateHistory($result['instruction_id'], $status);
        return response()->json([
            "statusCode" => 200,
            "message" => "Successfully updated note",
            "data" => $result
        ],200);
    }

    /*
    *
    * Menampilkan note berdasarkan id instruction
    *
    */
    public function getAllInternalNotes(string $idInstruction)
    {
        $instruction = $this->instructionService->getById($idInstruction);
        if($instruction == null)
         return response()->json([
            "statusCode" => 404,
            "message" => "Instruction not found",
        ],200);
        $notes = $this->internalNoteService->getAllInternalNotes($idInstruction);
        return response()->json([
            "statusCode" => 200,
            "message" => "List internals' notes of ". $instruction[0]["instruction_id"],
            "data" => $notes
        ],200);
    }

    /*
    *
    * Menghapus note
    *
    */
    public function destroy($id)
    {
        $data = $this->internalNoteService->getById($id);
        if($data == null)
         return response()->json([
            "statusCode" => 404,
            "message" => "Note not found",
        ],200);
        $status = "Delete attachment at internal only section";
        $this->historyService->updateHistory($data["instruction_id"], $status);
        $id = $this->internalNoteService->deleteNote($data);
         return response()->json([
            "statusCode" => 200,
            "message" => "Successfully deleted note $id",
        ],200);
    }
}

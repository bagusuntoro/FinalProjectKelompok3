<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\HistoryService;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    private HistoryService $historyService;

    public function __construct()
    {
        $this->historyService = new HistoryService();
    }
    
    /*
    *
    * Menampilkan daftar history berdasarkan id
    *
    */
    public function getHistoryByInstruction(string $id)
    {
        $result = $this->historyService->getByInstructionId($id);
        return response()->json([
            "statusCode" => 200,
            "message" => "History of Instruction $id",
            "data" => $result
        ],200);
    }
}

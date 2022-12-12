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
    //
    public function createHistory(string $id)
    {
        // $req = $id;
        // $this->historyService->create($req);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\InstructionService;
use App\Http\Services\VendorInvoiceService;
use Exception;
use Illuminate\Http\Request;

class VendorInvoiceController extends Controller
{

    protected $invoiceService;
    protected $instructionService;

    public function __construct(VendorInvoiceService $invoiceService, InstructionService $instructionService)
    {
        $this->invoiceService = $invoiceService;
        $this->instructionService = $instructionService;
    }


    public function getAllInvoice()
    {
        $invoices = $this->invoiceService->getAll();
        return response()->json([
            "statusCode" => 200,
            "message" => "list semua invoice",
            "data" =>$invoices
        ],200);
    }


    public function getById(string $id)
    {
        $invoice = $this->invoiceService->getById($id);
         return response()->json([
            "statusCode" => 200,
            "message" => "Detail invoice",
            "data" =>$invoice
        ],200);
    }


    /*
    * Menambah vendor invoice
    */
    public function addVendorInvoice(Request $request)
    {
        $req = (array) $request->all();
        $status = 'Added invoice';
        $id = $request['instruction_id'];
        try {
            $kondisi = true;
            $statusCode = 200;
            $message = "Successfully added vendor invoice";
            $data = $this->invoiceService->addVendorInvoice($req);
            // $this->historyService->updateHistory($id, $status);
        } catch (Exception $e) {
            $kondisi = false;
            $statusCode = 400;
            $message = "Failed to add vendor invoice";
            $data = json_decode($e->getMessage());
        }
        return response()->json([
            'status' => $kondisi,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /*
    * menerima vendor invoice
    */
    public function receiveVendorInvoice(string $idInstruction)
    {
        $status = 'Invoice Accepted. Instruction completed';
        $id = $idInstruction;
        try {
            $kondisi = true;
            $statusCode = 200;
            $message = "Successfully received all vendor invoices";
            $data = $this->invoiceService->receiveVendorInvoice($idInstruction);
            // $this->historyService->updateHistory($id, $status);
        } catch (Exception $e) {
            $kondisi = false;
            $statusCode = 400;
            $message = "Failed to receive all vendor invoices";
            $data = $e->getMessage();
        }
        return response()->json([
            'status' => $kondisi,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /*
    * Untuk melihat semua vendor invoice berdasarkan instruction id tertentu
    */
    public function getAllInstructionInvoice(string $idInstruction)
    {
        $instruction = $this->instructionService->getById($idInstruction);
        if($instruction == null)
         return response()->json([
            "statusCode" => 404,
            "message" => "Instruction not found",
        ],200);
        $invoice = $this->invoiceService->getAllInstructionInvoice($idInstruction);
        return response()->json([
            "statusCode" => 200,
            "message" => "List invoice of ". $instruction[0]["instruction_id"],
            "data" => $invoice
        ],200);
    }
}

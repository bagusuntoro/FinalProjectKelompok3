<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\HistoryService;
use App\Http\Services\InstructionService;
use App\Http\Services\VendorInvoiceService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VendorInvoiceController extends Controller
{

    protected $invoiceService;
    protected $instructionService;
    protected $historyService;

    public function __construct(VendorInvoiceService $invoiceService, InstructionService $instructionService, HistoryService $historyService)
    {
        $this->invoiceService = $invoiceService;
        $this->instructionService = $instructionService;
        $this->historyService = $historyService;
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
            $this->historyService->updateHistory($id, $status);
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
            $this->historyService->updateHistory($id, $status);
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


    /*
    * Untuk update invoice
    */
    public function updateInvoice($id, Request $request)
    {
        $invoice = $this->invoiceService->getById($id);
        if($invoice == null)
         return response()->json([
            "statusCode" => 404,
            "message" => "Data not found",
        ],200);

        $data = $request->all();
        $updatedData = $this->invoiceService->updateInvoice($invoice, $data);

        $invoice_no = $updatedData["invoice_no"];
        $status = "Update invoice $invoice_no";

        $this->historyService->updateHistory($updatedData["instruction_id"], $status);
        return response()->json([
            "statusCode" => 200,
            "message" => "Successfully updated vendor invoice",
            "data" => $updatedData
        ],200);
    }

    /*
    * Untuk delete invoice_attachment
    */
    public function removeAttachment(string $idInvoice)
    {
        $data = $this->invoiceService->getById($idInvoice);
        if($data == null)
         return response()->json([
            "statusCode" => 404,
            "message" => "Invoice not found",
        ],200);
      
        $invoice = $this->invoiceService->removeAttachment($idInvoice);

        $invoice_no = $data["invoice_no"];
        $status = "Delete invoice attachment of invoice $invoice_no";
        $this->historyService->updateHistory($data["instruction_id"], $status);

         return response()->json([
            "statusCode" => 200,
            "message" => "Successfully deleted invoice attachment",
            "data" => $invoice
        ],200);
    }

    /*
    * Untuk delete supporting_doccument tertentu
    */
    public function removeSupportingDocument(Request $req)
    {    
        // validate request
        $validator = Validator::make($req->all(), [
            'invoice_id' => 'required',
            "sup_docId" => "required"
        ]);
        if($validator->fails())
        {
            return response()->json([
                "message" => "Bad request",
                "error" =>$validator->errors()
            ],400);
        }
        $data = $this->invoiceService->getById($req["invoice_id"]);
        if($data == null)
         return response()->json([
            "statusCode" => 404,
            "message" => "Invoice not found",
        ],200);
        $invoice_no = $data["invoice_no"];
        $status = "Delete supporting document of invoice $invoice_no";
        $this->historyService->updateHistory($data["instruction_id"], $status);
        $invoice = $this->invoiceService->removeSupportingDocument($data, $req["sup_docId"]);
         return response()->json([
            "statusCode" => 200,
            "message" => "Successfully deleted supporting doccument",
            "data" => $invoice
        ],200);
    }

    /*
    * Untuk delete vendor invoice
    */
    public function destroy($id)
    {
        $data = $this->invoiceService->getById($id);
        if($data == null)
         return response()->json([
            "statusCode" => 404,
            "message" => "Invoice not found",
        ],200);
        $status = "Delete Invoice";
        $this->historyService->updateHistory($data["instruction_id"], $status);
        $id = $this->invoiceService->deleteInvoice($data);
         return response()->json([
            "statusCode" => 200,
            "message" => "Successfully deleted vendor invoice $id",
        ],200);
    }
}

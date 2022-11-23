<?php

namespace App\Http\Repositories;

use App\Helpers\MongoModel;
use App\Helpers\UploadHelper;
use App\Http\Services\InstructionService;


class VendorInvoiceRepository
{
    protected $invoice;
    protected $instructionService;
    protected $uploadHelper;

    public function __construct(UploadHelper $upload, InstructionService $instructionService)
    {
        $this->invoice = new MongoModel('vendor_invoice');
        $this->uploadHelper = $upload;
        $this->instructionService = $instructionService;
    }


    public function getAll() : array
    {
        $invoices = $this->invoice->get([]);
        return $invoices;
    }

    public function getById(string $id)
    {
        $data = $this->invoice->find(['_id' => $id]);
		return $data;
    }

    /*
    * Fitur tambah invoice
    */
    public function addVendorInvoice($data)
    {
        $vendorInvoice = [
            'invoice_no' => $data['invoice_no'],
            'instruction_id' => $data['instruction_id'],
        ];

        if ($data['invoice_attachment'] !== null) {
            $filename = $this->uploadHelper->uploadFile($data['invoice_attachment']);    
            $vendorInvoice["invoice_attachment"] = $filename;            
        }
     
        $isExistSupport_doc = isset($data['supporting_document']);
        if ($isExistSupport_doc) {
            $supporting_document = [];
            foreach($data['supporting_document'] as $supDoc)
            {
                $filename = $this->uploadHelper->uploadFile($supDoc);  
                array_push($supporting_document, $filename);       
            }
            $vendorInvoice["supporting_document"] = $supporting_document;                             
        }
        else{
            $vendorInvoice["supporting_document"] = null;                     
        }

		$id = $this->invoice->save($vendorInvoice);
        $data = $this->getById($id);
        return $data;
    }
    
    /*
    * Fitur accept all invoice
    */
    public function receiveVendorInvoice(string $id)
    {
        $arr =  $this->instructionService->getById($id);
        $data = $arr[0];
        $data["status"] = "Completed";
		$id = $this->instructionService->save($data);
        return $data;
    }

    /*
    * Untuk melihat semua vendor invoice berdasarkan instruction tertentu
    */
    public function getAllInstructionInvoice(string $idInstruction)
    {
        $invoices = $this->invoice->get(['instruction_id'=>$idInstruction]);
        return $invoices;
    }
}
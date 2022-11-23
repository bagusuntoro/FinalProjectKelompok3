<?php

namespace App\Http\Repositories;

use App\Helpers\MongoModel;
use App\Helpers\UploadHelper;
use App\Http\Services\InstructionService;
use Carbon\Carbon;

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
            $createTime = Carbon::now();           
            $filename = $this->uploadHelper->uploadFile($data['invoice_attachment']);    
            $vendor_attachment = [
                "user" => auth()->user()->name,
                "created_at" => $createTime->toDateTimeString(),
                "file" => $filename
            ];
            $vendorInvoice["invoice_attachment"] = $vendor_attachment;            
        }
     
        $isExistSupport_doc = isset($data['supporting_document']);
        if ($isExistSupport_doc) {
            $supporting_document = [];
            $createTime = Carbon::now();           
            foreach($data['supporting_document'] as $supDoc)
            {
                $filename = $this->uploadHelper->uploadFile($supDoc);  
                $data = [
                    "_id" => (string) new \MongoDB\BSON\ObjectId(),
                    "user" => auth()->user()->name,
                    "created_at" => $createTime->toDateTimeString(),
                    "file" => $filename
                ];
                array_push($supporting_document, $data);       
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

    /*
    * Untuk update invoice attachment
    */
    public function updateInvoice(array $existInvoice, $newData)
    {
        $createTime = Carbon::now();           
        $existInvoice["invoice_no"] = $newData["invoice_no"];       
        $isExistInvoiceAttachment = isset($newData['invoice_attachment']);

        // vendor_invoice
        if ($isExistInvoiceAttachment) {
            if(isset($existInvoice["invoice_attachment"]["file"]))
            {
                //jika file yang diupload beda dengan sebelumnya
                if($newData["invoice_attachment"]->getClientOriginalName() != $existInvoice["invoice_attachment"]["file"])
                {
                    //hapus file lama
                    $this->uploadHelper->removeFile($existInvoice["invoice_attachment"]["file"]);
                    $filename = $this->uploadHelper->uploadFile($newData['invoice_attachment']);    
                    $vendor_attachment = [
                        "user" => auth()->user()->name,
                        "created_at" => $createTime->toDateTimeString(),
                        "file" => $filename
                    ];
                    $existInvoice["invoice_attachment"] = $vendor_attachment;            
                }
            }
            else
            {        
                $filename = $this->uploadHelper->uploadFile($newData['invoice_attachment']);    
                $vendor_attachment = [
                    "user" => auth()->user()->name,
                    "created_at" => $createTime->toDateTimeString(),
                    "file" => $filename
                ];
                $existInvoice["invoice_attachment"] = $vendor_attachment;            
            }
          
        }    
        // supporting document
        $isExistSupport_doc = isset($newData['supporting_document']);
        if ($isExistSupport_doc) 
        {
            foreach($newData['supporting_document'] as $supDoc)
            {
                $filename = $this->uploadHelper->uploadFile($supDoc);  
                $data = [
                    "_id" => (string) new \MongoDB\BSON\ObjectId(),
                    "user" => auth()->user()->name,
                    "created_at" => $createTime->toDateTimeString(),
                    "file" => $filename
                ];
                array_push($existInvoice["supporting_document"], $data);
            }
        }
        $id = $this->invoice->save($existInvoice);
        $data = $this->getById($id);
        return $data;
    }


    /*
    * Untuk hapus attachment di vendor invoice
    */
    public function removeAttachment(string $idInvoice)
    {
        $invoice = $this->getById($idInvoice);
        if($invoice["invoice_attachment"] != null)
        {
           $this->uploadHelper->removeFile($invoice["invoice_attachment"]["file"]);
        }    
        $invoice["invoice_attachment"] = null;
        $id = $this->invoice->save($invoice);
        $data = $this->getById($id);
        return $data;
    }

    /*
    * Untuk delete supporting_doccument tertentu
    */
    public function removeSupportingDocument(array $invoice, string $sup_docId)
    {
        $isExistSup_doc = isset($invoice['supporting_document']) ? $invoice['supporting_document'] : null;
        //Pencarian dan penghapusan sup document
        $sup_docs = array_filter($isExistSup_doc, function($sup_doc) use ($sup_docId) {
            if($sup_doc['_id'] == $sup_docId) //jika ketemu maka keluar kan dari array dan hapus file
			{
                $this->uploadHelper->removeFile($sup_doc["file"]);
				return false;
			} else {
				return true;
			}
        });
        $sup_docs = array_values($sup_docs);
        $invoice["supporting_document"] = $sup_docs;
        $id = $this->invoice->save($invoice);
        $data = $this->getById($id);
        return $data;
    }
    
    /*
    * Untuk delete vendor invoice
    */
    public function deleteInvoice(array $data)
    {
        // hapus file attachment
        $attachment = isset($data["invoice_attachment"]["file"]) ? $data["invoice_attachment"]["file"] : null;
        if($attachment)
        {
            $this->uploadHelper->removeFile($attachment);
        }

        // hapus sup doc
        $sup_docs = isset($data["supporting_document"]) ? $data["supporting_document"] : null;
        if($sup_docs)
        {
            foreach($sup_docs as $doc)
            {
                $this->uploadHelper->removeFile($doc["file"]);
            }
        }
        $this->invoice->deleteQuery($data);
        return $data["_id"];
    }
}
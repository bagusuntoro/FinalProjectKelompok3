<?php

namespace App\Http\Services;

use App\Http\Repositories\InstructionRepository;
use App\Http\Repositories\VendorInvoiceRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class VendorInvoiceService
{
    protected $invoiceRepository;
    protected $instructionRepository;

    public function __construct(VendorInvoiceRepository $invoiceRepository, InstructionRepository $instructionRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->instructionRepository = $instructionRepository;
    }


    public function getAll()
    {
        $invoices = $this->invoiceRepository->getAll();
        return $invoices;
    }

    public function getById(string $id)
    {
        $invoice = $this->invoiceRepository->getById($id);
        return $invoice;
    }

    /*
    * Menambah vendor invoice
    */
    public function addVendorInvoice(array $request)
    {
      
        $validator = Validator::make($request, [
            'invoice_no' => 'required',
            'invoice_attachment' => 'required|mimes:pdf,zip',
            'supporting_document[]' => 'mimes:pdf,zip',
            'instruction_id' => 'required'
        ]);
          //jika validasi gagal
        if($validator->fails())
        {
            throw new InvalidArgumentException($validator->errors());
        }
        $data = $this->invoiceRepository->addVendorInvoice($request);
		return $data;
    }
    
    /*
    * menerima semua vendor invoice
    */
    public function receiveVendorInvoice(String $id)
    {
        $isExist =  $this->instructionRepository->getById($id);
        if($isExist == null)
        {      
            throw new InvalidArgumentException('Data not found');     
        }
        $data = $this->invoiceRepository->receiveVendorInvoice($id);
        return $data;
    }

     /*
    * Untuk melihat semua vendor invoice berdasarkan instruction id tertentu
    */
    public function getAllInstructionInvoice(string $idInstruction)
    {
        $data =  $this->invoiceRepository->getAllInstructionInvoice($idInstruction);
        return $data;
    }
}
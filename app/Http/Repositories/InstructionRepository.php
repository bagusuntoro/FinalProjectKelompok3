<?php

namespace App\Http\Repositories;

use App\Helpers\MongoModel;
use App\Models\Instruction;
use App\Models\NotesByInternals;

use function PHPUnit\Framework\isEmpty;

class InstructionRepository
{
    private MongoModel $instructions;

    public function __construct()
    {
        $this->instructionModel = new MongoModel('instruction');
        $this->vendorInvoiceModel = new MongoModel('vendor_invoice');
    }

    /*
    * Menampilkan semua instruction
    */
    public function getAll()
    {
        $instructions = $this->instructionModel->get([]);
        return $instructions;
    }

    /*
    * Menampilkan instruction berdasarkan id
    */
    public function getById($id)
    {
        $instruction = $this->instructionModel->get(['_id' => $id]);
        return $instruction;
    }

    /*
    * Menghapus instruction
    */
    public function delete(String $id)
    {
        $instruction = $this->instructionModel->deleteQuery(['_id' => $id]);
        return $instruction;
    }

    /*
    * Menyimpan data Instruction
    */
    public function create($data)
    {
        $newData = [
            'instruction_id' => $data['instruction_id'],
            'link_to' => $data['link_to'],
            'instruction_type' => $data['instruction_type'],
            'assigned_vendor' => $data['assigned_vendor'],
            'vendor_address' => $data['vendor_address'],
            'attention_of' => $data['attention_of'],
            'quotation_no' => $data['quotation_no'],
            'invoice_to' => $data['invoice_to'],
            'customer_po' => $data['customer_po'],
            'customer_contract' => $data['customer_contract'],
            'status' => $data['status'],
            'cost_detail' => $data['detail_cost'],
            'attachment' => null,
            'note' => $data['note'],
            'vendor_invoice' => [],
        ];

        if ($data['attachment'] !== null) {
            $attachment = "atch-" . time() . '.' . $data['attachment']->extension();
            $data['attachment']->move(public_path('attachment'), $attachment);
            $newData["attachment"] = $attachment;            
        }

		$id = $this->instructionModel->save($newData);

        return $id;
    }

    /*
    * Mengubah status instruction ke terminated
    */
    public function setTerminated(array $data)
    {
        $id = $this->instructionModel->save($data);
        return $id;
    }

    /*
    * Mengubah status instruction ke on progress
    */
    public function setOnProgress(array $data)
    {
        $id = $this->instructionModel->save($data);
        return $id;
    }

    /*
    * Menampilkan data instruction sesuai status yang diterima
    */
    public function getByStatus(string $key)
    {
        $instruction = $this->instructionModel->get(['status' => $key]);
        return $instruction;
    }

    /*
    * Fitur pencarian
    */
    public function search(string $key)
    {
        $instruction = Instruction::query()
                ->where('instruction_id', 'LIKE','%'.$key.'%')
                ->orWhere('link_to', 'LIKE','%'.$key.'%')
                ->orWhere('instruction_type', 'LIKE','%'.$key.'%')
                ->orWhere('assigned_vendor', 'LIKE','%'.$key.'%')
                ->orWhere('attention_of', 'LIKE','%'.$key.'%')
                ->orWhere('quotation_no', 'LIKE','%'.$key.'%')
                ->orWhere('customer_po', 'LIKE','%'.$key.'%')
                ->get();
        return $instruction;
    }

    /*
    * Mencari data instruksi secara descending
    */
    public function getInstructionNo(string $key)
    {
        $instruction = Instruction::query()
                ->where('instruction_id','LIKE','%'.$key.'%')
                ->orderBy('instruction_id','desc')                
                ->first();
        return $instruction;
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
            $file = $data['invoice_attachment']->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $invoice_attachment = $filename ."-" . time() . '.' . $extension;
            $data['invoice_attachment']->move(public_path('invoice_attachment'), $invoice_attachment);
            $vendorInvoice["invoice_attachment"] = $invoice_attachment;            
        }
        
        $isExistSupport_doc = in_array('supporting_document', $data);
        if ($isExistSupport_doc) {
            $file = $data['supporting_document']->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $supporting_document = $filename ."-" . time() . '.' . $extension;
            $data['supporting_document']->move(public_path('invoice_attachment'), $supporting_document);
            $vendorInvoice["supporting_document"] = $supporting_document;                     
        }
        else{
            $vendorInvoice["supporting_document"] = null;                     
        }

		$id = $this->vendorInvoiceModel->save($vendorInvoice);
        $data = $this->vendorInvoiceModel->get(['_id' => $id]);
        return $data;
    }
    /*
    * Fitur accept all invoice
    */
    public function receiveVendorInvoice(string $id)
    {
        $arr =  $this->getById($id);
        $data = $arr[0];
        $data["status"] = "Completed";
		$id = $this->instructionModel->save($data);
        return $data;
    }
}

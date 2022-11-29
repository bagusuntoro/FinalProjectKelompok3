<?php

namespace App\Http\Repositories;

use App\Helpers\MongoModel;
use App\Helpers\UploadHelper;
use Carbon\Carbon;

use function PHPUnit\Framework\isEmpty;

class InstructionRepository
{
    private MongoModel $instructions;
    protected $uploadHelper;

    public function __construct()
    {
        $this->instructionModel = new MongoModel('instruction');
        $this->vendorInvoiceModel = new MongoModel('vendor_invoice');
        $this->uploadHelper = new UploadHelper();
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
        ];

        if ($data['attachment'] !== null) {
            $attachments = [];
            foreach($data['attachment'] as $file)
            {
                $filename = $this->uploadHelper->uploadFile($file);  
                $user = auth()->user()->name;
                $created_at = Carbon::now();
                $data = [
                    "_id" => (string) new \MongoDB\BSON\ObjectId(),
                    "user" => $user,
                    "created_at" => $created_at->toDateTimeString(),
                    "file" => $filename
                ];
                array_push($attachments, $data);       
            } 
        
            $newData["attachment"] = $attachments;            
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

    public function save(array $editedData)
	{
		$id = $this->instructionModel->save($editedData);
		return $id;
	}
}

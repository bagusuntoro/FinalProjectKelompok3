<?php

namespace App\Http\Services;

use App\Http\Repositories\HistoryRepository;
use App\Http\Repositories\InstructionRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class InstructionService
{
    private InstructionRepository $instructionRepository;
    private HistoryRepository $historyRepo;

    public function __construct()
    {
        $this->instructionRepository = new InstructionRepository();
        $this->historyRepo = new HistoryRepository;
    }

    /*
    * Menampilkan semua instruction
    */
    public function getInstructions()
    {
        return $this->instructionRepository->getAll();
    }

    /*
    * Menampilkan instruction berdasarkan id
    */
    public function getById($id)
    {
        $instruction = $this->instructionRepository->getById($id);
        return $instruction;
    }

    /*
    * Menghapus instruction
    */
    public function delete(String $id)
    {
        $instruction = $this->instructionRepository->delete($id);
        return $instruction;
    }

    /*
    * Menambah instruction
    */
    public function create($request, $stat)
    {
        $validator = Validator::make($request, [
            'link_to' => 'required',
            'instruction_type' => 'required',
            'assigned_vendor' => 'required',
            'vendor_address' => 'required',
            'attention_of' => 'required',
            'quotation_no' => 'required',
            'invoice_to' => 'required',
            'customer_po' => 'required',
            'customer_contract' => 'required',
            'note' => 'required',
            'link_to' => 'required',
            'attachment[]' => 'mimes:pdf,zip',
        ]);
         //jika validasi gagal
        if($validator->fails())
        {
            throw new InvalidArgumentException($validator->errors());
        }
        // //jika validasi berhasil 
        $detail_cost = $this->insertMultipleCostDetail($request);

        if ($request['instruction_type'] == 'Logistic Instruction')
        {
            $key = 'LI';
        } else if ($request['instruction_type'] == 'Service Instruction')
        {
            $key = 'SI';
        }

        $code = $this->getInstructionNo($key);

        
        $user = auth()->user()->name;

        $request['detail_cost'] = $detail_cost;
        $request['user'] = $user;
        $request['status'] = $stat;
        $request['instruction_id'] = $code;
        
        $instruction= $this->instructionRepository->create($request);
        
        $data = $this->instructionRepository->getById($instruction);
        
		return $data;
    }
    // Fungsi menambahkan cost detail, karena bagian ini dapat dimasukkan lebih dari satu
    protected function insertMultipleCostDetail($request)
    {
        $details = [];
        foreach($request['cost_detail'] as $detail) 
        {
            $data = [
                "_id" => (string) new \MongoDB\BSON\ObjectId(),
                "description" => $detail["description"],
                "qty" => $detail["qty"],
                "uom" => $detail["uom"],
                "unit_price" => $detail["unit_price"],
                "discount" => $detail["discount"],
                "gst_vat" =>  $detail["gst_vat"],
                "currency" => $detail["currency"],
                "total" => $detail["total"],
                "charge_to" => $detail["charge_to"]
            ];
            array_push($details, $data);
        }
        return $details;
    }
    /*
    * Mengubah status instruksi menjadi terminated
    */
    public function setTerminated(string $id)
    {
        $editedData = [
            '_id' => $id,
            'status' => 'Terminated'
        ];
        $id = $this->instructionRepository->setTerminated($editedData);
        return $id;
    }

    /*
    * Mengubah status instruksi menjadi on progress
    */
    public function setOnProgress(string $id)
    {
        $editedData = [
            '_id' => $id,
            'status' => 'On Progress'
        ];
        $id = $this->instructionRepository->setOnProgress($editedData);
        return $id;
    }

    /*
    * Menampilkan instruction berdasarkan status yang dimasukkan
    */
    public function getByStatus(string $key)
    {
        $instruction = $this->instructionRepository->getByStatus($key);
        return $instruction;
    }

    /*
    * Menampilkan hasil pencarian instruction
    */
    public function search(string $key)
    {
        $instruction = $this->instructionRepository->search($key);
        return $instruction;
    }

    /*
    * Generate Nomor instruction dengan cara mendapatkan data instruction secara descending
    */
    public function getInstructionNo($key)
    {
        // Cari instruksi service/logistik terakhir
        $instruction = $this->instructionRepository->getInstructionNo($key);
        // Jika tidak ditemukan
        if ($instruction == null){
            $code = $key.'-'.date("Y")."-".'0001';
        }
        // Jika ditemukan maka generate kode baru
        else {
            $prevCode = strval($instruction['instruction_id']);
            $splitCode = explode('-',$prevCode);
            $currentCode = $splitCode[2] + 1;
            if (strlen((string)$currentCode) < 2)
            {
                $code = $key.'-'.date("Y")."-"."000".(string)$currentCode;
            } else if (strlen((string)$currentCode) < 3)
            {
                $code = $key.'-'.date("Y")."-"."00".(string)$currentCode;
            } else if (strlen((string)$currentCode) < 4)
            {
                $code = $key.'-'.date("Y")."-"."0".(string)$currentCode;
            } else if (strlen((string)$currentCode) < 5)
            {
                $code = $key.'-'.(string)$currentCode;
            }
        }
        return $code;
    }

    public function save(array $editedData)
    {
        $id = $this->instructionRepository->save($editedData);
        return $id;
    }
    
}
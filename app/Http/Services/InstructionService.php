<?php

namespace App\Http\Services;

use App\Http\Repositories\InstructionRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class InstructionService
{
    private InstructionRepository $instructionRepository;

    public function __construct()
    {
        $this->instructionRepository = new InstructionRepository();
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
    public function create($request)
    {
        $validator = Validator::make($request, [
            'instruction_id' => 'required',
            'link_to' => 'required',
            'instruction_type' => 'required',
            'assigned_vendor' => 'required',
            'attention_of' => 'required',
            'quotation_no' => 'required',
            'customer_po' => 'required',
            'note' => 'required',
            'link_to' => 'required',
            'attachment' => 'mimes:pdf,zip',
        ]);
         //jika validasi gagal
        if($validator->fails())
        {
            throw new InvalidArgumentException($validator->errors());
        }

        // //jika validasi berhasil 
        $detail_cost = $this->insertMultipleCostDetail($request);
        
        $user = auth()->user()->name;

        $request['detail_cost'] = $detail_cost;
        $request['user'] = $user;
        
        $instruction= $this->instructionRepository->create($request);
        
        $data = $this->instructionRepository->getById($instruction);
        
		return $data;
    }
    // Fungsi menambahkan cost detail, karena bagian ini dapat dimasukkan lebih dari satu
    protected function insertMultipleCostDetail($request)
    {
        $data = [];
        $detail = [];
        for ($i = 1; $i <= count($request["cost_detail"]); $i++) {
            $data["_id"] = (string) new \MongoDB\BSON\ObjectId();
            $data["description"] = $request['cost_detail']["detail$i"]["description"];
            $data["qty"] = $request['cost_detail']["detail$i"]["qty"];
            $data["uom"] = $request['cost_detail']["detail$i"]["uom"];
            $data["unit_price"] = $request['cost_detail']["detail$i"]["unit_price"];
            $data["gst_vat"] = $request['cost_detail']["detail$i"]["gst_vat"];
            $data["currency"] = $request['cost_detail']["detail$i"]["currency"];
            $data["total"] = $request['cost_detail']["detail$i"]["total"];
            $data["charge_to"] = $request['cost_detail']["detail$i"]["charge_to"];
            array_push($detail, $data);
        }
        return $detail;
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

}
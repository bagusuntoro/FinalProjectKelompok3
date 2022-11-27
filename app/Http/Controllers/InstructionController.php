<?php

namespace App\Http\Controllers;

use App\Models\Instruction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryController;
use App\Http\Services\HistoryService;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\InstructionService;
use Exception;

class InstructionController extends Controller
{
    private InstructionService $instructionService;
    private HistoryService $historyService;

    public function __construct()
    {
        $this->instructionService = new InstructionService();
        $this->historyService = new HistoryService();
    }

    /*
    * Menampilkan semua instruction
    */
     public function showInstructions()
    {
        $instructions = $this->instructionService->getInstructions();
        return $this->responseMessage(true, 'Instructions', $instructions, 200);
    }

    /*
    * Menampilkan detail instruction, diambil dari id
    */
    public function detailInstruction($id)
    {
        $instruction = $this->instructionService->getById($id);
        return $this->responseMessage(true, 'Detail Instruction', $instruction, 200);
    }

    /*
    * Menghapus instruction berdasarkan id
    */
    public function deleteInstruction(Request $request)
    {
        // men-validasi data
        $validator = Validator::make($request->all(), [
            'instruction_id' => 'required'
        ]);

        // pesan error jika data yang dikirim gagal di validasi
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // mencari data instruction sesuai id
        $instructionId = $request->input('instruction_id');
        $instruction = $this->instructionService->getById($instructionId);

        // pesan jika data instruction tidak dapat ditemukan
        if (!$instruction) {
            return $this->responseMessage(false, 'Instruction not found', null, 201);
        }

        // jika data instruction dapat ditemukan, maka akan dihapus
        $this->instructionService->delete($instructionId);

        // pesan setelah data instruction berhasil dihapus
        return $this->responseMessage(true, 'Instruction deleted', null, 201);
    }

    /*
    * Fungsi untuk menampilkan pesan berbentuk json
    */
    public function responseMessage($status, $message, $data, $statusCode)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /*
    * Menyimpan data instruction baru
    */
    public function storeData(Request $request)
    {
        $req = (array) $request->all();
        $setStatus = 'On Progress';
        
        try {
            $kondisi = true;
            $statusCode = 200;
            $message = "Berhasil menambah instruksi";
            $data = $this->instructionService->create($req, $setStatus);
            $history = array_column($data,'_id');
            $this->historyService->create($history, $setStatus);
        } catch (Exception $e) {
            $kondisi = false;
            $statusCode = 400;
            $message = "Gagal menambah instruksi";
            $data = json_decode($e->getMessage());
        }
        return $this->responseMessage($kondisi, $message, $data, $statusCode);        
    }

    /*
    * Menyimpan data instruction sebagai draft
    */
    public function draftData(Request $request)
    {
        $req = (array) $request->all();
        $setStatus = 'Draft';
        
        try {
            $kondisi = true;
            $statusCode = 200;
            $message = "Instruksi dimasukkan ke dalam Draft";
            $data = $this->instructionService->create($req, $setStatus);
            $history = array_column($data,'_id');
            $this->historyService->create($history, $setStatus);
        } catch (Exception $e) {
            $kondisi = false;
            $statusCode = 400;
            $message = "Gagal menambah instruksi";
            $data = json_decode($e->getMessage());
        }
        return $this->responseMessage($kondisi, $message, $data, $statusCode);
    }

    /*
    * Mengubah status data menjadi terminated
    */
    public function setTerminated(Request $request)
    {
        // men-validasi data
        $validator = Validator::make($request->all(), [
            'instruction_id' => 'required'
        ]);

        // pesan error jika data yang dikirim gagal di validasi
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // mencari data instruction sesuai id
        $instructionId = $request->input('instruction_id');
        $instruction = $this->instructionService->getById($instructionId);

        // pesan jika data instruction tidak dapat ditemukan
        if (!$instruction) {
            return $this->responseMessage(false, 'Instruction not found', null, 201);
        }

        $status = 'Set to terminated';
        $this->instructionService->setTerminated($instructionId);
        $this->historyService->updateHistory($instructionId, $status);

        // pesan setelah status instruction berhasil diubah
        return $this->responseMessage(true, 'Status changed to terminated', null, 201);
    }

    /*
    * Mengubah status data menjadi on progress
    */
    public function setOnProgress(Request $request)
    {
        // men-validasi data
        $validator = Validator::make($request->all(), [
            'instruction_id' => 'required'
        ]);

        // pesan error jika data yang dikirim gagal di validasi
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // mencari data instruction sesuai id
        $instructionId = $request->input('instruction_id');
        $instruction = $this->instructionService->getById($instructionId);

        // pesan jika data instruction tidak dapat ditemukan
        if (!$instruction) {
            return $this->responseMessage(false, 'Instruction not found', null, 201);
        }

        $status = 'Set to on progress';
        $this->instructionService->setOnProgress($instructionId);
        $this->historyService->updateHistory($instructionId, $status);

        // pesan setelah status instruction berhasil diubah
        return $this->responseMessage(true, 'Status changed to on progress', null, 201);
    }
    
    /*
    * Menampilkan daftar instruction yang memiliki status draft
    */
    public function getDraft()
    {
        $key = "Draft";
        $instruction = $this->instructionService->getByStatus($key);
        return $this->responseMessage(true, 'Instructions on Draft', $instruction, 200);
    }
    
    /*
    * Menampilkan daftar instruction yang memiliki status on progress
    */
    public function getOnProgress()
    {
        $key = "On Progress";
        $instruction = $this->instructionService->getByStatus($key);
        return $this->responseMessage(true, 'Instructions On Progress', $instruction, 200);
    }

    /*
    * Menampilkan daftar instruction yang memiliki status completed. Status akan berubah complete jika invoice ditambahkan
    */
    public function getCompleted()
    {
        $key = "Completed";
        $instruction = $this->instructionService->getByStatus($key);
        return $this->responseMessage(true, 'Completed Instructions', $instruction, 200);
    }

    /*
    * Menampilkan daftar instruction yang memiliki status terminated
    */
    public function getTerminated()
    {
        $key = "Terminated";
        $instruction = $this->instructionService->getByStatus($key);
        return $this->responseMessage(true, 'Terminated Instructions', $instruction, 200);
    }

    /*
    * Menampilkan daftar instruction yang sesuai pencarian. Parameter pencarian akan dicocokkan dengan:
    * instruction_id, link_to, instruction_type, assigned_vendor, attention_of, quotation_no, customer_po
    */
    public function search(Request $request)
    {
        $key = $request['key'];
        $instruction = $this->instructionService->search($key);
        return $this->responseMessage(true, 'Search Result', $instruction, 200);
    }

    public function editData(Request $request, $id)
    {
        $cost_detail = [
            'description' => $request['description'],
            'qty' => $request['qty'],
            'uom' => $request['uom'],
            'unit_price' => $request['unit_price'],
            'discount' => $request['discount'],
            'gst_vat' => $request['gst_vat'],
            'currency' => $request['currency'],
            'total' => $request['total'],
            'charge_to' => $request['charge_to'],

            $this->insertMultipleCostDetail($request),
        ];
        
        $data = Instruction::findOrFail($id);
        $instruction_id = $request->instruction_id;

        $instruction_id = explode(' ', $instruction_id);
        
        if (count($instruction_id) > 1){
            preg_match_all('/\d+/', $instruction_id[1], $matches);
            
            $instruction_id = $instruction_id[0] . ' R' . ($matches[0][0] + 1);
        } else{
            $instruction_id = $instruction_id[0] . ' R1';
        }
        echo $instruction_id;   
        // dd($instruction_id);
        
        $data -> cost_detail = $cost_detail;
        $data -> attachment = $request->attachment;
        $data -> note = $request->note;
        $data -> link_to = $request->link_to;
        $data -> save();
            
        return response()->json([
            "statusCode" => 200,
            "message" => "Berhasil Update instruksi",
            "data" => $data,
        ], 200);
    }
    
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
}
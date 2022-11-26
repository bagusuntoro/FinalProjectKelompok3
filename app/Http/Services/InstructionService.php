<?php

namespace App\Http\Services;

use App\Helpers\UploadHelper;
use App\Http\Repositories\HistoryRepository;
use App\Http\Repositories\InstructionRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

use function PHPUnit\Framework\isNull;

class InstructionService
{
    private InstructionRepository $instructionRepository;
    private HistoryRepository $historyRepo;
    protected $uploadHelper;

    public function __construct()
    {
        $this->instructionRepository = new InstructionRepository();
        $this->historyRepo = new HistoryRepository;
        $this->uploadHelper = new UploadHelper();
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
    * menghapus cost detail
    */
    public function deleteCostDetail(array $instruction, array $formData)
    {
        if (isset($formData)) {
            $instruction[0]['cost_detail'] = $formData;
        }
        // return $instruction[0];

        $id = $this->instructionRepository->save($instruction[0]);
        return $id;
    }

    // edit data instruction
    public function editData(array $instruction, array $formData)
    {
        // meregenerate instruction_id baru setiap kali data diedit
        $instruction_id = $formData['instruction_id'];

        $instruction_id = explode(' ', $instruction_id);

        if (count($instruction_id) > 1) {
            preg_match_all('/\d+/', $instruction_id[1], $matches);

            $instruction_id = $instruction_id[0] . ' R' . ($matches[0][0] + 1);
        } else {
            $instruction_id = $instruction_id[0] . ' R1';
        }

        // menyimpan cost detail
        $cost_details = $this->insertMultipleCostDetail($formData);

        $attachments = $instruction[0]['attachment'];

        // menyimpan attachment
        if ($formData['attachment'] !== null) {
            $attachments = [];
            foreach ($formData['attachment'] as $file) {
                $filename = $this->uploadHelper->uploadFile($file);
                $user = auth()->user()->name;
                $created_at = Carbon::now();
                $attachment = [
                    "_id" => (string) new \MongoDB\BSON\ObjectId(),
                    "user" => $user,
                    "created_at" => $created_at->toDateTimeString(),
                    "file" => $filename
                ];
                array_push($attachments, $attachment);
            }
        }

        $editInstruction = [
            '_id' => $formData['id'],
            'instruction_id' => $instruction_id,
            'link_to' => $formData['link_to'],
            'instruction_type' => $formData['instruction_type'],
            'assigned_vendor' => $formData['assigned_vendor'],
            'vendor_address' => $formData['vendor_address'],
            'attention_of' => $formData['attention_of'],
            'quotation_no' => $formData['quotation_no'],
            'invoice_to' => $formData['invoice_to'],
            'customer_po' => $formData['customer_po'],
            'customer_contract' => $formData['customer_contract'],
            'status' => '-',
            'cost_detail' => $cost_details,
            'attachment' => $attachments,
            'note' => $formData['note'],
            'vendor_invoice' => [],
            'user' => auth()->user()->name,
        ];

        $id = $this->instructionRepository->save($editInstruction);
        return $id;
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
        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors());
        }
        // //jika validasi berhasil 
        $detail_cost = $this->insertMultipleCostDetail($request);

        if ($request['instruction_type'] == 'Logistic Instruction') {
            $key = 'LI';
        } else if ($request['instruction_type'] == 'Service Instruction') {
            $key = 'SI';
        }

        $code = $this->getInstructionNo($key);


        $user = auth()->user()->name;

        $request['detail_cost'] = $detail_cost;
        $request['user'] = $user;
        $request['status'] = $stat;
        $request['instruction_id'] = $code;

        $instruction = $this->instructionRepository->create($request);

        $data = $this->instructionRepository->getById($instruction);

        return $data;
    }
    // Fungsi menambahkan cost detail, karena bagian ini dapat dimasukkan lebih dari satu
    protected function insertMultipleCostDetail($request)
    {
        $details = [];
        foreach ($request['cost_detail'] as $detail) {
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
        if ($instruction == null) {
            $code = $key . '-' . date("Y") . "-" . '0001';
        }
        // Jika ditemukan maka generate kode baru
        else {
            $prevCode = strval($instruction['instruction_id']);
            $splitCode = explode('-', $prevCode);
            $currentCode = $splitCode[2] + 1;
            if (strlen((string)$currentCode) < 2) {
                $code = $key . '-' . date("Y") . "-" . "000" . (string)$currentCode;
            } else if (strlen((string)$currentCode) < 3) {
                $code = $key . '-' . date("Y") . "-" . "00" . (string)$currentCode;
            } else if (strlen((string)$currentCode) < 4) {
                $code = $key . '-' . date("Y") . "-" . "0" . (string)$currentCode;
            } else if (strlen((string)$currentCode) < 5) {
                $code = $key . '-' . (string)$currentCode;
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

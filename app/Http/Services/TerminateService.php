<?php

namespace App\Http\Services;

use App\Helpers\UploadHelper;
use App\Http\Repositories\HistoryRepository;
use App\Http\Repositories\TerminateRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

use function PHPUnit\Framework\isNull;

class TerminateService
{
    private TerminateRepository $TerminateRepository;
    private HistoryRepository $historyRepo;
    protected $uploadHelper;

    public function __construct()
    {
        $this->instructionRepository = new TerminateRepository();
        $this->historyRepo = new HistoryRepository;
        $this->uploadHelper = new UploadHelper();
    }

    /*
    * Menambah instruction
    */
    public function createTerminate($request, $stat)
    {
        $validator = Validator::make($request, [
            'description' => 'required',
            'attachment[]' => 'mimes:pdf,zip',
        ]);
        //jika validasi gagal
        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors());
        }

        $user = auth()->user()->name;

        $request['user'] = $user;
        $request['status'] = $stat;

        $instruction = $this->instructionRepository->create($request);

        $data = $this->instructionRepository->getById($instruction);

        return $data;
    }
}
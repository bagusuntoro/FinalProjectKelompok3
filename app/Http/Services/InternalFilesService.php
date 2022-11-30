<?php

namespace App\Http\Services;

use App\Http\Repositories\InstructionRepository;
use App\Http\Repositories\InternalFilesRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class InternalFilesService
{
  protected $internalFilesRepo;
  protected $instructionRepository;

  public function __construct(InternalFilesRepository $internalFilesRepo, InstructionRepository $instructionRepository)
  {
    $this->internalFilesRepo = $internalFilesRepo;
    $this->instructionRepository = $instructionRepository;
  }

  public function getAll()
  {
    $files = $this->internalFilesRepo->getAll();
    return $files;
  }

  public function getById(string $id)
  {
    $files = $this->internalFilesRepo->getById($id);
    return $files;
  }

  public function addAttachment(array $request)
  {
    $validator = Validator::make($request, [
      'attachment' => 'required|mimes:pdf,zip',
      'instruction_id' => 'required'
    ]);
    //jika validasi gagal
    if($validator->fails())
    {
      throw new InvalidArgumentException($validator->errors());
    }
    // dd($request);
    $data = $this->internalFilesRepo->addFileInternal($request);
    return $data;
  }

  public function getAllInternalAttachment(string $idInstruction)
  {
    $data =  $this->internalFilesRepo->getByInstruction($idInstruction);
    return $data;
  }

  public function deleteAttachment(array $data)
  {
    $id = $this->internalFilesRepo->delete($data);
		return $id;
  }
}
?>
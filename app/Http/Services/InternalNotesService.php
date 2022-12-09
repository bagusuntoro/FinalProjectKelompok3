<?php

namespace App\Http\Services;

use App\Http\Repositories\InstructionRepository;
use App\Http\Repositories\InternalNotesRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class InternalNotesService
{
  protected $internalNotesRepo;
  protected $instructionRepository;

  public function __construct(InternalNotesRepository $internalNotesRepo, InstructionRepository $instructionRepository)
  {
    $this->internalNotesRepo = $internalNotesRepo;
    $this->instructionRepository = $instructionRepository;
  }

  public function getAll()
  {
    $files = $this->internalNotesRepo->getAll();
    return $files;
  }

  public function getById(string $id)
  {
    $files = $this->internalNotesRepo->getById($id);
    return $files;
  }

  public function addNote(array $request)
  {
    $validator = Validator::make($request, [
      'note' => 'required',
      'instruction_id' => 'required'
    ]);
    //jika validasi gagal
    if($validator->fails())
    {
      throw new InvalidArgumentException($validator->errors());
    }
    // dd($request);
    $data = $this->internalNotesRepo->addNoteInternal($request);
    return $data;
  }

  public function editNote(array $editedNote, array $formData)
  {
    if (isset($formData['note']))
    {
      $editedNote['note'] = $formData['note'];
    }

    $id = $this->internalNotesRepo->editNote($editedNote);
    return $id;
  }

  public function getAllInternalNotes(string $idInstruction)
  {
    $data =  $this->internalNotesRepo->getByInstruction($idInstruction);
    return $data;
  }

  public function deleteNote(array $data)
  {
    $id = $this->internalNotesRepo->delete($data);
		return $id;
  }
}
?>
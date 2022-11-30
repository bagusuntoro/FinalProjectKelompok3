<?php
namespace App\Http\Repositories;

use App\Helpers\MongoModel;
use Carbon\Carbon;

class InternalNotesRepository
{
  protected $internalNotes;
  protected $uploadHelper;

  public function __construct()
  {
    $this->internalNotes = new MongoModel('internal_notes');
  }

  public function getAll() : array
  {
    $notes = $this->internalNotes->get([]);
    return $notes;
  }

  public function getById(string $id)
  {
    $data = $this->internalNotes->find(['_id' => $id]);
		return $data;
  }

  public function getByInstruction(string $id)
  {
    $data = $this->internalNotes->get(['instruction_id' => $id]);
		return $data;
  }

  public function addNoteInternal(array $data)
  {
    $time = Carbon::now();
    $note = [
      'instruction_id' => $data['instruction_id'],
      'note' => $data['note'],
      'user' => auth()->user()->name,
      'created_at' => $time->toDateTimeString(),
    ];    

    $id = $this->internalNotes->save($note);
    $data = $this->getById($id);
    return $data;
  }

  public function editNote(array $data)
  {
    $data = $this->internalNotes->save($data);
    return $data;
  }

  public function delete(array $data)
  {
    $this->internalNotes->deleteQuery($data);
    return $data["_id"];
  }

}

?>
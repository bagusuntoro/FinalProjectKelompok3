<?php
namespace App\Http\Repositories;

use App\Helpers\MongoModel;
use App\Helpers\UploadHelper;
use Carbon\Carbon;

class InternalFilesRepository
{
  protected $internalFiles;
  protected $uploadHelper;

  public function __construct(UploadHelper $upload)
  {
    $this->internalFiles = new MongoModel('internal_files');
    $this->uploadHelper = $upload;
  }

  /*
  *
  * Menampilkan semua attachment di tabel internal_files
  *
  */
  public function getAll() : array
  {
    $files = $this->internalFiles->get([]);
    return $files;
  }

  /*
  *
  * Menampilkan attachment berdasarkan id
  *
  */
  public function getById(string $id)
  {
    $data = $this->internalFiles->find(['_id' => $id]);
		return $data;
  }

  /*
  *
  * Menampilkan attachment berdasarkan id instruction
  *
  */
  public function getByInstruction(string $id)
  {
    $data = $this->internalFiles->get(['instruction_id' => $id]);
		return $data;
  }

  /*
  *
  * Menambah attachment baru
  *
  */
  public function addFileInternal(array $data)
  {
    $fileInternal = [
      'instruction_id' => $data['instruction_id']
    ];    

    if ($data['attachment'] !== null) {
      $createTime = Carbon::now();           
      $filename = $this->uploadHelper->uploadFile($data['attachment']);
      $file = [
        "user" => auth()->user()->name,
        "created_at" => $createTime->toDateTimeString(),
        "file" => $filename
      ];
      $fileInternal["attachment"] = $file;
    }

    $id = $this->internalFiles->save($fileInternal);
    $data = $this->getById($id);
    return $data;
  }

  /*
  *
  * Menghapus attachment
  *
  */
  public function delete(array $data)
  {
    $attachment = isset($data["attachment"]["file"]) ? $data["attachment"]["file"] : null;
    if($attachment)
    {
      $this->uploadHelper->removeFile($attachment);
    }

    $this->internalFiles->deleteQuery($data);
    return $data["_id"];
  }

}

?>
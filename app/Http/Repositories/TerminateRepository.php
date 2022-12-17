<?php

namespace App\Http\Repositories;

use App\Helpers\MongoModel;

class TerminateRepository
{
  private MongoModel $historyModel;
  public function __construct()
  {
    $this->historyModel = new MongoModel('terminate');
  }

  public function getId(string $id)
  {
    $result = $this->historyModel->get(['instruction_id' => $id]);
    return $result;
  }
  
  /*
  * Menyimpan data Terminate
  */
  public function createTerminate($data)
  {
      $newData = [
          'instruction_id' => $data['instruction_id'],
          'attachment' => null,
          'description' => $data['description'],
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
  * Menambahkan history baru di pasangan _id dan instruction_id jika terdapat aktifitas di instruction
  */
  public function save(array $data)
  {
    $this->historyModel->save($data);
  }
}

?>
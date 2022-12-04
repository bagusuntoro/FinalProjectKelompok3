<?php

namespace App\Http\Services;

use App\Http\Repositories\HistoryRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class HistoryService
{
  private HistoryRepository $historyRepository;

    public function __construct()
    {
      $this->historyRepository = new HistoryRepository();
    }

    public function getByInstructionId(string $id)
    {
      $result = $this->historyRepository->getId($id);
      return $result;
    }

    /*
    *
    * Menambahkan history baru di pasangan _id dan instruction_id jika terdapat aktifitas di instruction
    *
    */
    public function create(array $id, string $status)
    {
      $user = auth()->user()->name;
      $id_char = json_encode($id);
      $time = Carbon::now();
      $id = str_replace(array('[',']','"'), '',$id_char);
      
      if ($status == 'On Progress')
      {
        $activity = "Created new instruction";
      } else if ($status == 'Draft')
      {
        $activity = "Added instruction to draft";
      }

      $newData['instruction_id'] = $id;
      $newData['activity'] = $activity;      
      $newData['user'] = $user;
      $newData['timestamp'] = $time->toDateTimeString();
      $this->historyRepository->create($newData);      
    }

    /*
    *
    * Menambahkan data baru di record yang sudah ada ketika terdapat aktivitas di instruction
    *
    */
    public function updateHistory(string $data, string $activity)
    {
      $history = $this->historyRepository->getId($data);
      $user = auth()->user()->name;
      $time = Carbon::now();
     
      $newHistory = isset($history[0]['history_data']) ? $history[0]['history_data'] : [];

      $newHistory[] = [
        '_id' => (string) new \MongoDB\BSON\ObjectId(),
        'activity' => $activity,
        'by_user' => $user,
        'timestamp' => $time->toDateTimeString(),
      ];
      $test['_id'] = $history[0]['_id'];
      $test['instruction_id'] = $history[0]['instruction_id'];
      $test['history_data'] = $newHistory;
      
      $this->historyRepository->save($test);
    }
}

?>
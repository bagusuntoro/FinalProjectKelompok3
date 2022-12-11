<?php 
namespace Mocking\Controller;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
  public function getData()
  {
    $path = base_path()."/Mocking/Json/Final_Project_Collection.json";
    $json = json_decode(file_get_contents($path), true);
    return response()->json($json);
  }
}

?>
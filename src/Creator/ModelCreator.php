<?php
namespace App\Creator;

use App\Console\CreatorInterface as creator;

class ModelCreator implements creator{
  
   public function create() {
     global $argv;
     if( isset($argv[2]) ) {
        $name = ucwords($argv[2]);
        $file = 'src/Models/'.$name.'.php';
        if( file_exists($file) ) {
          echo 'Model already exist!' . PHP_EOL;
        } else {
          $controller = file_put_contents ( $file , $this->template(['className' => $name]) );   
        }
     }
     
   }
  
   public function template($args) {
     return "<?php 
namespace App\Models;

use App\Models\Model;

class {$args['className']} extends Model {

}";
   }
  
}
<?php
namespace App\Creator;

use App\Console\CreatorInterface as creator;

class ControllerCreator implements creator{
  
   public function create() {
     global $argv;
     if( isset($argv[2]) ) {
        $name = ucwords($argv[2]);
        if( !strpos('Controller', $name) ) {
          $name = $name.'Controller';
        }
        $file = 'src/Controllers/'.$name.'.php';
        if( file_exists($file) ) {
          echo 'Controller already exist!' . PHP_EOL;
        } else {
          $controller = file_put_contents ( $file , $this->template(['className' => $name]) );   
        }
     }
     
   }
  
   public function template($args) {
     return "<?php 
namespace Controllers;

use Controllers\Controller;

class {$args['className']} extends Controller {

}";
   }
  
}
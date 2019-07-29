<?php
namespace App\Console;

interface CreatorInterface {
  
   public function create();
  
   public function template($args);
  
}
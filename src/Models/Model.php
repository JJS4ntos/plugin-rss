<?php
namespace App\Models;

class Model{
  
  protected $post_type;
  protected $metas = [];
  
  public function __construct( $post_type = 'post' ) {
    $this->post_type = $post;
  }
  
  private function __call($func, $params){
      if( in_array( $func, $this->metas ) ){
          return 'Test'.$func;
      }
  }
  
}
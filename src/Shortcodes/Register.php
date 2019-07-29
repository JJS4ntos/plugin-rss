<?php
  namespace App\Shortcodes;

  use App\Shortcodes\Names;

  /*
  *   Register shortcode and link to function in controller;
  */
  class Register {

    use Names;

    public function __construct() {
      foreach ($this->names as $name => $function) {
        $this->install($name, $function);
      }
    }

    public function install($name, $function) {
      $meta = explode('@', $function);
      $class = 'App\\Controllers\\'.$meta[0];
      add_shortcode( $name, array( new $class, $meta[1] ) );
    }

  }

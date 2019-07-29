<?php
/*
  Plugin Name: Acervo Digital
  Plugin URI: https://github.com/JJS4ntos
  Description: Plugin criado para integração de site WordPress com Acervo
  Version: ALPHA
  Author: Jair Júnior
  Author URI: https://github.com/JJS4ntos
*/
// If this file is accessed directory, then abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

define('SD_PATH', plugin_dir_url( __FILE__ ));
define('SD_PLUGIN_PATH', plugin_dir_path( __FILE__ ));

require_once 'src/config/setup.php';
require_once 'src/database/install.php';
require_once 'vendor/autoload.php';
require_once 'src/routes.php';

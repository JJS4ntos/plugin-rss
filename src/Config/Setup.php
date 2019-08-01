<?php
namespace App\Config;

use App\Controllers\Controller;

class Setup extends Controller{
  
  public function __construct() {
    parent::__construct();
    add_action('wp_enqueue_scripts', array($this, 'register_assets') );
    add_action('admin_menu', array($this, 'page_setup') );
    add_action('admin_enqueue_scripts', array($this, 'register_assets_admin') );
  }
  
  public function page_setup(){
    add_menu_page( PLUGIN_NAME, PLUGIN_NAME, 'manage_options', sanitize_key(PLUGIN_NAME), array($this, 'admin_page'), 'dashicons-image-filter', 3 );
  }
  
  public function register_assets() {
    $js_folder = SD_PLUGIN_PATH . '/src/assets/js/';
    $css_folder = SD_PLUGIN_PATH . '/src/assets/css/';
    $scripts = scandir($js_folder);
    //var_dump($scripts);
    $styles = scandir($css_folder);
    foreach ($styles as $style) {
      if( !is_dir($style) ) {
        wp_enqueue_style( URL_SCOPE . mt_rand(0, 9000), '/wp-content/plugins/runcinator/src/assets/css/' . $style);
      }
    }
    foreach ($scripts as $script) {
      if( !is_dir($script) ) {
        wp_enqueue_script( URL_SCOPE . mt_rand(0, 9000), '/wp-content/plugins/runcinator/src/assets/js/' . $script);
      }
    }
  }
  
  public function register_assets_admin() {
    $js_folder = SD_PLUGIN_PATH . '/src/assets/admin/js/';
    $css_folder = SD_PLUGIN_PATH . '/src/assets/admin/css/';
    $scripts = scandir($js_folder);
    //var_dump($scripts);
    $styles = scandir($css_folder);
    foreach ($styles as $style) {
      if( !is_dir($style) ) {
        wp_enqueue_style( URL_SCOPE . mt_rand(0, 9000), '/wp-content/plugins/runcinator/src/assets/admin/css/' . $style);
      }
    }
    foreach ($scripts as $script) {
      if( !is_dir($script) ) {
        wp_enqueue_script( URL_SCOPE . mt_rand(0, 9000), '/wp-content/plugins/runcinator/src/assets/admin/js/' . $script);
      }
    }
  }
  
  public function admin_page() {
     echo $this->generateView('index', []); 
  }
  
}

$setup = new Setup();

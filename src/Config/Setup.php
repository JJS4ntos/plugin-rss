<?php
namespace App\Config;

use App\Controllers\Controller;

class Setup extends Controller{

  private $icon = 'dashicons-image-filter';

  /**
   * Call register functions to register pages and assets
   */
  public function __construct() {
    parent::__construct();
    add_action('wp_enqueue_scripts', array($this, 'register_assets') );
    add_action('admin_menu', array($this, 'page_setup') );
    add_action('admin_enqueue_scripts', array($this, 'register_assets_admin') );
    add_action('init', array($this, 'register_config'));
    if ( get_option('rsswk_time_schedule_isEnabled', false) ) {
      $date = new \DateTime(get_option('rsswk_time_schedule', $default), new \DateTimeZone( get_option('timezone_string') ));
      $timestamp = $date->format('U');
      if ( ! wp_next_scheduled( 'rsswkimporter' ) ) {
        wp_schedule_event( $timestamp, 'daily', 'rsswkimporter' );
      }
    }
  }

  /**
   * Register menu link and plugin page
   * @param  string $icon [description]
   * @return
   */
  public function page_setup(){
    add_menu_page( PLUGIN_NAME, PLUGIN_NAME, 'manage_options', sanitize_key(PLUGIN_NAME), array($this, 'admin_page'), $this->icon, 3 );
  }

  /**
   * Register all commons plugin assets
   * @return
   */
  public function register_assets() {
    $js_folder = SD_PLUGIN_PATH . '/src/assets/js/';
    $css_folder = SD_PLUGIN_PATH . '/src/assets/css/';
    $scripts = scandir($js_folder);
    //var_dump($scripts);
    $styles = scandir($css_folder);
    foreach ($styles as $style) {
      if( !is_dir($style) ) {
        wp_enqueue_style( URL_SCOPE . mt_rand(0, 9000), '/wp-content/plugins/'.sanitize_key(PLUGIN_NAME).'/src/assets/css/' . $style);
      }
    }
    foreach ($scripts as $script) {
      if( !is_dir($script) ) {
        wp_enqueue_script( URL_SCOPE . mt_rand(0, 9000), '/wp-content/plugins/'.sanitize_key(PLUGIN_NAME).'/src/assets/js/' . $script);
      }
    }
  }

  /**
   * Register only assets that will be use in admin page
   * @return
   */
  public function register_assets_admin() {
    $js_folder = SD_PLUGIN_PATH . '/src/assets/admin/js/';
    $css_folder = SD_PLUGIN_PATH . '/src/assets/admin/css/';
    $scripts = scandir($js_folder);
    //var_dump($scripts);
    $styles = scandir($css_folder);
    foreach ($styles as $style) {
      if( !is_dir($style) ) {
        wp_enqueue_style( URL_SCOPE . mt_rand(0, 9000), '/wp-content/plugins/'.sanitize_key(PLUGIN_NAME).'/src/assets/admin/css/' . $style);
      }
    }
    foreach ($scripts as $script) {
      if( !is_dir($script) ) {
        wp_enqueue_script( URL_SCOPE . mt_rand(0, 9000), '/wp-content/plugins/'.sanitize_key(PLUGIN_NAME).'/src/assets/admin/js/' . $script);
      }
    }
  }

  public function register_config() {
    $feeds = ['agb', 'investing', 'arp'];
    $options = ['category_', 'author_', 'period_', 'quantity_', 'status_'];
    foreach( $feeds as $feed ) {
      foreach ($options as $option) {
        add_option( $option . $feed );
      }
    }
  }

  /**
   * Generate a view for admin page
   * @return
   */
  public function admin_page() {
     echo $this->generateView('main', []);
  }

}

/**
 * Automatically start plugin after index.php
 * @var Setup
 */
$setup = new Setup();

<?php

require_once 'post_types.php';

function register_assets(){
  $js_folder = SD_PLUGIN_PATH . '/src/assets/js/';
  $css_folder = SD_PLUGIN_PATH . '/src/assets/css/';
  $scripts = scandir($js_folder);
  //var_dump($scripts);
  $styles = scandir($css_folder);
  foreach ($styles as $style) {
    if( !is_dir($style) ) {
      wp_enqueue_style( URL_SCOPE . mt_rand(0, 9000), '/wp-content/plugins/acervo-digital-plugin/src/assets/css/' . $style);
    }
  }
  foreach ($scripts as $script) {
    if( !is_dir($script) ) {
      wp_enqueue_script( URL_SCOPE . mt_rand(0, 9000), '/wp-content/plugins/acervo-digital-plugin/src/assets/js/' . $script);
    }
  }
}


//Set te base url to access endpoints
define('URL_SCOPE', 'acervo-api');

//Register scripts on admin_panel
add_action('admin_enqueue_scripts', function(){
  //wp_enqueue_script( URL_SCOPE, 'script_url' );
});

add_action('wp_enqueue_scripts', 'register_assets');

//Setup page on admin menu
add_action('admin_menu', 'super_dashboard_page_setup');

function super_dashboard_page_setup(){
  add_menu_page( 'Acervo Digital', 'Acervo Digital', 'manage_options', 'acervo-digital', 'page_resource', 'dashicons-image-filter', 3 );
}

function page_resource(){
  echo file_get_contents( SD_PATH . 'frontend/index.php' );
}

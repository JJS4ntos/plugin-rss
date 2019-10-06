<?php
/*
  Plugin Name: RSS WK Importer
  Plugin URI: https://www.workana.com/freelancer/5f13fad6f9579f306054fd2d377c7207?ref=user_dropdown
  Description: Plugin criado para importação de conteúdo de três plataformas
  Version: 1.0.0
  Author: Júnior Santos
  Author URI: https://www.workana.com/freelancer/5f13fad6f9579f306054fd2d377c7207?ref=user_dropdown
*/
// If this file is accessed directory, then abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

define('PLUGIN_NAME', 'RSSWKImporter');
define('SD_PATH', plugin_dir_url( __FILE__ ));
define('SD_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
define('URL_SCOPE', 'rss-importer-wk-api');

require_once 'vendor/autoload.php';
require_once 'src/Config/Setup.php';
require_once 'src/database/install.php';

require_once 'src/routes.php';

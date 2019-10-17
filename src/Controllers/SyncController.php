<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Controllers\FeedController;
use \Feed;

class SyncController extends Controller {

  private function parseRequest($url) {
    try{
      $rss = Feed::loadRss($url);
      $result = [];
      foreach( $rss->item as $item ) {
        $result[] = (array)$item;
      }
      return json_encode($result);
    } catch(FeedException $e) {
      echo "Erro ao carregar feed[$url]: {$e->getMessage()}";
    }
  }

  private function sync_agencia_brasil($url){
    return $this->parseRequest($url);
  }

  public function sync_arena_pavini($url){
    return $this->parseRequest($url, false);
  }

  public function sync_investing($url){
    return $this->parseRequest($url);
  }

  public function sync() {
    if( $_POST ) {
      $contents = [];
      foreach( FeedController::$feeds as $feed ) {
        $url = get_option( 'url_' . $feed );
        $content = [];
        switch($feed) {
          case 'agb':
            $contents['agb'] = $this->sync_agencia_brasil($url);
          break;
          case 'arp':
            $contents['arp'] = [];///$this->sync_arena_pavini($url);
          break;
          case 'investing':
            $contents['investing'] = [];
          break;
        }
      }
      return $contents;
    }
  }

  public function syncCron() {
    wp_insert_post([
      'post_title' => 'Sync Cron funcionando!',
      'post_content' => 'Isso está muito bom!'
    ]);
  }

  public function config() {
    if( $_POST ) {
      $time = $_POST['period'];
      $enabled = $_POST['enable_period'];
      update_option('rsswk_time_schedule', $time);
      update_option('rsswk_time_schedule_isEnabled', $enabled);
    }
    $time = get_option('rsswk_time_schedule', '');
    $enabled = update_option('rsswk_time_schedule_isEnabled', '');
    echo $this->generateView('config', ['period' => $time, 'enabled' => $enabled]);
  }

}

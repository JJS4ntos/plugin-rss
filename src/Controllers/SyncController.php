<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Controllers\FeedController;
use App\Controllers\PostController;
use \Feed;

class SyncController extends Controller {

  private $cron_mode = false;
  private $current_feed = ''; //current feed on cron loop.

  private function cronAdd($item) {
    $postController = new PostController();
    $postController->createFromCron($item, $this->current_feed);
  }

  private function parseRequest($url) {
    try{
      $rss = Feed::loadRss($url);
      $result = [];
      foreach( $rss->item as $item ) {
        if( $this->cron_mode ) {
          $this->cronAdd($item);
        } else {
          $result[] = (array)$item;
        }
      }
      if( !$this->cron_mode ) {
        return json_encode($result);
      }
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
        $contents[$feed] = $this->parseRequest($url);
      }
      return $contents;
    }
  }

  public function syncCron() {
    $this->cron_mode = true;
    foreach( FeedController::$feeds as $feed ) {
      $url = get_option( 'url_' . $feed );
      $this->current_feed = $feed;
      $this->parseRequest($url);
    }
  }

  public function config() {
    if( $_POST ) {
      $time = $_POST['period'];
      $enabled = $_POST['enable_period'];
      update_option('rsswk_time_schedule', $time);
      update_option('rsswk_time_schedule_isEnabled', $enabled);
    }
    $time = get_option('rsswk_time_schedule', '');
    $enabled = get_option('rsswk_time_schedule_isEnabled', '0');
    echo $this->generateView('config', ['period' => $time, 'enabled' => $enabled]);
  }

}

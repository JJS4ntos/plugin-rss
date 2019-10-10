<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Controllers\FeedController;


class SyncController extends Controller {

  private function parseRequest($url, $json_format = true){
    if(empty($url)){
      return false;
    }
    $content = file_get_contents($url);
    $result = simplexml_load_string($content);
    if( $json_format ) {
      $json = json_encode( $result );
      $result = json_decode( $json, true );
    }
    return $result;
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
            $contents['arp'] = $this->sync_arena_pavini($url);
          break;
          case 'investing':
            $contents['investing'] = $this->sync_investing($url);
          break;
        }
      }
      return $contents;
    }
  }

}

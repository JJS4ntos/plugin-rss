<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Controllers\FeedController;

class SyncController extends Controller {

  private function sync_agencia_brasil($url){
    $content = file_get_contents($url);
    $xml = simplexml_load_string($content);
    $json = json_encode( $xml );
    $array = json_decode( $json, true );
    return $array;
  }

  public function sync_arena_pavini($url){

  }

  public function sync_investing($url){

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
      return json_encode($contents);
    }
  }

}

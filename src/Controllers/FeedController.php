<?php
namespace App\Controllers;

use App\Controllers\Controller;

class FeedController extends Controller {

  public static $feeds = ['agb', 'arp', 'investing'];

  public function __construct(){
    parent::__construct();
    $this->saveOptions();
  }

  public function agencia_brasil() {
    $options = $this->getOptions('agb');
    echo $this->generateView('feeds.agencia_brasil', [
      'feed_slug' => 'agb',
      'options' => $options,
      'categories' => get_categories(),
      'users' => get_users(),
    ]);
  }

  public function arena_pavini() {
    $options = $this->getOptions('arp');
    echo $this->generateView('feeds.arena_pavini', [
      'feed_slug' => 'arp',
      'options' => $options,
      'categories' => get_categories(),
      'users' => get_users(),
    ]);
  }

  public function investing() {
    $options = $this->getOptions('investing');
    echo $this->generateView('feeds.investing', [
      'feed_slug' => 'investing',
      'options' => $options,
      'categories' => get_categories(),
      'users' => get_users(),
    ]);
  }

  private function getOptions($feed) {
    $options = [
      'category' => get_option( 'category_'.$feed, '' ),
      'author' => get_option( 'author_'.$feed, '' ),
      'period' => get_option( 'period_'.$feed, '' ),
      'quantity' => get_option( 'quantity_'.$feed, '' ),
      'status' => get_option( 'status_'.$feed, '' ),
      'url' => get_option( 'url_'.$feed, '' ),
    ];
    return $options;
  }

  private function saveOptions() {
    if($_POST) {
      if( isset($_POST['feed_slug']) ) {
        $name = $_POST['feed_slug'];
        update_option( 'category_' . $name,  $_POST['category_id'] );
        update_option( 'author_' . $name,  $_POST['author_id'] );
        update_option( 'period_' . $name, $_POST['period'] );
        update_option( 'status_' . $name,  $_POST['status'] );
        update_option( 'quantity_' . $name,  $_POST['quantity'] );
        update_option( 'url_' . $name,  $_POST['url'] );
      }
    }
  }
}

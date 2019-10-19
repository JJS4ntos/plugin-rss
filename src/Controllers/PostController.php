<?php
namespace App\Controllers;

use App\Controllers\Controller;

class PostController extends Controller {

  public function create(array $args){
    $guid = $args['guid'];
    if( !$this->checkIfExist($guid, $args['title']) ) {
      $tmp = $args['pubDate']; 
      $date = new \DateTime($tmp);
      $data = [
        'post_title' => $args['title'],
        'post_content' => $args['content'],
        'post_date' => $date->format('Y-m-d H:i:s'),
        'post_author' => get_option( 'author_'.$args['feed'], '1' ),
        'post_status' => get_option( 'status_'.$args['feed'], 'draft'),
        'post_category' => [get_option( 'category_'.$args['feed'], '1')],
        //'guid' => $guid
      ];
      $result = wp_insert_post($data);
      update_post_meta( $result, 'guid_rsswk', $guid );
      return '';
    } else {
      echo '<div class="notice notice-warning is-dismissible"><p>"<b>'. $args['title']. '</b>" não foi inserido, pois já existe.</p></div>';
      exit;
    }
  }

  private function validate() {
    return isset($_POST['title']) && isset($_POST['content']) && isset($_POST['feed']) && isset($_POST['pubDate']) && isset($_POST['guid']);
  }

  public function createFromWeb() {
    if( $this->validate() ) {
      $args = [ 
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'feed' => $_POST['feed'],
        'pubDate' => $_POST['pubDate'],
        'guid' => $_POST['guid']
      ];
      return $this->create($args);
    } else {
      return 'Não há dados suficientes para a criação do conteúdo';
    }
  }

  public function createFromCron($item, $feed) {
    $content = $item->description;
    if( empty($item->description) ) {
      if( !empty($item->{'content:encoded'}) ) {
        $content = $item->{'content:encoded'};
      }
    }
    $date = new \DateTime($item->pubDate);
    $args = [ 
      'title' => $item->title,
      'content' => $content,
      'feed' => $feed,
      'pubDate' => $date->format('Y-m-d H:i:s'),
      'guid' => $item->link
    ];
    return $this->create($args);
  }

  private function checkIfExist($guid, $title) {
    global $wpdb;
    $p = $wpdb->prefix;
    return $wpdb->get_results("select count(*) from {$p}posts inner join {$p}postmeta on {$p}postmeta.post_id = {$p}posts.ID where
                              ( {$p}postmeta.meta_key = 'guid_rsswk' AND {$p}postmeta.meta_value = '$guid' )
                              OR {$p}posts.post_title = '{$title}'")[0]->{'count(*)'} > 0;
  }

}

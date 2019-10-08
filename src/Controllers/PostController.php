<?php
namespace App\Controllers;

use App\Controllers\Controller;

class PostController extends Controller {

  public function create(){
    if( $_POST ) {
      if($_POST['feed'] == 'agb') {
        $guid = $_POST['guid'];
        if( !$this->checkIfExist($guid) ) {
          $data = [
            'post_title' => $_POST['title'],
            'post_content' => $_POST['content'],
            'post_author' => get_option( 'author_agb', '1' ),
            'post_status' => get_option( 'status_agb', 'draft'),
            'post_category' => [get_option( 'category_agb', '1')],
            //'guid' => $guid
          ];
          $result = wp_insert_post($data);
          update_post_meta( $result, 'guid_rsswk', $guid );
        } else {
          echo '<div class="notice notice-warning"><p>'. $_POST['title']. '</p></div>';
          exit;
        }
      }
    }
  }

  private function checkIfExist($guid) {
    global $wpdb;
    $p = $wpdb->prefix;
    return $wpdb->get_results("select count(*) from {$p}posts inner join {$p}postmeta on {$p}postmeta.post_id = {$p}posts.ID where
                              {$p}postmeta.meta_key = 'guid_rsswk' AND {$p}postmeta.meta_value = '$guid'")[0]->{'count(*)'} > 0;
  }

}

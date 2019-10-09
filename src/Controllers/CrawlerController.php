<?php
namespace App\Controllers;

use App\Controllers\Controller;
use Symfony\Component\DomCrawler\Crawler;

class CrawlerController extends Controller {

  private function crawlerContent($url, $selector = '.entry-content') {
    try{
      $page = file_get_contents($url);
      $crawler = new Crawler( $page );
      $text = $crawler->filter($selector)->first()->text();
      return $text;
    }catch(Exception $e) {
      echo $e->getMessage();
    }
    return '';
  }

  public function contentBySite(){
    if( isset($_POST['url']) && !empty($_POST['url']) ) {
      return $this->crawlerContent($_POST['url']);
    } else if( isset($_POST['url']) && !empty($_POST['url']) && isset($_POST['selector']) && !empty($_POST['selector']) ) {
      return $this->crawlerContent($_POST['url'], $_POST['selector']);
    }
  }

}

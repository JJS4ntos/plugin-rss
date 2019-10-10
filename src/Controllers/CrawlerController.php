<?php
namespace App\Controllers;

use App\Controllers\Controller;
use Symfony\Component\DomCrawler\Crawler;

class CrawlerController extends Controller {

  private function crawlerContent($url, $selector = '.entry-content') {
    try{
      $page = file_get_contents($url);
      $crawler = new Crawler( $page );
      $text = $crawler->filter($selector)->first()->html('<p></p>');
      $text = str_replace('\n\n\n\n<!-- TESTE ANTES DO POST -->\n\n\n\n\n\n\t\t\t\t<div style=\"margin:0 auto; text-align: center;\"><a href=\"https:\/\/www.arenadopavini.com.br\/inscreva-se\" target=\"_self\" text-decoration=\"none !important;\"><span style=\"background-color:green; color: #fff;padding: 10px; border-radius=5px; \">Quero receber a newsletter gratuitamente<\/span><\/a><\/div>',
                  '', $text);
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

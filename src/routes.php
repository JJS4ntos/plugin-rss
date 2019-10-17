<?php
/**
 * Route controllers to execute functions according urls.
 */
namespace App;

use App\Controllers\RouterController;
use App\Shortcodes\Register;

$register = new Register();
$router = new RouterController();

$router->hook('rsswkimporter', 'SyncController@syncCron');
$router->post('/sync', 'SyncController@sync');
$router->post('/create-post', 'PostController@createFromWeb');
$router->get('/quantities', 'FeedController@getFeedQuantities');
$router->post('/crawler/get-content', 'CrawlerController@contentBySite');
$router->register_admin_page('Agência Brasil', 'rss-wk-agb', 'FeedController@agencia_brasil');
$router->register_admin_page('Arena do Pavini', 'rss-wk-arp', 'FeedController@arena_pavini');
$router->register_admin_page('Investing', 'rss-wk-inv', 'FeedController@investing');
$router->register_admin_page('Configurações', 'rss-wk-config', 'SyncController@config');

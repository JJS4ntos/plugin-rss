<?php
/**
 * Route controllers to execute functions according urls.
 */
namespace App;

use App\Controllers\RouterController;
use App\Shortcodes\Register;

$register = new Register();
$router = new RouterController();

$router->register_admin_page('Sincronizações', 'rss-wk-sync', 'SyncController@syncs');
$router->register_admin_page('Agência Brasil', 'rss-wk-agb', 'FeedController@agencia_brasil');
$router->register_admin_page('Arena do Pavini', 'rss-wk-arp', 'FeedController@arena_pavini');
$router->register_admin_page('Investing', 'rss-wk-inv', 'FeedController@investing');

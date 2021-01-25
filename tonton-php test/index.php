<?php

session_start();
define('__REALPATH__', __DIR__);

/*
 * ================================================================
 * ============== Domain & Uri variables declaration ==============
 * ================================================================
 */

//$domain = '/serveur-web/tonton-php'; // Pour le prof 
$domain = '/php/tonton-php-test'; // Pour le prof
define('DOMAIN', $domain);
$uri = str_replace($domain, '', $_SERVER['REQUEST_URI']);
$uri = explode('?', $uri)[0];
$segments = explode('/', $uri);

/*
 * ================================================================
 * ==================== Tools functions call ======================
 * ================================================================
 */

require_once __REALPATH__ . '/includes/tools/functions.php';

/*
 * ================================================================
 * ======================= Maintenance Mode =======================
 * ================================================================
 */

// Uncomment if down to maintenance mode
//maintenance();

/*
 * ================================================================
 * ====================== Application render ======================
 * ================================================================
 */

isAdmin();
logout();
recordCrud($uri);
$result = crudMode($uri);

$page = get_page($uri, $segments);
require __REALPATH__ . '/includes/common/head.php';
echo getMessage();
echo $page;
require __REALPATH__ . '/includes/common/footer.php';
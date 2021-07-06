<?php
display_errors:1;
errors_reporting:3767;
session_start();
define('URL', str_replace('index.php', '', (isset($_SERVER['HTTPS']) ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

require_once 'controllers/ClassAutoLoader.php';
$classAutoLoader = new \controllers\ClassAutoLoader();
$classAutoLoader->autoLoader();
$router = new \controllers\Router();
$router->routeReq();

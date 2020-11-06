<?php
// включим отображение всех ошибок
ini_set('display_errors',0);
//error_reporting (E_ALL);

session_start();

define('ROOT', dirname(__FILE__));

// подключаем конфиг
require_once(ROOT.'/components/config.php');

require_once (ROOT.'/components/Autoload.php');

// Загружаем router
$router = new Router();
$router->run();
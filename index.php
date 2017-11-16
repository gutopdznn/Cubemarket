<?php

ob_start();

session_start();

date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_MONETARY,"pt_BR", "ptb");

define('DEBUG', true);

define('ROOT', dirname(__FILE__));

define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'simplerezendemvc');

require 'functions.php';
require 'vendor/autoload.php';

$bootstrap = new Bootstrap();
$bootstrap->init();
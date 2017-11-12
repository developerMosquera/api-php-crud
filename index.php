<?php
/**
* @Author: julian
* @Date:   2017-06-06 21:22:10
* @Last Modified by:   julian
* @Last Modified time: 2017-06-06 21:22:10
*/

header('Access-Control-Allow-Origin: *');
/*header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');*/

ini_set('display_errors', 1);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('APP_PATH', ROOT . 'application' . DS);


require APP_PATH . 'Config.php';
require APP_PATH . 'Bootstrap.php';
require APP_PATH . 'Model.php';
require APP_PATH . 'Controller.php';
require APP_PATH . 'Database.php';

Bootstrap::run();
?>
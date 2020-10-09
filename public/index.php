<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require $path . "/../services/Autoload.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
echo '<hr>';


use app\services\Autoload;

spl_autoload_register([new Autoload(), 'loadClass']);


//get url
$controllerName = $_GET['c'] ?: 'users';
$actionName = $_GET['a'];

$controllerClass = "app\controllers\\" . ucfirst($controllerName) . "Controller";
//end url

if(class_exists($controllerClass)) {
    $controller = new $controllerClass;
    $controller->run($actionName);
}else {
    echo "<h1>Else. controllerClass:</h1>";
    var_dump($controllerClass);

}


?>


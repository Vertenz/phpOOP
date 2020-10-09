<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require $path . "/../services/Autoload.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
echo '<hr>';



require_once "../vendor/autoload.php";

//$loader = new Twig\Loader\ArrayLoader(['index' => 'Hello {{ name }}']);
//$twig = new Twig\Environment($loader);
//echo $twig->render('index', ['name' => 'Fabien']);
//get url
$controllerName = $_GET['c'] ?: 'users';
$actionName = $_GET['a'];

$controllerClass = "app\controllers\\" . ucfirst($controllerName) . "Controller";
//end url

//twig



if(class_exists($controllerClass)) {
    $controller = new $controllerClass;
    $controller->run($actionName);
}else {
    echo "<h1>Else. controllerClass:</h1>";
    var_dump($controllerClass);

}


?>


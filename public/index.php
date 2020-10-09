<?php


require_once "../vendor/autoload.php";

//sessinon block
$session = new \app\services\Session();
$session->session();
//session block end
echo "session";
var_dump($_SESSION);
echo "end session";
echo '<hr>';
echo '<hr>';


$request = new \app\services\Request();
$controllerName = $request->getControllerName() ?: 'users';

$controllerClass = "app\controllers\\" . ucfirst($controllerName) . "Controller";
//end url

//twig



if(class_exists($controllerClass)) {
    $renderer = new \app\services\TwigRenderServices();
    /** @var \app\controllers\MainController $controller */
    $controller = new $controllerClass($renderer, $request);
    echo $controller->run($request->getActionName());
}else {
    echo "<h1>Else. controllerClass:</h1>";
    var_dump($controllerClass);

}


?>


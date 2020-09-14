<?php
$path = $_SERVER['DOCUMENT_ROOT'];

require $path . "/../services/Autoload.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
echo '<hr>';


use app\services\Autoload;

$testAutoloder = spl_autoload_register([new Autoload(), 'loadClass']);

var_dump($testAutoloder);

$admin = new \app\models\User();
var_dump($admin);

$userCart = new \app\models\Cart();
var_dump($userCart);


?>


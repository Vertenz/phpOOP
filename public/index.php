<?php
$path = $_SERVER['DOCUMENT_ROOT'];

require $path . "/../services/Autoload.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
echo '<hr>';


use app\services\Autoload;

spl_autoload_register([new Autoload(), 'loadClass']);

$good = new \app\models\Product();
$goodModel = $good->save();
echo '<hr>';



?>


<?php
//TODO ДЗ 1) пользователь, верефикация. 2) добавления карзины в базу данных 3) для админа все заказы
require_once "../vendor/autoload.php";
$config = include_once dirname(__DIR__).'/main/config.php';
\app\main\App::call()->run($config);


?>


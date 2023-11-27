<?php
session_start();
include_once('Configuration.php');

$configuration = new Configuration();
$router = $configuration->getRouter();


if($_SESSION["usuario"]==NULL){
    $module = $_GET['module'] ?? 'user';
    $method = $_GET['action'] ?? 'RenderLogin';
}else
{
    $module = $_GET['module'] ?? 'user';
    $method = $_GET['action'] ?? 'home';
}

$router->route($module, $method);




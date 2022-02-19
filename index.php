<?php
require_once __DIR__.'/./Route.php';


$route = new Route();
$route->add("/", "pages/form.php");
$route->add("/inserUser","inserUser.php");
$route->add("/user/{id}","pages/user.php");
$route->notFound("pages/404.php")
?>

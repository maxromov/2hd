<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('2HD_PUBLIC_ROOT', __DIR__);

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

//$app['debug'] = true;
//$app['cache'] = false;

$app->get('/orders/{id}', function ($id) use ($app) {

  return $app->json($app['db']->fetchAssoc("SELECT * FROM `Order` WHERE id = {$id}"));

})->assert('id', '\d+');

$app->get('/orders/', function () use ($app) {

  return $app->json($app['db']->fetchAll("SELECT * FROM `Order`"));

});



require __DIR__ . '/../app/config/dev.php';
require __DIR__ . '/../src/app.php';
require __DIR__ . '/../src/routes.php';


$app->run();

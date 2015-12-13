<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;

$app = new Silex\Application();

require __DIR__ . '/../app/config/live.php';
require __DIR__ . '/../src/core.php';

$app->post('/orders/create', function() use($app) {
    $sql = "INSERT INTO Order (creation_date)
            VALUES (:date)";

            $app['db']->insert('Order', array(
      'creation_date' => time()
    ));

/*

    $student = $app['db']->prepare($sql);
    $student->bindValue(':date', time(), PDO::PARAM_STR);

    $student->execute();
*/
    return "insert successful";
});





//$app['http_cache']->run();

$app->run();
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

require __DIR__ . '/../app/config/live.php';
require __DIR__ . '/../src/core.php';

$app['http_cache']->run();

/*

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../app/config/dev.php';
require __DIR__ . '/../src/app.php';
require __DIR__ . '/../src/routes.php';

$app = new Silex\Application();

// Get all
$app->get('/orders/{id}', function ($id) use ($app) {
    return $app->json($app['db']->fetchAssoc("SELECT * FROM `Order` WHERE id = {$id}"));
})->assert('id', '\d+');

// Get one
$app->get('/orders/', function () use ($app) {
    $sql = "SELECT `o`.*, `s`.address, `s`.company_name FROM `Order` `o` LEFT JOIN `Seller` `s` ON `s`.`id` = `o`.`Seller_id`";
    return $app->json($app['db']->fetchAll($sql));
});


$app->post('/feedback', function (Request $request) {
    $message = $request->get('message');
    mail('feedback@example.com', '[YourSite] Feedback', $message);
 
    return new Response('Thank you for your feedback!', 201);
});

// Post data
$app->post('/orders', function (Symfony\Component\HttpFoundation\Request $request) use ($app) {
    $post = array(
        'delivery_address' => $request->request->get('delivery_address'),
        'package_cost'  => $request->request->get('package_cost'),
        'delivery_cost'  => $request->request->get('delivery_cost')
    );

    //$post['id'] = createPost($post);

    
     
     // Useful to return the newly added details
     // HTTP_CREATED = 200
    //return new Symfony\Component\HttpFoundation\Response(json_encode($post), HTTP_CREATED);

    return $app->json($post, 201);
});

// Delete order
$app->delete('/orders/{order}', function (Silex\Application $app, Request $request, $order) {
     
     if (delete_toy($order)) {
         // The delete went ok and we can now return a no content value
         // HTTP_NO_CONTENT = 204
         $responseMessage = '';
         $responseCode = Symfony\Component\HttpFoundation\Response::HTTP_NO_CONTENT;
     } else {
         // Something went wrong
         $responseMessage = 'reason for error';
         $response_code = Symfony\Component\HttpFoundation\Response::HTTP_INTERNAL_SERVER_ERROR;
     }
     
     return new Symfony\Component\HttpFoundation\Response($responseMessage, $responseCode);
 });


$app->run();
*/
<?php

// Register route converters.
// Each converter needs to check if the $id it received is actually a value,
// as a workaround for https://github.com/silexphp/Silex/pull/768.
$app['controllers']->convert('order', function ($id) use ($app) {
    if ($id) {
        return $app['repository.order']->find($id);
    }
});

// API
$app->get('/api/order', 'api\Controller\OrderController::indexAction');
$app->get('/api/order/{order}', 'api\Controller\OrderController::viewAction');
$app->post('/api/order', 'api\Controller\OrderController::addAction');
$app->put('/api/order/{order}', 'api\Controller\OrderController::editAction');
$app->delete('/api/order/{order}', 'api\Controller\OrderController::deleteAction');

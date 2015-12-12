<?php

namespace api\Controller;

use api\Entity\Order;
use api\Repository\OrderRepository;
use Silex\Application;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController 
{
	public function indexAction(Request $request, Application $app)
    {
        $limit = $request->query->get('limit', 20);
        $offset = $request->query->get('offset', 0);

        $orders = $app['repository.order']->findAll($limit, $offset);

        
        /*
        $data = [];
        foreach ($orders as $order) {
            $data[] = [
                'id' => $order->getId(),
                'name' => $order->getName(),
                'short_biography' => $order->getShortBiography(),
                'biography' => $order->getBiography(),
                'soundcloud_url' => $order->getSoundCloudUrl(),
                'likes' => $order->getLikes(),
            ];
        }*/

		return $app->json($orders);
        //return $app->json($data);
    }

    public function viewAction(Request $request, Application $app)
    {
    	return $app->json('asdasd');
    }

    public function addAction(Request $request, Application $app)
    {
        if (!$request->request->has('name')) {
            return $app->json('Missing required parameter: name', 400);
        }

        if (!$request->request->has('short_biography')) {
            return $app->json('Missing required parameter: short_biography', 400);
        }

        $order = new Order();
        $order->setName($request->request->get('name'));
        $order->setShortBiography($request->request->get('short_biography'));
        $order->setBiography($request->request->get('biography'));
        $order->setSoundCloudUrl($request->request->get('soundcloud_url'));
        $app['repository.order']->save($order);

        $headers = ['Location' => '/api/order/' . $order->getId()];
        return $app->json('Created', 201, $headers);
    }

    public function editAction(Request $request, Application $app)
    {
        $order = $request->attributes->get('order');

        if (!$order) {
            return $app->json('Not Found', 404);
        }

        if (!$request->request->has('name')) {
            return $app->json('Missing required parameter: name', 400);
        }

        if (!$request->request->has('short_biography')) {
            return $app->json('Missing required parameter: short_biography', 400);
        }

        $order->setName($request->request->get('name'));
        $order->setShortBiography($request->request->get('short_biography'));
        $order->setBiography($request->request->get('biography'));
        $order->setSoundCloudUrl($request->request->get('soundcloud_url'));

        $app['repository.order']->save($order);

        return $app->json('OK', 200);
    }

    public function deleteAction(Request $request, Application $app)
    {
        $order = $request->attributes->get('order');

        if (!$order) {
            return $app->json('Not Found', 404);
        }

        $app['repository.order']->delete($order);

        return $app->json('No Content', 204);
    }
}

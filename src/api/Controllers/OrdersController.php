<?php

namespace api\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrdersController
{
    protected $ordersService;

    public function __construct($service)
    {
        $this->ordersService = $service;
    }

    public function getAll()
    {
        return new JsonResponse($this->ordersService->getAll());
    }

    public function get($id)
    {
        return new JsonResponse($this->ordersService->getById($id));
    }

    public function save(Request $request)
    {
        $order = $this->getDataFromRequest($request);
        return new JsonResponse(array("id" => $this->ordersService->save($order)));
    }

    public function update($id, Request $request)
    {
        $order = $this->getDataFromRequest($request);
        //$this->ordersService->update($id, $order);
        
        return new JsonResponse($order);
    }

    public function delete($id)
    {
        return new JsonResponse($this->ordersService->delete($id));
    }
    
    public function getDataFromRequest(Request $request)
    {
        return $delivery_cost = [
            "delivery_cost" => $request->request->get("delivery_cost")
        ];
    }
}

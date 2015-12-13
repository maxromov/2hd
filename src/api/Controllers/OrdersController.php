<?php

namespace api\Controllers;

use Silex\Application;

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
        $request = 5;
        $order = $this->getDataFromRequest($request);

        
        return new JsonResponse(array("id" => $this->ordersService->save($order)));
    }

    public function update($id, Request $request)
    {
        $order = $this->getDataFromRequest($request);
        $this->ordersService->update($id, $order);
        
        return new JsonResponse($order);
    }

    public function delete($id)
    {
        return new JsonResponse($this->ordersService->delete($id));
    }
    
    public function getDataFromRequest($request)
    {
    
        $data = [
            '5' => [
                'orders' => [
                    'creation_date' => time(),
                ],
                'status' => [
                    'Courier_id' => '',
                    'Seller_id' => '',
                    'creation_date' => '',
                    'delivery_address' => '',
                    'delivery_cost' => '',
                    'package_cost' => '',
                ],
                'courier' => [
                    'first_name' => '',
                    'last_name' => '',
                    'phone_number' => '',
                ],
                'seller' => [
                    'address' => '',
                    'company_name' => '',
                    'email' => '',
                    'id' => '',
                    'password' => '',
                    'phone_number' => ''
                ]
            ],
            '6' => [
                'orders' => [
                    'creation_date' => '',
                    'delivery_address' => '',
                    'Seller_id' => '',
                    'Courier_id' => '',
                    'package_cost' => '',
                    'delivery_cost' => ''
                ],
                'status' => [
                    'Courier_id' => '',
                    'Seller_id' => '',
                    'creation_date' => '',
                    'delivery_address' => '',
                    'delivery_cost' => '',
                    'package_cost' => '',
                ],
                'courier' => [
                    'id' => '',
                    'first_name' => '',
                    'last_name' => '',
                    'phone_number' => '',
                ],
                'seller' => [
                    'address' => '',
                    'company_name' => '',
                    'email' => '',
                    'id' => '',
                    'password' => '',
                    'phone_number' => ''
                ]
            ],
            '7' => [
                'orders' => [
                    'id' => '',
                    'creation_date' => '',
                    'delivery_address' => '',
                    'Seller_id' => '',
                    'Courier_id' => '',
                    'package_cost' => '',
                    'delivery_cost' => ''
                ],
                'status' => [
                    'Courier_id' => '',
                    'Seller_id' => '',
                    'creation_date' => '',
                    'delivery_address' => '',
                    'delivery_cost' => '',
                    'package_cost' => '',
                ],
                'courier' => [
                    'id' => '',
                    'first_name' => '',
                    'last_name' => '',
                    'phone_number' => '',
                ],
                'seller' => [
                    'address' => '',
                    'company_name' => '',
                    'email' => '',
                    'id' => '',
                    'password' => '',
                    'phone_number' => ''
                ]
            ],
        ];

        return $data[$request]['orders'];
    }
}

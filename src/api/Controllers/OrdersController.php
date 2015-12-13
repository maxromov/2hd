<?php

namespace api\Controllers;

use Silex\Application;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrdersController
{
    protected $ordersService;
    protected $db;

    public function __construct($service, $db)
    {
        $this->ordersService = $service;
        $this->db = $db;
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
        $request = rand(1,5);
        $order = $this->getDataFromRequest($request);

        //$this->db->insert("`Order`", $order);

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
        $currTime = 1000 * time();
    
        $data = [
            '1' => [
                'orders' => [
                    'creation_date' => $currTime,
                    'delivery_address' => 'Киев, Березова, 8',
                    'Seller_id' => '1',
                    'Courier_id' => '1',
                    'package_cost' => '1000',
                    'delivery_cost' => '100'
                ]
            ],
            '2' => [
                'orders' => [
                    'creation_date' => time(),
                    'delivery_address' => 'Киев, Студентская, 22',
                    'Seller_id' => '1',
                    'Courier_id' => '1',
                    'package_cost' => '1200',
                    'delivery_cost' => '110'
                ]
            ],
            '3' => [
                'orders' => [
                    'creation_date' => time(),
                    'delivery_address' => 'Киев, Борщаговская, 38',
                    'Seller_id' => '1',
                    'Courier_id' => '1',
                    'package_cost' => '1000',
                    'delivery_cost' => '10'
                ]
            ],
            '4' => [
                'orders' => [
                    'creation_date' => time(),
                    'delivery_address' => 'Киев, Старокиевская, 18',
                    'Seller_id' => '1',
                    'Courier_id' => '1',
                    'package_cost' => '1200',
                    'delivery_cost' => '110'
                ]
            ],
            '5' => [
                'orders' => [
                    'creation_date' => time(),
                    'delivery_address' => 'Киев, Вокзальная, 198',
                    'Seller_id' => '1',
                    'Courier_id' => '1',
                    'package_cost' => '1000',
                    'delivery_cost' => '10'
                ]
            ],
        ];

        return $data[$request]['orders'];
    }
}

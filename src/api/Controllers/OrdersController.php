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

        header('Location: http://2hd.com.ua');
        //return new JsonResponse(array("id" => $this->ordersService->save($order)));
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
            '1' => [
                'orders' => [
                    'creation_date' => time() * 1000,
                    'delivery_address' => 'Киев, Березова, 8',
                    'Seller_id' => '1',
                    'Courier_id' => '1',
                    'package_cost' => '1000',
                    'delivery_cost' => '100',
                    'status_order' => 'создано'
                ]
            ],
            '2' => [
                'orders' => [
                    'creation_date' => time() * 1000,
                    'delivery_address' => 'Киев, Студентская, 22',
                    'Seller_id' => '1',
                    'Courier_id' => '1',
                    'package_cost' => '1200',
                    'delivery_cost' => '110',
                    'status_order' => 'создано'
                ]
            ],
            '3' => [
                'orders' => [
                    'creation_date' => time() * 1000,
                    'delivery_address' => 'Киев, Борщаговская, 38',
                    'Seller_id' => '1',
                    'Courier_id' => '1',
                    'package_cost' => '1000',
                    'delivery_cost' => '10',
                    'status_order' => 'создано'
                ]
            ],
            '4' => [
                'orders' => [
                    'creation_date' => time() * 1000,
                    'delivery_address' => 'Киев, Старокиевская, 18',
                    'Seller_id' => '1',
                    'Courier_id' => '1',
                    'package_cost' => '1200',
                    'delivery_cost' => '110',
                    'status_order' => 'создано'
                ]
            ],
            '5' => [
                'orders' => [
                    'creation_date' => time() * 1000,
                    'delivery_address' => 'Киев, Вокзальная, 198',
                    'Seller_id' => '1',
                    'Courier_id' => '1',
                    'package_cost' => '1000',
                    'delivery_cost' => '10',
                    'status_order' => 'создано'
                ]
            ],
            '6' => [
                'orders' => [
                    'creation_date' => time() * 1000,
                    'delivery_address' => 'Киев, xxxxxxxxx, 8',
                    'Seller_id' => '1',
                    'Courier_id' => '1',
                    'package_cost' => '1000',
                    'delivery_cost' => '100',
                    'status_order' => 'создано'
                ]
            ],
        ];

        return $data[$request]['orders'];
    }
}

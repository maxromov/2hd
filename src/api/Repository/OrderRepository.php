<?php

namespace api\Repository;

use Doctrine\DBAL\Connection;
use api\Entity\Order;

/**
 * Order repository
 */
class OrderRepository implements RepositoryInterface
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }
    
    /**
     * Saves the orders to the database.
     *
     * @param \MusicBox\Entity\Order $order
     */
    public function save($order)
    {
        $orderData = [
            'name' => $order->getName(),
            'short_biography' => $order->getShortBiography(),
            'biography' => $order->getBiography(),
            'soundcloud_url' => $order->getSoundCloudUrl(),
            'image' => $order->getImage(),
        ];

        if ($order->getId()) {
            $this->db->update('orders', $orderData, array('order_id' => $order->getId()));
        } else {
            // The order is new, note the creation timestamp.
            $orderData['created_at'] = time();
            $this->db->insert('orders', $orderData);
            
            // Get the id of the newly created order and set it on the entity.
            $id = $this->db->lastInsertId();
            $order->setId($id);
            
            if ($newFile) {
                $newData = array('image' => $order->getImage());
                $this->db->update('orders', $newData, array('order_id' => $id));
            }
        }
    }

    /**
     * Deletes the order.
     *
     * @param \MusicBox\Entity\order $order
     */
    public function delete($order)
    {
        // If the order had an image, delete it.
        $image = $order->getImage();
        if ($image) {
            unlink('images/orders/' . $image);
        }
        return $this->db->delete('orders', array('order_id' => $order->getId()));
    }

    /**
     * Returns the total number of orders.
     *
     * @return integer The total number of orders.
     */
    public function getCount() 
    {
        return $this->db->fetchColumn('SELECT COUNT(order_id) FROM orders');
    }

    /**
     * Returns an order matching the supplied id.
     *
     * @param integer $id
     *
     * @return \MusicBox\Entity\order|false An entity object if found, false otherwise.
     */
    public function find($id)
    {
        $orderData = $this->db->fetchAssoc('SELECT * FROM orders WHERE order_id = ?', array($id));
        return $orderData ? $this->buildorder($orderData) : FALSE;
    }

    /**
     * Returns a collection of orders, sorted by name.
     *
     * @param integer $limit
     *   The number of orders to return.
     * @param integer $offset
     *   The number of orders to skip.
     * @param array $orderBy
     *   Optionally, the order by info, in the $column => $direction format.
     *
     * @return array A collection of orders, keyed by order id.
     */
    public function findAll($limit, $offset = 0, $orderBy = array())
    {
        // Provide a default orderBy.
        if (!$orderBy) {
            $orderBy = array('name' => 'ASC');
        }
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('a.*')
            ->from('orders', 'a')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->orderBy('a.' . key($orderBy), current($orderBy));
        $statement = $queryBuilder->execute();
        $ordersData = $statement->fetchAll();
        $orders = array();
        foreach ($ordersData as $orderData) {
            $orderId = $orderData['order_id'];
            $orders[$orderId] = $this->buildorder($orderData);
        }
        return $orders;
    }

    /**
     * Instantiates an order entity and sets its properties using db data.
     *
     * @param array $orderData
     *   The array of db data.
     *
     * @return \MusicBox\Entity\order
     */
    protected function buildorder($orderData)
    {
        $order = new order();
        $order->setId($orderData['order_id']);
        $order->setName($orderData['name']);
        $order->setShortBiography($orderData['short_biography']);
        $order->setBiography($orderData['biography']);
        $order->setSoundCloudUrl($orderData['soundcloud_url']);
        $order->setImage($orderData['image']);
        $order->setLikes($orderData['likes']);
        $createdAt = new \DateTime('@' . $orderData['created_at']);
        $order->setCreatedAt($createdAt);
        return $order;
    }
}

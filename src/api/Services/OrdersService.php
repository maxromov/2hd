<?php

namespace api\Services;

class OrdersService extends BaseService
{
    public function getAll()
    {
        return $this->db->fetchAll("SELECT * FROM `Order`");
    }

    public function getById($id)
    {
        return $this->db->fetchAll("SELECT * FROM `Order` WHERE id = ?", array($id));
    }

    function save($order)
    {
        $this->db->insert("Order", $order);
        return $this->db->lastInsertId();
    }

    function update($id, $order)
    {
        return $this->db->update('Order', $order, ['id' => $id]);
    }

    function delete($id)
    {
        return $this->db->delete("Order", array("id" => $id));
    }
}

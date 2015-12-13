<?php

namespace api\Services;

class OrdersService extends BaseService
{
    public function getAll()
    {
        return $this->db->fetchAll("SELECT `o`.*, `s`.`address` as `from_address` FROM `Order` `o` LEFT JOIN `Seller` `s` ON s.id = o.Seller_id");
    }

    public function getById($id)
    {
        return $this->db->fetchAll("SELECT `o`.*, `s`.`address` as `from_address` FROM `Order` `o` LEFT JOIN `Seller` `s` ON s.id = o.Seller_id WHERE o.id = ?", array($id));
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

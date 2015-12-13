<?php

namespace api\Services;

class OrdersService extends BaseService
{
    public function getAll()
    {
        $sql = "SELECT 
                    `o`.*, `s`.`address` as `from_address`, 
                    CONCAT(`c`.`first_name`, ' ', `c`.`last_name`) as `courier_name`, 
                    `c`.`phone_number`, `h`.`Order_Status` as `order_status`
                FROM `Order` `o` 
                LEFT JOIN `Seller` `s` ON s.id = o.Seller_id
                LEFT JOIN `Courier` `c` ON c.id = o.Courier_id
                LEFT JOIN `Order_History` `h` ON h.Order_id = o.id
                ORDER BY `o`.`creation_date` DESC";
        return $this->db->fetchAll($sql);
    }

    public function getById($id)
    {
        $sql = "SELECT 
                    `o`.*, `s`.`address` as `from_address`, 
                    CONCAT(`c`.`first_name`, ' ', `c`.`last_name`) as `courier_name`, 
                    `c`.`phone_number`, `h`.`Order_Status` as `order_status`
                FROM `Order` `o` 
                LEFT JOIN `Seller` `s` ON s.id = o.Seller_id
                LEFT JOIN `Courier` `c` ON c.id = o.Courier_id
                LEFT JOIN `Order_History` `h` ON h.Order_id = o.id
                WHERE o.id = ?";
        return $this->db->fetchAll($sql, array($id));
    }

    function save($order)
    {        
        $this->db->insert("Order", $order);

        //$curr_time = time();
        //$sql = "INSERT INTO `Order`('creation_date','Courier_id','Seller_id','delivery_address','delivery_cost','package_cost') 
        //        VALUES(\'{$curr_time}\',\'{$order['Courier_id']}\',\'{$order['Seller_id']}\',\'{$order['delivery_address']}\',\'{$order['delivery_cost']}\',\'{$order['package_cost']}\')";

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

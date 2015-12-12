<?php

namespace api\Services;

class NotesService extends BaseService
{
    public function getAll()
    {
        return $this->db->fetchAll("SELECT * FROM `Order`");
    }

    function save($note)
    {
        $this->db->insert("Order", $note);
        return $this->db->lastInsertId();
    }

    function update($id, $note)
    {
        return $this->db->update('Order', $note, ['id' => $id]);
    }

    function delete($id)
    {
        return $this->db->delete("Order", array("id" => $id));
    }
}
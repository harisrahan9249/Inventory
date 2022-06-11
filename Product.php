<?php

class Product
{
    public $id = null;
    public $item = null;
    public $price = null;
    public $quantity = null;

    private function insert()
    {
        $query = "INSERT INTO `product` (`item`, `price`,`quantity`) VALUES (?, ?,?)";

        DB::insert($query, [$this->item, $this->price,$this->quantity,]);
        $this->id = DB::lastInsertId();
    }

    private function update()
    {
        $query = "UPDATE `product` SET `item` = ?, `price` = ?, `quantity` = ? WHERE `id` = ?";

        DB::update($query, [$this->item, $this->price,$this->quantity, $this->id]);
    }

    public function save()
    {
        if (isset($this->id)) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    public function delete()
    {
        $query = "DELETE FROM `product` WHERE `id` = ?";

        DB::delete($query, [$this->id]);
    }
}
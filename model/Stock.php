<?php

class Stock implements ApiInterface
{
    private $stock_id;
    private $product_id;
    private $stock_count;

    public function __construct($data)
    {
        $this->stock_id = $data['stock_id'];
        $this->product_id = $data['product_id'];
        $this->stock_count = $data['stock_count'];

    }

    public function getId()
    {
        return $this->stock_id;
    }
    public function getProdcutId()
    {
        return $this->product_id;
    }
    public function getStockcount()
    {
        return $this->stock_count;
    }




    public function save()
    {
        $retry_control = DB::get("select product_id from stocks where product_id=?", array($this->getProdcutId()));
        if (count($retry_control) > 0) {
            return json_encode(["status" => 300, "message" => "Bu Ürüne Stok Eklenmiş"]);
        } else {

            $stock_add = DB::insert("insert into stocks(product_id,stock_count) 
              values (?,?)", array($this->getProdcutId(), $this->getStockcount()));

            if ($stock_add) {
                return json_encode(["status" => 200, "message" => "Stok Ekleme Başarılı"]);
            } else {
                return json_encode(["status" => 300, "message" => "Hata"]);
            }
        }
    }

    public function update()
    {
        $stock_update = DB::exec("Update stocks set stock_count=? where product_id=?", array($this->getStockcount(), $this->getProdcutId()));
        if ($stock_update) {
            return json_encode(["status" => 200, "message" => "Stok Güncelleme Başarılı"]);
        } else {
            return json_encode(["status" => 300, "message" => "Hata"]);
        }

    }

    public function delete()
    {
        $stock_delete = DB::exec("Delete from stocks where product_id=?", array($this->getProdcutId()));
        if ($stock_delete) {
            return json_encode(["status" => 200, "message" => "Stok Silme Başarılı"]);
        } else {
            return json_encode(["status" => 300, "message" => "Hata"]);
        }
    }





}
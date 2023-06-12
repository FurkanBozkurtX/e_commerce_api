<?php

class StockController
{

    public function stock_add($data)
    {
        $stock = new Stock($data);
        return $stock->save();
    }

    public function stock_edit($data)
    {
        $stock = new Stock($data);
        return $stock->update();
    }

    public function stock_delete($data)
    {
        $stock = new Stock($data);
        return $stock->delete();
    }




}
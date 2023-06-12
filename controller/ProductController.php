<?php
class ProductController
{

    public function product_add($data)
    {
        $product = new Product($data);
        return $product->save();

    }

    public function product_edit($data)
    {
        $product = new Product($data);
        return $product->update();
    }

    public function product_delete($data)
    {
        $product = new Product($data);
        return $product->delete();
    }

    public function product_to_category($data)
    {
        $product = new Product($data);
        return $product->list();
    }


    public function product_search($data)
    {
        $product = new Product($data);
        return $product->search();
    }

    public function product_stock($data)
    {
        $product = new Product($data);
        return $product->filter();
    }

    public function product_empty_control($data)
    {
        if (!empty($data)) {

            $this->product_field_control($data);
        } else {
            return json_encode(["status" => 400, "message" => "Lütfen Gerekli Alanları Doldurunuz"]);
        }

    }

    public function product_field_control($data)
    {

        $field_control = array_keys(array_filter($data, function ($value) {
            return empty($value);
        }));
        if (count($field_control) > 0) {
            return false;
        } else {

            $this->product_number_control($data);
        }

    }

    public function product_number_control($data)
    {
        $number_control = array('product_price', 'product_size', 'category_id');
        foreach ($number_control as $number_key) {
            if (isset($data[$number_key]) && is_numeric($data[$number_key])) {
                return true;
            } else {

                return false;
            }
        }
    }




}
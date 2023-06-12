<?php
class Product implements ApiInterface
{
    private $product_id;
    private $product_name;
    private $product_description;
    private $category_id;
    private $product_price;
    private $image_url;
    private $product_color;
    private $product_size;
    private $product_weight;
    private $product_stock_id;
    private $cat_id;
    private $search;
    private $stock_count;

    public function __construct($data)
    {
        $this->product_id = $data['product_id'];
        $this->product_name = $data['product_name'];
        $this->product_description = $data['product_description'];
        $this->category_id = $data['category_id'];
        $this->product_price = $data['product_price'];
        $this->image_url = $data['image_url'];
        $this->product_color = $data['product_color'];
        $this->product_size = $data['product_size'];
        $this->product_weight = $data['product_weight'];
        $this->product_stock_id = $data['product_stock_id'];
        $this->cat_id = $data['cat_id'];
        $this->search = $data['search'];
        $this->stock_count = $data['stock_count'];

    }

    public function getId()
    {
        return $this->product_id;
    }
    public function getCategoryId()
    {
        return $this->cat_id;
    }
    public function getName()
    {
        return $this->product_name;
    }

    public function getDescription()
    {
        return $this->product_description;
    }

    public function getCategory()
    {
        return $this->category_id;
    }

    public function getPrice()
    {
        return $this->product_price;
    }

    public function getImage()
    {
        return $this->image_url;
    }

    public function getColor()
    {
        return $this->product_color;
    }

    public function getSize()
    {
        return $this->product_size;
    }
    public function getWeight()
    {
        return $this->product_weight;
    }
    public function getStock()
    {
        return $this->product_stock_id;
    }

    public function getSearch()
    {
        return $this->search;
    }

    public function getStockCount()
    {
        return $this->stock_count;
    }


    public function save()
    {
        $retry_control = DB::get("select name from products where name=?", array($this->getName()));
        if (count($retry_control) > 0) {
            return json_encode(["status" => 300, "message" => "Bu Ürün daha Önce Eklenmiş"]);
        } else {
            $product_add = DB::insert("insert into products (name,description,category_id,price,image_url
            ,color,size,weight,stock_id,status) values(?,?,?,?,?,?,?,?,?,?)", array(
                    $this->getName(), $this->getDescription(),
                    $this->getCategory(), $this->getPrice(), $this->getImage(), $this->getColor(), $this->getSize(), $this->getWeight(), $this->getStock(),
                    1
                )
            );
            if ($product_add) {
                return json_encode(["status" => 200, "message" => "Ürün Ekleme Başarılı"]);
            } else {
                return json_encode(["status" => 300, "message" => "Hata"]);
            }
        }
    }

    public function update()
    {
        $product_update = DB::exec("update products set name=?,description=?,category_id=?,price=?,image_url=?
        ,color=?,size=?,weight=?,stock_id=?,status=? where id=?", array(
                $this->getName(), $this->getDescription(),
                $this->getCategory(), $this->getPrice(), $this->getImage(), $this->getColor(), $this->getSize(), $this->getWeight(), $this->getStock(),
                1, $this->getId()
            )
        );
        if ($product_update) {
            return json_encode(["status" => 200, "message" => "Ürün Güncelleme Başarılı"]);
        } else {
            return json_encode(["status" => 300, "message" => "Hata"]);
        }
    }

    public function delete()
    {
        $product_delete = DB::exec("Delete from products where id=?", array($this->getId()));
        if ($product_delete) {
            return json_encode(["status" => 200, "message" => "Ürün Silme Başarılı"]);
        } else {
            return json_encode(["status" => 300, "message" => "Hata"]);
        }
    }

    public function list()
    {
        $product_list = DB::getAll("Select * from products where category_id=?", array($this->getCategoryId()));
        return json_encode($product_list);

    }

    public function search()
    {
        $search_key = $this->getSearch();
        $product_search = DB::getAll("Select * from products where CONCAT(name,description,price,color,size,weight) LIKE '%$search_key%'");
        return json_encode($product_search);
    }

    public function filter()
    {
        $stock_id = DB::get("select product_id from stocks where stock_count=?", array($this->getStockCount()));
        return $this->product_stock($stock_id);
    }

    public function product_stock($stocks)
    {
     
        $stock = [];
        foreach ($stocks as $pr_id) {
            $stock[] = $pr_id->product_id;
        }
        $stock_query_val = implode(",", $stock);
        $product_list = DB::getAll("Select * from products where id IN ($stock_query_val)");
        return json_encode($product_list);
    }
}

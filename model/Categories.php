<?php

class Categories implements ApiInterface
{
    private $category_id;
    private $category_name;
    private $category_slug;
    private $category_description;

    public function __construct($data)
    {
        $this->category_id = $data['category_id'];
        $this->category_name = $data['category_name'];
        $this->category_slug = $data['category_slug'];
        $this->category_description = $data['category_description'];

    }

    public function getId()
    {
        return $this->category_id;
    }
    public function getName()
    {
        return $this->category_name;
    }
    public function getSlug()
    {
        return $this->category_slug;
    }

    public function getDescription()
    {
        return $this->category_description;
    }


    public function save()
    {
        $retry_control = DB::get("select name from categories where name=?", array($this->getName()));
        if (count($retry_control) > 0) {
            return json_encode(["status" => 300, "message" => "Bu kategori daha Önce Eklenmiş"]);
        } else {

            $category_add = DB::insert("insert into categories(name,slug,description,status) 
              values (?,?,?,?)", array($this->getName(), $this->getSlug(), $this->getDescription(), 1));

            if ($category_add) {
                return json_encode(["status" => 200, "message" => "Kategori Ekleme Başarılı"]);
            } else {
                return json_encode(["status" => 300, "message" => "Hata"]);
            }
        }
    }

    public function update()
    {
        $category_update = DB::exec("Update categories set name=?,slug=?,description=?,status=?
              where id=?", array($this->getName(), $this->getSlug(), $this->getDescription(), 1, $this->getId()));
        if ($category_update) {
            return json_encode(["status" => 200, "message" => "Kategori Güncelleme Başarılı"]);
        } else {
            return json_encode(["status" => 300, "message" => "Hata"]);
        }

    }

    public function delete()
    {
        $category_delete = DB::exec("Delete from categories where id=?", array($this->getId()));
        if ($category_delete) {
            return json_encode(["status" => 200, "message" => "Kategori Silme Başarılı"]);
        } else {
            return json_encode(["status" => 300, "message" => "Hata"]);
        }
    }





}
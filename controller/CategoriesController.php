<?php

class CategoriesController
{

    public function category_add($data)
    {


        $category = new Categories($data);

        return $category->save();

    }

    public function category_edit($data)
    {
        $product = new Categories($data);

        return $product->update();
    }

    public function category_delete($data)
    {
        $product = new Categories($data);
        return $product->delete();
    }




}
<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function getAll()
    {
        return Product::all();
    }

    public function getOne($id)
    {
        //find($id): Truy vấn theo khóa chính
        return Product::find($id);
    }

    public function create($data)
    {
        //$data là body
        return Product::create($data);
    }

    public function update($id, $data)
    {
        //where
        $status = Product::where('id', $id)->update($data);
        if (!$status) {
            return false;
        }
        return $this->getOne($id);
    }

    public function delete($id)
    {
        $product = $this->getOne($id);
        $status = Product::where('id', $id)->delete();
        if (!$status) {
            return false;
        }
        return $product;
    }
}

//Mass assignment
<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function getAll($search = '', $limit)
    {
        return Product::where('name', 'like', "%$search%")->paginate($limit);
        //TeenClass::tenhamstatic()
    }

    public function getOne($id)
    {
        //find($id): Truy vấn theo khóa chính
        return Product::find($id);
    }

    public function create($data, $user)
    {
        //$data là body
        return Product::create([
            ...$data,
            'added_by' => $user->id
        ]);
    }

    public function update($id, $data, $user)
    {
        //where
        $status = Product::where('id', $id)->update([
            ...$data,
            'updated_by' => $user->id
        ]);
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
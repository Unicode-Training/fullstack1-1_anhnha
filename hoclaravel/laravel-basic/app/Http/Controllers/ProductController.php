<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService = null;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function index()
    {
        $products = $this->productService->getAll();
        return response()->json([
            'message' => 'Get list product success',
            'success' => true,
            'data' => $products
        ]);
    }

    public function find($id)
    {
        $product = $this->productService->getOne($id);
        if (!$product) {
            return response()->json([
                'message' => 'Get product failed',
                'success' => false,
                'error' => "Product not found"
            ], 404);
        }
        return response()->json([
            'message' => 'Get product success',
            'success' => true,
            'data' => $product
        ]);
    }

    public function create(Request $request)
    {
        // $name = $request->name;
        // $price = $request->price;
        // $description = $request->description;
        // return [$name, $price, $description];
        // return $request->all();

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required'
        ], [
            'required' => ':attribute không được để trống'
        ], [
            'name' => 'Tên',
            'price' => 'Giá',
            'description' => 'Mô tả'
        ]);

        //Gọi service
        $product = $this->productService->create($request->all());
        return response()->json([
            'message' => 'create product success',
            'success' => true,
            'data' => $product
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'sometimes|required',
            'price' => 'sometimes|required',
            'description' => 'sometimes|required'
        ]);
        $product = $this->productService->update($id, $request->all());
        if (!$product) {
            return response()->json([
                'message' => 'Update product failed',
                'success' => false,
                'error' => 'Server Error'
            ], 500);
        }
        return response()->json([
            'message' => 'Update product success',
            'success' => true,
            'data' => $product
        ]);
    }

    public function delete($id)
    {
        $product = $this->productService->delete($id);

        if (!$product) {
            return response()->json([
                'message' => 'Delete product failed',
                'success' => false,
                'error' => 'Server Error'
            ], 500);
        }
        return response()->json([
            'message' => 'Delete product success',
            'success' => true,
            'data' => $product
        ]);
    }
}

// class A {}

// class B
// {

//     public function __construct($a) {}
//     public function method1() {}
// }

//Khởi tạo instance class A ở bên ngoài
// $a = new A();
// $b = new B($a);

//DI Container

//API: Response Template
/*
{
    success: true,
    message: "",
    data: {
    }
}
*/
<?php

namespace App\Domains\Product\Http\Controllers;

use App\Domains\Core\Http\Controllers\BaseController;
use App\Domains\Product\Http\Requests\ProductSaveRequest;
use App\Domains\Product\Models\Product;
use Illuminate\Http\Request;

class ApiController extends BaseController
{

    public function addform()
    {
        $viewHtml = view('product_view::raw.add')->with([
            'title' => 'Product Create Form',
        ])->render();

        return $this->response([
            'success' => true,
            'message' => '',
            'html' => true,
            'data' => $viewHtml,
        ]);
    }

    public function search(Request $request)
    {
        $modelObj = Product::select('name', 'stock', 'price', 'code', 'id');

        if ($request->term && strlen($request->term) > 0) {
            $modelObj = $modelObj->where('name', 'like', "%{$request->term}%")->orWhere('code', 'like', "%{$request->term}%");
        }

        $products = $modelObj->orderBy('name', 'asc')->get();

        $viewHtml = view('product_view::raw.list')->with([
            'products' => $products,
            'term' => $request->term,
        ])->render();

        return $this->response([
            'success' => true,
            'message' => '',
            'html' => true,
            'data' => $viewHtml,
        ]);
    }

    public function edit(Product $product)
    {
        $viewHtml = view('product_view::raw.edit')->with([
            'product' => $product,
            'title' => 'Product Edit Form',
        ])->render();

        return $this->response([
            'success' => true,
            'message' => '',
            'html' => true,
            'data' => $viewHtml,
        ]);
    }

    public function save(ProductSaveRequest $request)
    {
        $productModel = new Product();

        $result = $productModel->store($request);

        if(!$result) {
            return $this->response([
                'message' => $productModel->error,
            ]);
        }

        $products = Product::orderBy('name', 'asc')->get();

        $viewHtml = view('product_view::raw.list')->with(['products' => $products])->render();

        return $this->response([
            'success' => true,
            'message' => 'Product saved successfully',
            'html' => true,
            'data' => $viewHtml,
        ]);

    }

    public function remove(Product $product)
    {
        if (isset($product->id) && $product->id > 0) {
            $product->delete();

            return $this->response([
                'success' => true,
                'message' => 'Product has been deleted',
            ]);
        }

        return $this->response([
            'success' => false,
            'message' => 'Product not found',
        ]);
    }
}

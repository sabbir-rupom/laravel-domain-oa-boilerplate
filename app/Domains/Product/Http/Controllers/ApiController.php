<?php

namespace App\Domains\Product\Http\Controllers;

use App\Domains\Core\Http\Controllers\BaseController;
use App\Domains\Product\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

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

    public function save(Request $request)
    {
        $validate = $this->_requestValidate($request);
        if ($validate) {
            return $validate;
        }

        if ($request->id && intval($request->id) > 0) {
            $product = Product::where('id', intval($request->id))->first();
            if ($product) {
                $product->update([
                    'name' => $request->name,
                    'code' => $request->code,
                    'stock' => intval($request->head),
                    'price' => floatval($request->price),
                ]);
            }
        } else {
            $product = Product::create([
                'name' => $request->name,
                'code' => $request->code,
                'stock' => intval($request->head),
                'price' => floatval($request->price),
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

    /**
     * Form submit data validation
     *
     * @param Request $request
     * @return void
     */
    private function _requestValidate(Request $request)
    {
        $validationRules = [
            'code' => 'required|string|unique:units,code',
            'head' => 'required|integer',
            'name' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return $this->response([
                'message' => $validator->errors()->first(),
            ], Response::HTTP_BAD_REQUEST);

        }

        return false;
    }
}

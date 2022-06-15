<?php

namespace App\Domains\Product\Http\Controllers;

use App\Domains\Core\Http\Controllers\BaseController;
use App\Domains\Product\Models\Product;

class IndexController extends BaseController
{
    public function index()
    {
        $products = Product::orderBy('name', 'asc')->get();

        return view('product_view::index', [
            'products' => $products,
        ]);
    }
}

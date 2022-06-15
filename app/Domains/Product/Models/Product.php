<?php

namespace App\Domains\Product\Models;

use App\Domains\Product\Http\Requests\ProductSaveRequest;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'code',
        'price',
        'stock',
    ];

    public $error = false;

    public function store(ProductSaveRequest $request)
    {
        $pData = [
            'name' => $request->name,
            'code' => $request->code,
            'stock' => $request->stock,
            'price' => $request->price,
        ];


        if ($request->id && intval($request->id) > 0) {
            $product = Product::where('id', intval($request->id))->first();
            
            if ($product) {
                if($product->code !== $pData['code'] && self::where('code', $pData['code'])->exists()) {
                    $this->error = 'Product code is already in use';
                    return false;
                }
                $product->update($pData);
            }
        } else {

            if(self::where('code', $pData['code'])->exists()) {
                $this->error = 'Product code is already in use';
                return false;
            }

            $product = Product::create($pData);
        }

        return true;
    }

}

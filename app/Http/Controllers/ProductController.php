<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Category_product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function createDataProduct(Request $request){

        $request->validate([
            'name' => 'required|min:1|max:100',
            'image' => 'required|image|file:jpg,png,jpeg',
            'price' => 'required|numeric|min:100|max:1000000000',
            'stock' => 'required|numeric|min:0|max:9999',
            'min_order' => 'required|numeric|min:1|max:500',
            'category' => 'required|numeric',
        ],[
            'min_order.required' => 'Min order is required',
            'min_order.min' => 'Min order must be 1 or above',
        ]);

        try{
            $getDataCategoryById = Category_product::where('id_category', $request->category)->first();
            if(!isset($getDataCategoryById['name_category'])){
                return back()->with('error', 'Kategori tidak ditemukan');
            }
            $finalData = [
                'name_product' => $request->name,
                'image_product' => 'default.jpg',
                'price_product' => $request->price,
                'stock_product' => $request->stock,
                'min_order' => $request->stock,
                'quantity_sold' => 0,
                'category_id' => $request->category,
            ];
            $imageName = null;
            if($request->file('image')){
                $imageName = Str::random(50).time().'.'.$request->file('image')->extension();
                $finalData['image_product'] = $imageName;
            }
            if(Product::create($finalData)){
                ($imageName != null) && $request->file('image')->storeAs('products/images', $imageName);
                return back()->with('message', 'Product berhasil ditambahkan');
            }else{
                return back()->with('message', 'Terjadi kesalahan di server');
            }
        }catch(Exception $e){
            return abort(500);
        }

    }
}
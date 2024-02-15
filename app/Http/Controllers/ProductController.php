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
            $finalData['slug'] = Str::slug($request->name).'-'.Str::random(50);
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

    public function editDataProduct(Request $request){
        $request->validate([
            'slug' => 'required|string',
            'name' => 'required|min:1|max:100',
            'image' => 'image|file:jpg,png,jpeg',
            'price' => 'required|numeric|min:100|max:1000000000',
            'stock' => 'required|numeric|min:0|max:9999',
            'min_order' => 'required|numeric|min:1|max:500',
            'category' => 'required|numeric',
        ]);
        $finalData = [
            'name_product' => $request->name,
            'price_product' => $request->price,
            'stock_product' => $request->stock,
            'min_order' => $request->stock,
            'quantity_sold' => 0,
            'category_id' => $request->category,
        ];
        try{
            $getLastDataProduct = Product::where('slug', $request->slug)->first();
            if(!isset($getLastDataProduct)){
                return view('ErrorView.404')->with('message', 'Product tidak ditemukan');
            }
            $imageName = null;
            if($request->file('image')){
                Storage::delete('products/images/'.$getLastDataProduct['image_product']);
                $imageName = Str::random(50).time().'.'.$request->file('image')->extension();
                $finalData['image_product'] = $imageName;
            }
            $finalData['slug'] = Str::slug($request->name).'-'.Str::random(50);
            if(Product::where('slug', $request->slug)->update($finalData)){
                ($imageName != null) && $request->file('image')->storeAs('products/images', $imageName);
                return back()->with('message', 'Product berhasil diedit');
            }else{
                return back()->with('message', 'Terjadi kesalahan di server');
            }   
        }catch(Exception $e){
            return abort(500);
        }
    }

    public function deleteDataProduct(Request $request){
        $request->validate([
            'slug' => 'required|string',
        ]);
        try{
            $getDataProduct = Product::where('slug', $request->slug)->first();
            if(isset($getDataProduct)){
                if(Product::where('slug', $request->slug)->delete() > 0){
                    Storage::delete('products/images/'.$getDataProduct['image_product']);
                    return back()->with('message', 'Product berhasil dihapus');
                }else{
                    return back()->with('message', 'Terjadi Kesalahan saat menghapus Product');
                }
            }else{
                return view('ErrorView.404',[
                    'message' => 'Product tidak ditemukan',
                ]);
            }
        }catch(Exception $e){
            return view('ErrorView.500',[
                'message' => 'Terjadi Kesalahan Pada Server',
            ]);
        }
    }

    public function viewCreateProduct(){
        try{
            $getAllCategory = Category_product::all([
                'id_category',
                'name_category',
                'icon_category'
            ]);
            return view('dashboard.product.create',[
                'title' => "Buat Produk | Dashboard Lofinz",
                'css' => 'product/create_product.css',
                'header' => 'Buat Produk',
                'category' => $getAllCategory,
            ]);
        }catch(Exception $e){
            return view('ErroView.500',[
                'message' => 'Terjadi Kesalahan Pada Server',
            ]);
        }
    }

    public function viewEditProduct($slug){
        try{
            $getDataProduct = Product::with('category_product')->where('slug', $slug)->first();
            if(!isset($getDataProduct)){
                return view('ErrorView.404',[
                    'message' => 'Produk tidak ditemukan',
                ]);
            }
            $getAllCategory = Category_product::all([
                'id_category',
                'name_category',
                'icon_category'
            ]);
            return view('Dashboard.Product.edit',[
                'title' => "Buat Produk | Dashboard Lofinz",
                'css' => 'product/create_product.css',
                'header' => 'Buat Produk',
                'category' => $getAllCategory,
                'product' => $getDataProduct,
            ]);
        }catch(Exception $e){
            return view('ErrorView.500',[
                'message' => 'Terjadi Kesalahan Pada Server',
            ]);
        }
    }
    public function viewAllProduct(){
        try{
            $getAllProduct = Product::with('category_product')->get();
            return view('Product.index',[
                'title' => 'Produk Toko | Dashboard Lofinz',
                'css' => 'index.css',
                'header' => 'Produk Toko',
                'product' => $getAllProduct,
            ]);
        }catch(Exception $e){
            return view('ErrorView.500',[
                'message' => 'Terjadi Kesalahan Pada Server',
            ]);
        }
    }
}
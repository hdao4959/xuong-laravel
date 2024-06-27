<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartList(){
        if(session('cart')){
            $cart = session('cart');
            $totalAmount= 0;
            foreach($cart as $item){
                $totalAmount += $item['quantity'] * ($item['price_sale']) ?: ($item['price_regular']);
            }
           return view('cart-list', compact('totalAmount'));
        }
      
    }


    public function add(){
        $product = Product::query()->findOrFail(\request('product_id'));
        $productVariant = ProductVariant::query()
        ->with('product_size', 'product_color')
        ->where([
            'product_id' => request('product_id'),
            'product_color_id' => request('color_id'),
            'product_size_id' => request('size_id'),
        ])->firstOrFail();

     

// Trường hợp sản phẩn đó chưa có trong giỏ hàng
        if(!isset(session('cart')[$productVariant->id])){
            $data = $product->toArray()
            + $productVariant->toArray() 
            + ['item-quantity' => request('quantity')];
            session()->put('cart.'. $productVariant->id , $data);
            // Trường hớp sản phẩm đã có trong giỏ hàng
        }else{
            $data = session('cart')[$productVariant->id];
            $data['item-quantity'] += request('quantity');
            session()->put('cart.'. $productVariant->id , $data);
        }
        return redirect()->route('cart.list');
    }


}

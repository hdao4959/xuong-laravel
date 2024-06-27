<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class OrderController extends Controller
{
    public function save()
    {
        try {
            DB::transaction(function () {

                // Tạo tài khoản cho người dùng trong bảng User
                $user = User::query()->create([
                    'name' => request('user_name'),
                    'email' => request('user_email'),
                    'password' => bcrypt(request('user_email')),
                ]);

                $dataItem = [];

                $cart = session('cart');
                $totalAmount = 0;
              
                // Lưu tất cả sản phẩm và tổng giá vào bảng OrderItem
                foreach ($cart as $product_variant_id => $item) {
                  
                    
                    $totalAmount += $item['quantity'] * ($item['price_sale']) ?: ($item['price_regular']);
                 
                    $dataItem[] = [
                        'product_variant_id' => $product_variant_id,
                        'quantity' => $item['item-quantity'],
                        'product_name' => $item['name'],
                        'product_sku' => $item['sku'],
                        'product_img_thumbnail' => $item['img_thumbnail'],
                        'product_price_regular' => $item['price_regular'],
                        'product_price_sale' => $item['price_sale'],
                        'variant_size_name' => $item['product_size']['name'],
                        'variant_color_name' => $item['product_color']['name'],
                    ];
                }


                // Lưu thông tin người nhận hàng và tổng giá vào bảng OrderItem
                $order = Order::query()->create(
                    [
                        'user_id' => $user->id,
                        'user_name' => $user->name,
                        'user_email' => $user->email,
                        'user_phone' => request('user_phone'),
                        'user_address' => request('user_address'),
                        'total_price' => $totalAmount,
                    ]);


                // Tạo ra trường order_id cho các sản phẩm trong bảng orderItem;
                foreach ($dataItem as $item) {
                    $item['order_id'] = $order->id;
                    OrderItem::query()->create($item);
                }
            });

            session()->forget('cart');
            return redirect()->route('welcome')->with('success', 'Bạn đã đặt hàng thành công');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return back()->with('error', 'Lỗi đặt hàng');
        }
    }
}

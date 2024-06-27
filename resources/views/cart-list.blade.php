<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Styles -->

</head>

<body class="antialiased">
    <div class="container">
        <a href="{{ route('welcome') }}">Trang chủ</a>

        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered mt-3">
                    <tr>
                        <th>Name</th>
                        <th>Giá thường</th>
                        <th>Giá sale</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Số lượng</th>
                    </tr>
                    @if (session()->has('cart'))
                        @foreach (session('cart') as $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['price_regular'] }}</td>
                                <td>{{ $item['price_sale'] }}</td>
                                <td>{{ $item['product_color']['name'] }}</td>
                                <td>{{ $item['product_size']['name'] }}</td>
                                <td>{{ $item['item-quantity'] }}</td>

                            </tr>
                        @endforeach
                    @endif



                </table>
            </div>
            <div class="col-md-4">
                <h2>Tổng tiền: {{ number_format($totalAmount) }}đ</h2>
                <form action="{{ route('order.save') }}" method="post">
                    @csrf
                    <input type="text" name="user_name" id="user_name" value="{{ auth()->user()?->name }}"
                        placeholder="Your name"><br>
                    <input type="text" name="user_email" id="user_email" value="{{ auth()->user()?->email }}"
                        placeholder="Your email"><br>
                    <input type="text" name="user_phone" id="user_phone" placeholder="Your phone number"><br>
                    <input type="text" name="user_address" id="user_address" placeholder="Your address"><br>
                    <button class="btn btn-primary" type="submit">Đặt hàng</button>
                </form>
            </div>
        </div>

    </div>


</body>

</html>


<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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
        <h1>{{ $product->name }}</h1>

        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/'. $product->img_thumbnail) }}" alt="" width="500px">

                <table class="table table-bordered mt-3">
                    <tr>
                        <th>Trường</th>
                        <th>Giá trị</th>
                    </tr>
                    <tr>
                        <th>SKU</th>
                        <th>{{ $product->sku }}</th>
                    </tr>
                    <tr>
                        <th>Price regular</th>
                        <th>{{ $product->price_regular }}</th>
                    </tr>
                    <tr>
                        <th>Price sale</th>
                        <th>{{ $product->price_sale }}</th>
                    </tr>
                    <tr>
                        <th>SKU</th>
                        <th>{{ $product->sku }}</th>
                    </tr>
                  
                </table>
              </div>
              <div class="col-md-6">
                <form action="{{ route('cart.add') }}" method="post">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <label>Color</label>
                    @foreach ($colors as $id  => $name)
                     <div class="form-check">
                        <input class="form-check-input" type="radio" name="color_id" id="radio_color_{{ $id }}" value="{{ $id }}">
                        <label class="form-check-label" for="radio_color_{{ $id }}">{{ $name }}</label>

                     </div>
                    @endforeach
               
                    <label>Size</label>
                    @foreach ($sizes as $id  => $name)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="size_id" id="radio_size_{{ $id }}" value="{{ $id }}">
                        <label class="form-check-label" for="radio_size_{{ $id }}">{{ $name }}</label>
                        </div>
                    @endforeach

                    <div class="mb-3 mt-3">
                        <label for="quantity" class="form-label">Quantity:</label>
                        <input type="number" class="form-control" min="1" required id="quantity" value="1" placeholder="Enter quantity" name="quantity">
                    </div>

                    <button class="btn btn-primary" type="submit">Add to cart</button>
                </form>
              </div>
        </div>
       
      </div>

     
    </body>
</html>


<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
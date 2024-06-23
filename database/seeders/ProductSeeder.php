<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Stringable;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Schema::disableForeignKeyConstraints();
        ProductVariant::query()->truncate();
        ProductGallery::query()->truncate();
        DB::table('product_tag')->truncate();
        Product::query()->truncate();
        ProductSize::query()->truncate();
        ProductColor::query()->truncate();
        Tag::query()->truncate();


        Tag::factory(15)->create();
        foreach(['S', 'M', 'L', 'XL', 'XXL'] as $item){
            ProductSize::query()->create([
                'name' => $item
            ]);
        }


        foreach(['#0000FF', '#FF00FF', '#33CCFF', '#FF0033', '#00EE00'] as $item){
            ProductColor::query()->create([
                'name' => $item
            ]);
        }


        for($i = 0; $i < 1000; $i++){
            $name = fake()->text(100);


            Product::query()->create([
        'catelogue_id' => rand(2, 7),
        'name'=> $name,
        'slug'=> Str::slug($name) . '-' . Str::random(8),
        'sku'=> Str::random(8) . $i,
        'img_thumbnail'=> "https://canifa.com/ao-polo-nam-8tp24s006",
        'price_regular'=> 500000,
        'price_sale'=> 399000,
      
            ]);
        }


        for($i = 1; $i < 1001; $i++){
            ProductGallery::query()->create([
                'product_id' => $i,
                'image' => "https://canifa.com/ao-polo-nam-8tp24s006"
            ]);
            ProductGallery::query()->create([
                'product_id' => $i,
                'image' => "https://canifa.com/ao-ba-lo-active-nam-8ta24s005"
            ]);
        }



        for($i = 1; $i < 1001; $i++){
            DB::table('product_tag')->insert([
                [
                   'product_id' => $i, 
                   'tag_id' => rand(1, 8)
                ],
                [
                    'product_id' => $i,
                    'tag_id' => rand(9, 15)
                ]
            ]);
        }



        for($productID = 1; $productID < 1001; $productID++){
            $data = [];
            for($sizeID = 1; $sizeID < 6;$sizeID++){
                for($colorID = 1; $colorID < 6; $colorID++){
                    $data[] = [
                        'product_id' => $productID,
                        'quantity' => 100,
                        'product_size_id' => $sizeID,
                        'product_color_id' => $colorID,
                        'image' => "https://canifa.com/ao-ba-lo-active-nam-8ta24s005"
                    ];
                  
                }
            }
            DB::table('product_variants')->insert($data);
        }
    }
}

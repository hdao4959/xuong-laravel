<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Catelogue;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Exists;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.products.';
    public function index()
    {
        $data = Product::query()->with('catelogue')->latest('id')->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $catelogues = Catelogue::query()->pluck('name', 'id')->all();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();
        $tags = Tag::query()->pluck('name', 'id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('catelogues', 'colors', 'sizes', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataProduct = $request->except(['product_variants', 'tags', 'product_galleries']);
        $dataProduct['is_active'] = isset($dataProduct['is_active']) ? 1 : 0;
        $dataProduct['is_hot_deal'] = isset($dataProduct['is_hot_deal']) ? 1 : 0;
        $dataProduct['is_good_deal'] = isset($dataProduct['is_good_deal']) ? 1 : 0;
        $dataProduct['is_new'] = isset($dataProduct['is_new']) ? 1 : 0;
        $dataProduct['is_show_home'] = isset($dataProduct['is_show_home']) ? 1 : 0;
        $dataProduct['slug'] = Str::slug($dataProduct['name'] . '-' . $dataProduct['sku']);
        $dataProductVariantsTmp = $request->product_variants;
        $dataProductVariants = [];

        foreach ($dataProductVariantsTmp as $key => $item) {
            $tmp = explode('-', $key);
            $dataProductVariants[] = [
                'product_size_id' => $tmp[0],
                'product_color_id' => $tmp[1],
                'quantity' => $item['quantity'],
                'image' => $item['image'] ?? null,
            ];
        }

        $dataProductTags = $request->tags;
        $dataProductGalleries = $request->product_galleries;

        try {
            DB::beginTransaction();

            if($dataProduct['img_thumbnail']){
                $dataProduct['img_thumbnail'] = Storage::put('products', $dataProduct['img_thumbnail']);
            }
            $product = Product::query()->create($dataProduct);
            foreach($dataProductVariants as $dataProductVariant){
                $dataProductVariant['product_id'] = $product->id;
                if($dataProductVariant['image']){
                    $dataProductVariant['image'] = Storage::put('products', $dataProductVariant['image']);
                }

                ProductVariant::query()->create($dataProductVariant);
            }

            $product->tags()->sync($dataProductTags);
            foreach($dataProductGalleries as $item){
                ProductGallery::query()->create([
                    'product_id' => $product->id,
                    'image' => Storage::put('products', $item)
                ]);
            }
            DB::commit();

            return redirect()->route('admin.products.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            DB::transaction(function() use ($product){
                $product->tags()->sync([]);
                $productGalleries = $product->galleries();
                foreach($productGalleries as $prdGallerry){
                    if(Storage::exists($prdGallerry)){
                        Storage::delete($prdGallerry);
                    }
                }
                $product->galleries()->delete();
                $product->variant()->delete();
                if($product['img_thumbnail'] && Storage::exists($product['img_thumbnail'])){
                    Storage::delete($product['img_thumbnail']);
                }
                $product->delete();

            }, 3);
            return back();
        } catch (\Exception $exception) {
           return back();
        }
    }
}

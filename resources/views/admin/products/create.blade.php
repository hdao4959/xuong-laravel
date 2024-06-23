@extends('admin.layouts.master')
@section('title')
    Thêm mới sản phẩm
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm mới sản phẩm</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Thêm mới</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

<form action="{{ route('admin.products.store')}}" method="post" enctype="multipart/form-data">
 @csrf

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Thông tin</h4>
                    {{-- <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <label for="form-grid-showcode" class="form-label text-muted">Show Code</label>
                            <input class="form-check-input code-switcher" type="checkbox" id="form-grid-showcode">
                        </div>
                    </div> --}}
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="col-md-5">
                                <div class="mt-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>

                                <div class="mt-3">
                                    <label for="sku" class="form-label">SKU</label>
                                    <input type="text" name="sku" id="sku"
                                        class="form-control"value="{{ strtoupper(Str::random(8)) }}">
                                </div>

                                <div class="mt-3">
                                    <label for="price_regular" class="form-label">Price Regular</label>
                                    <input type="number" name="price_regular" id="price_regular" class="form-control"
                                        value="0">
                                </div>
                                <div class="mt-3">
                                    <label for="price_sale" class="form-label">Price Sale</label>
                                    <input type="number" name="price_sale" id="price_sale" class="form-control"
                                        value="0">
                                </div>

                                <div class="mt-3">
                                    <label for="catelogue_id" class="form-label">Catelogues</label>
                                    <select type="text" class="form-select" name="catelogue_id" id="catelogue_id">
                                        @foreach ($catelogues as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mt-3">
                                    <label for="sku" class="form-label">Img Thumbnail</label>
                                    <input type="file" name="img_thumbnail" id="img_thumbnail" class="form-control">
                                </div>
                            </div>


                            {{-- Box right  --}}
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-check form-switch form-switch-primary mb-3">
                                            <input class="form-check-input" type="checkbox" role="switch" id="is_active"
                                                name="is_active" checked>
                                            <label class="form-check-label" for="is_active">Is Active</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check form-switch form-switch-warning mb-3">
                                            <input class="form-check-input" type="checkbox" role="switch" id="is_hot_deal"
                                                name="is_hot_deal" checked>
                                            <label class="form-check-label" for="is_hot_deal">Is Hot deal</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check form-switch form-switch-success mb-3">
                                            <input class="form-check-input" type="checkbox" role="switch" id="is_good_deal"
                                                name="is_good_deal" checked>
                                            <label class="form-check-label" for="is_good_deal">Is Good Deal</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check form-switch form-switch-danger mb-3">
                                            <input class="form-check-input" type="checkbox" role="switch" id="is_new"
                                                name="is_new" checked>
                                            <label class="form-check-label" for="is_new">Is New</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check form-switch form-switch-info mb-3">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="is_show_home" name="is_show_home" checked>
                                            <label class="form-check-label" for="is_show_home">Is Show Home</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="mt-3">
                                        <div for="description" class="form-label">Description</div>
                                        <textarea name="description" id="description" class="form-control" rows="2"></textarea>
                                    </div>
                                    <div class="mt-3">
                                        <div for="material" class="form-label">Material</div>
                                        <textarea name="material" id="material" class="form-control" rows="2"></textarea>
                                    </div>
                                    <div class="mt-3">
                                        <div for="user_manual" class="form-label">User Manual</div>
                                        <textarea name="user_manual" id="user_manual" class="form-control" rows="2"></textarea>
                                    </div>
                                    <div class="mt-3">
                                        <div for="content" class="form-label">Content </div>
                                        <textarea name="content" id="content" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!--end col-->

                        </div>
                        <!--end row-->
                    </div>

                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Biến thể</h4>
                    {{-- <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <label for="form-grid-showcode" class="form-label text-muted">Show Code</label>
                            <input class="form-check-input code-switcher" type="checkbox" id="form-grid-showcode">
                        </div>
                    </div> --}}
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">

                            <table>
                                <tr>
                                    <th class="text-center">Size</th>
                                    <th class="text-center">Color</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Image</th>
                                </tr>
                                @foreach ($sizes as $sizeId => $sizeName)
                                    @foreach ($colors as $colorId => $colorName)
                                        <tr class="text-center">
                                            <td class="text-center">{{ $sizeName }}</td>
                                            <td class="d-flex">
                                                <div style="width:50px; height:50px; background:{{ $colorName }}">
                                                </div>

                                            </td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    value="100"
                                                    name="product_variants[{{ $sizeId . '-' . $colorId }}][quantity]">
                                            </td>
                                            <td><input type="file" class="form-control"
                                                    name="product_variants[{{ $sizeId . '-' . $colorId }}][image]">
                                            </td>

                                        </tr>
                                    @endforeach
                                @endforeach
                            </table>
                        </div>
                        <!--end row-->
                    </div>

                </div>
            </div>
        </div>
        <!--end col-->
    </div>

    {{-- Gallery --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Gallery</h4>

                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div>
                                <label for="gallery_1" class="form-label">Gallery 1</label>
                                <input type="file" class="form-control" name="product_galleries" id="gallery_1">
                            </div>
                            <div>
                                <label for="gallery_2" class="form-label">Gallery 2</label>
                                <input type="file" class="form-control" name="product_galleries" id="gallery_2">
                            </div>

                        </div>
                        <!--end row-->
                    </div>

                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Tags</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div>
                                <label for="gallery_1" class="form-label">Tags</label>
                                <select class="form-control" name="tags[]" id="tags" multiple>
                                    @foreach ($tags as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                </select>
                            </div>


                        </div>
                        <!--end row-->
                    </div>

                </div>
            </div>
            <button type="submit" class="btn btn-primary"> Save</button>
        </div>
        <!--end col-->

    </div>
</form>
@endsection



@section('script-libs')
    <script src="https:////cdn.ckeditor.com/4.24.0-lts/standard/ckeditor.js"></script>
@endsection
@section('scripts')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection

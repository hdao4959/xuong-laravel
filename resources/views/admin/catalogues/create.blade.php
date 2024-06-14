@extends('admin.layouts.master');
@section('title')
    Thêm mới Danh mục sản phẩm 
@endsection


@section('content')

<form action="{{route('admin.catalogues.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3 mt-3">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
              </div>
            <div class="mb-3 mt-3">
                <label for="cover">File:</label>
                <input type="file" class="form-control" id="cover"  name="cover">
              </div>
        </div>


        <div class="col-md-6">
            <div class="mb-3 form-check">
                <label for="form-check-label">
                    <input type="checkbox" name="is_active"  value="1" class="form-check-input"> Is Active
                </label>
              </div>
        </div>
    </div>


    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection


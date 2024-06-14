@extends('admin.layouts.master');
@section('title')
    Danh sách Danh mục sản phẩm
@endsection


@section('content')
   <!-- start page title -->
   <div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Datatables</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                    <li class="breadcrumb-item active">Datatables</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between ">
                <h5 class="card-title mb-0">Danh sách</h5>
                <a href="{{ route('admin.catalogues.create') }}" class="btn btn-primary">Thêm mới</a>
            </div>
            <div class="card-body">
                <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <table class="table table-hover">
                        <thead>
                            
                              <tr>
                                
                                <th>ID</th>
                                <th>Name</th>
                                <th>Cover</th>
                                <th>Is active</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                        <tbody>

                       
                            @foreach($data as $item)
                    
                           
                            
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td class="text-center"><img src="{{\Storage::url($item->cover)}}"  alt=""  height="50"></td>
                                <td>{!! $item->is_active ? 
                                '<span class="badge bg-primary">Yes</span>' : 
                                '<span class="badge bg-danger">No</span>' !!}</td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->updated_at}}</td>
                                <td>
                                    <a href="{{route('admin.catalogues.show', $item->id)}}" class="btn btn-info mb-3">Xem</a>
                                    <a href="{{route('admin.catalogues.edit', $item->id)}}" class="btn btn-warning mb-3">Sửa</a>
                                    <a href="{{route('admin.catalogues.destroy', $item->id)}}" onclick="return confirm('Bạn có chắc muốn xoá không?')" class="btn btn-danger mb-3">Xoá</a>
                                </td>
                            </tr>
                    
                        @endforeach
                    </tbody>
                        </table>
                    
                </table>
            </div>
        </div>
    </div><!--end col-->
</div><!--end row-->



@endsection

@section('style-libs')
  <!--datatable css-->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
  <!--datatable responsive css-->
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection


@section('script-libs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--datatable js-->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script>
    new DataTable('#example', {
        order: [[0, 'desc']];
    });
</script>
@endsection
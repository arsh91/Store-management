@extends('layout')
@section('title', 'Store Products')
@section('subtitle', 'Store Products')
@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <a href="{{ route('storeproducts.create') }}" class="btn btn-primary mt-3">ADD<i class="bi bi-plus"></i></a>
            <div class="box-header with-border mt-3" id="filter-box">
                @if(session()->has('message'))
                <div class="alert alert-success message">
                    {{ session()->get('message') }}
                </div>

                @endif
                <br>
                <div class="box-body table-responsive" style="margin-bottom: 5%">
                    <table class="table table-borderless dashboard" id="role_table">
                        <thead>
                            <tr>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Product Description</th>
                                <th>Product Category</th>
                                <th>Current Stock</th>
                                <th>Min Price</th>
                                <th>Max Price</th>
                                <th>Product Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         @if (!empty($StoreProducts))
                        @forelse($StoreProducts as $data)
                            <tr>
                                <td>{{$data->product_code}}</td>
                                <td>{{$data->product_name}}</td>
                                <td>{{$data->product_description}}</td>
                                <td>{{$data->productcategory->category_name}}</td>
                                <td>{{$data->current_stock}}</td>
                                <td>{{$data->min_price}}</td>
                                <td>{{$data->max_price}}</td>
                                <td>
                                <img src="{{asset('').$data->product_image}}" width="50" height="50">
                                
                                </td>
                                <td>
                                    <a href="/storeproducts/edit/{{$data->id}}"><i style="color:#4154f1;" class="fa fa-edit fa-fw pointer"></i></a>

                                    <i style="color:#4154f1;" onClick="deleteStoreProduct({{ $data->id }})"
                                        href="javascript:void(0)" class="fa fa-trash fa-fw pointer"></i>
                                </td>
                            </tr>
                            @empty
                            @endforelse
                            @else
                            <tr><td colspan="4">No data found.</td><tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js_scripts')
@if (count($errors) > 0)
<script>
$(document).ready(function() {
    $('#addStore').modal('show');
});
</script>   
@endif
<script>
$(document).ready(function() {
    setTimeout(function() {
        $('.message').fadeOut("slow");
    }, 2000);
    $('#role_table').DataTable({
        "order": []
        //"columnDefs": [ { "orderable": false, "targets": 7 }]
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

function deleteStoreProduct(id) {
if (confirm("Are you sure ?") == true) {
    // ajax
    $.ajax({
        type: "DELETE",
        url: "{{ url('/storeproducts/delete') }}",
        data: {
            id: id
        },
        dataType: 'json',
        success: function(res) {
            location.reload();
        }
    });
}
}
</script>
@endsection
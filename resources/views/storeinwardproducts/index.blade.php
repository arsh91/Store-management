@extends('layout')
@section('title', 'Store Inward Products')
@section('subtitle', 'Store Inward Products')
@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <a href="{{ route('storeinwardproducts.create') }}" class="btn btn-primary mt-3">ADD<i class="bi bi-plus"></i></a>
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
                                <th>Product Name</th>
                                <th>Inward Vendor</th>
                                <th>Stock Inward</th>
                                <th>Inward By</th>
                                <th>Product Price</th>
                                <th>Total Amount</th>
                                <th>Bill No</th>
                                <th>Inward Person From</th>
                                <th>Bill Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         @if (!empty($StoreInwardProducts))
                        @forelse($StoreInwardProducts as $data)
                            <tr>
                                <td>{{ $data->storeproduct->product_name}}</td>
                                <td>{{ $data->storeinwardvendors->vendor_name}}</td>
                                <td>{{ $data->stock_inward}}</td>
                                <td>{{ $data->inwardby->name}}</td>
                                <td>{{ $data->product_price}}</td>
                                <td>{{ $data->total_amount}}</td>
                                <td>{{ $data->bill_no}}</td>
                                <td>{{ $data->inward_person_from}}</td>
                                <td>
                                <!-- <img src="{{asset('').$data->bill_image}}" width="50" height="50"> -->
                                <a href="{{asset('').$data->bill_image}}" target="_blank">View bill</a>
                                </td>
                                <td>
                                    <a href="/storeinwardproducts/edit/{{$data->id}}"><i style="color:#4154f1;" class="fa fa-edit fa-fw pointer"></i></a>

                                    <i style="color:#4154f1;" onClick="deleteStoreInwardProduct({{ $data->id }})"
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

function deleteStoreInwardProduct(id) {
if (confirm("Are you sure ?") == true) {
    // ajax
    $.ajax({
        type: "DELETE",
        url: "{{ url('/storeinwardproducts/delete') }}",
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
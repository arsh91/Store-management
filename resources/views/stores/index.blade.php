@extends('layout')
@section('title', 'Stores')
@section('subtitle', 'Stores')
@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <a href="{{ route('stores.create') }}" class="btn btn-primary mt-3">ADD<i class="bi bi-plus"></i></a>
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
                                <th>Name</th>
                                <th>Location</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         @if (!empty($Stores))
                        @forelse($Stores as $data)
                            <tr>
                                <td>{{$data->name}}</td>
                                <td>{{$data->location}}</td>
                                <td>
                                    <div class="form-group form-check active_user">
                                        <input type="checkbox" onClick="changeStatus(this)" data-user-id="{{ $data->storeId}}" class="form-check-input changestoreactive" id="{{'active_store_'.$data->storeId}}" {{$data->active == 1 ? 'checked' : ''}}>
                                        <label class="form-check-label" for="active_user"></label>
                                    </div>
                                </td>
                                <td>
                                    <a href="/stores/edit/{{$data->storeId}}"><i style="color:#4154f1;" class="fa fa-edit fa-fw pointer"></i></a>

                                    <i style="color:#4154f1;" onClick="deleteStore({{ $data->storeId }})"
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

function changeStatus(e) {
    var storeId = $(e).attr("data-user-id");
    var status = 0;
    if ($("#active_store_" + storeId).prop('checked') == true) {
        status = 1;
    }
    $.ajax({
        type: 'POST',
        url: "{{ url('/stores/statuschange')}}",
        data: {
            storeId: storeId,
            status: status,
        },
        cache: false,
        success: (data) => {
            if (data.status == 200) {
                location.reload();
            }
        },
        error: function(data) {}
    });

}

function deleteStore(id) {
if (confirm("Are you sure ?") == true) {
    // ajax
    $.ajax({
        type: "DELETE",
        url: "{{ url('/stores/delete') }}",
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
@extends('layout')
@section('title', 'Users')
@section('subtitle', 'Users')
@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary mt-3" href="{{ route('users.create') }}">ADD <i class="bi bi-plus"></i></a>

            <div class="box-header with-border" id="filter-box">
                <br>
                @if(session()->has('message'))
                <div class="alert alert-success message">
                    {{ session()->get('message') }}
                </div>
                @endif
                <div class="box-body table-responsive" style="margin-bottom: 5%">
                    <table class="table table-borderless dashboard" id="users_table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (!empty($Users))
                        @forelse($Users as $data)
                            <tr>
                                <td>{{$data->name}}</td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->phone}}</td>
                                <td>{{$data->address}}</td>
                                <td>{{$data->city}}</td>
                                <td>{{$data->state}}</td>
                                <td>
                                    <a href="/users/edit/{{$data->id}}"><i style="color:#4154f1;" class="fa fa-edit fa-fw pointer"></i></a>
                                    <i style="color:#4154f1;" onClick="deleteUser({{ $data->id }})"
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
<script>
$(document).ready(function() {
    setTimeout(function() {
        $('.message').fadeOut("slow");
    }, 2000);


    $('#users_table').DataTable({
        "order": []

    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
function deleteUser(id) {
if (confirm("Are you sure ?") == true) {
    // ajax
    $.ajax({
        type: "DELETE",
        url: "{{ url('/users/delete') }}",
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
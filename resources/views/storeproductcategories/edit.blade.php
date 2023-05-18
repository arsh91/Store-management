@extends('layout')
@section('title', 'Edit Store Product Category')
@section('subtitle', 'Edit Store Product Category')
@section('content')

<div class="col-lg-12" style="display: flex;justify-content: center;">
    <div class="card" style="width:740px;">
        <div class="card-body">
            <div class="box-header with-border mt-5" id="filter-box">
                @if(session()->has('message'))
                <div class="alert alert-success message">
                    {{ session()->get('message') }}
                </div>
                @endif
                <form method="post" id="editStoreproductcaegoryrForm" action="{{ route('storeproductcategories.update', $storeproductcategories->id) }}">
                @csrf
                    <div class="alert alert-danger" style="display:none"></div>

                    <div class="row mb-3">
                        <label for="category_name" class="col-sm-3 col-form-label required">Vendor Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="category_name" id="category_name" value="{{ old('category_name', $storeproductcategories->category_name ?? '') }}">
                            @if ($errors->has('category_name'))
                            <span class="text-danger">{{ $errors->first('category_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('storeproductcategories.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" name="submitstoreproductcategories" class="btn btn-primary">Update</button>
                    </div>
            </form>
                
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
    $('#pincode').mask("999999?");
});
</script>
@endsection
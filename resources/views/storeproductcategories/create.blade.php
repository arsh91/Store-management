@extends('layout')
@section('title', 'Add Store Product Category')
@section('subtitle', 'Add Store Product Category')
@section('content')

<div class="col-lg-12" style="display: flex;justify-content: center;">
    <div class="card" style="width:725px;">
        <div class="card-body">
            <div class="box-header with-border mt-5" id="filter-box">
                @if(session()->has('message'))
                <div class="alert alert-success message">
                    {{ session()->get('message') }}
                </div>
                @endif
                <form method="post" id="addStoreProductCategoryForm" action="{{ route('storeproductcategories.store') }}">
                @csrf
                    <div class="alert alert-danger" style="display:none"></div>

                    <div class="row mb-3">
                        <label for="category_name" class="col-sm-3 col-form-label required">Category Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="category_name" id="category_name" value="{{ old('category_name') }}">
                            @if ($errors->has('category_name'))
                            <span class="text-danger">{{ $errors->first('category_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('storeproductcategories.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" name="submitproductcategories" class="btn btn-primary">Save</button>
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
});
</script>
@endsection
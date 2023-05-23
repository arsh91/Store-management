@extends('layout')
@section('title', 'Add Store Product')
@section('subtitle', 'Add Store Product')
@section('content')
<style>
.it {
  height: 100px;
  margin-left: 10px;
  width: 100px;
}
.btn-rmv {
  display: none;
}
.rmv {
  cursor: pointer;
  color: #fff;
  border-radius: 30px;
  border: 1px solid #fff;
  display: inline-block;
  background: #0d6efd;
  margin: -5px -10px;
  position: absolute;
  font-size: 13px;
  line-height: 1;
  padding: 1px 6px  4px 6px;
}
.rmv:hover {
  background: #0d6efd6e;
}
.img_preview {
  position: relative;
  padding: 15px;
  display: none;
  width: 100%;
}
</style>
<div class="col-lg-12" style="display: flex;justify-content: center;">
    <div class="card" style="width:742px;">
        <div class="card-body">
            <div class="box-header with-border mt-5" id="filter-box">
                @if(session()->has('message'))
                <div class="alert alert-success message">
                    {{ session()->get('message') }}
                </div>
                @endif
                <form method="post" id="addStoreProductForm" action="{{ route('storeproducts.store') }}" enctype="multipart/form-data">
                @csrf
                    <div class="alert alert-danger" style="display:none"></div>

                    <div class="row mb-3">
                        <label for="product_code" class="col-sm-3 col-form-label required">Product Code</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="product_code" id="product_code" value="{{ old('product_code') }}">
                            @if ($errors->has('product_code'))
                            <span class="text-danger">{{ $errors->first('product_code') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="product_name" class="col-sm-3 col-form-label required">Product Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="product_name" id="product_name" value="{{ old('product_name') }}">
                            @if ($errors->has('product_name'))
                            <span class="text-danger">{{ $errors->first('product_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="product_name" class="col-sm-3 col-form-label required">Product Category</label>
                        <div class="col-sm-9">
                            <select class="search_select form-select" style="width: 281.528px;" name="product_category" id="product_category">
                                <option value="">Select Product Category</option>
                                    @foreach($StoreProductCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="current_stock" class="col-sm-3 col-form-label required">Current Stock</label>
                        <div class="col-sm-4">
                        <input type="number" class="form-control" name="current_stock" id="current_stock" value="{{ old('current_stock') }}" min="1">
                            @if ($errors->has('current_stock'))
                            <span class="text-danger">{{ $errors->first('current_stock') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="min_price" class="col-sm-3 col-form-label required">Min Price</label>
                        <div class="col-sm-4">
                        <input type="number" class="form-control" name="min_price" id="min_price" value="{{ old('min_price') }}" min="1">
                            @if ($errors->has('min_price'))
                            <span class="text-danger">{{ $errors->first('min_price') }}</span>
                            @endif
                        </div>
                    </div> <div class="row mb-3">
                        <label for="max_price" class="col-sm-3 col-form-label required">Max Price</label>
                        <div class="col-sm-4">
                        <input type="number" class="form-control" name="max_price" id="max_price" value="{{ old('max_price') }}" min="1">
                            @if ($errors->has('max_price'))
                            <span class="text-danger">{{ $errors->first('max_price') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="product_description" class="col-sm-3 col-form-label required">Product Description</label>
                        <div class="col-sm-9">
                        <textarea name="product_description" rows="3" class="form-control" id="product_description">{{ old('product_description') }}</textarea>
                            @if ($errors->has('product_description'))
                            <span class="text-danger">{{ $errors->first('product_description') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="product_image" class="col-sm-3 col-form-label required">Product Image</label>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" name="product_image" id="product_image" class="custom-file-input form-control">
                            </div>
                            <div class="img_preview file_preview">
                                <img id="file_img" src="" class="preview_file" />
                                <input type="button" id="remove_btn1" value="x" class="btn-rmv1" title="Delete Image"/>
                            </div>
                            @if ($errors->has('product_image'))
                            <span class="text-danger">{{ $errors->first('product_image') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('storeproducts.index') }}" class="btn btn-secondary">Back</a>
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

    $(".search_select").select2();
// File 1 image
$("#product_image").change(function () {
    $(".file_preview").show();
    var imgControlName = "#file_img";
    readURL(this, imgControlName);
    $('.preview_file').addClass('it');
    $('.btn-rmv1').addClass('rmv');
});

$("#remove_btn1").click(function (e) {
    e.preventDefault();
    $("#product_image").val("");
    $("#file_img").attr("src", "");
    $('.preview_file').removeClass('it');
    $('.btn-rmv1').removeClass('rmv');
    $(".file_preview").hide();
});
});
function readURL(input, imgControlName) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(imgControlName).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
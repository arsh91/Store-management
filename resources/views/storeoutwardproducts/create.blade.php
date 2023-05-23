@extends('layout')
@section('title', 'Add Store Outward Product')
@section('subtitle', 'Add Store Outward Product')
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
                <form method="post" id="addStoreOutwardProductForm" action="{{ route('storeoutwardproducts.store') }}" enctype="multipart/form-data">
                @csrf
                    <div class="row mb-3">
                        <label for="store_product" class="col-sm-3 col-form-label required">Product Name</label>
                        <div class="col-sm-9">
                        <select class="search_select form-select" name="store_product" id="store_product">
                                <option value="">Select Store Product</option>
                                    @foreach($StoreProducts as $product)
                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                    @endforeach
                            </select>
                            @if ($errors->has('store_product'))
                            <span class="text-danger">{{ $errors->first('store_product') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="store_outward_vendor" class="col-sm-3 col-form-label required">Outward Vendor</label>
                        <div class="col-sm-9">
                            <select class="search_select form-select" name="store_outward_vendor" id="store_outward_vendor">
                                <option value="">Select Outward Vendor</option>
                                    @foreach($StoreOutwardVendors as $vendor)
                                        <option value="{{ $vendor->id }}">{{ $vendor->vendor_name }}</option>
                                    @endforeach
                            </select>
                            @if ($errors->has('store_outward_vendor'))
                            <span class="text-danger">{{ $errors->first('store_outward_vendor') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="stock_outward" class="col-sm-3 col-form-label required">Stock Outward</label>
                        <div class="col-sm-9">
                        <input type="number" class="form-control" name="stock_outward" id="stock_outward" value="{{ old('stock_outward') }}" min="1">
                            @if ($errors->has('stock_outward'))
                            <span class="text-danger">{{ $errors->first('stock_outward') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="outward_person" class="col-sm-3 col-form-label required">Outward Person</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="outward_person" id="inward_person_from" value="{{ old('outward_person') }}">
                            @if ($errors->has('outward_person'))
                            <span class="text-danger">{{ $errors->first('outward_person') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="outward_image" class="col-sm-3 col-form-label required">Outward Image</label>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" name="outward_image" id="outward_image" class="custom-file-input form-control">
                            </div>
                            <div class="img_preview file_preview mt-2">
                                <img id="file_img" src="" class="preview_file" />
                                <input type="button" id="remove_btn1" value="x" class="btn-rmv1" title="Delete Image"/>
                            </div>
                            @if ($errors->has('outward_image'))
                            <span class="text-danger">{{ $errors->first('outward_image') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('storeoutwardproducts.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" name="submitoutwardproducts" class="btn btn-primary">Save</button>
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
$("#outward_image").change(function () {
    $(".file_preview").show();
    var imgControlName = "#file_img";
    readURL(this, imgControlName);
    $('.preview_file').addClass('it');
    $('.btn-rmv1').addClass('rmv');
});

$("#remove_btn1").click(function (e) {
    e.preventDefault();
    $("#outward_image").val("");
    $("#file_img").attr("src", "");
    $('.preview_file').removeClass('it');
    $('.btn-rmv1').removeClass('rmv');
    $(".file_preview").hide();
});

$('#product_price').on('input', function() { 
    var productPrice = $(this).val();
    var stock_inward = $("#stock_inward").val();
    var totalAmount = parseInt(productPrice)*parseInt(stock_inward);
    $("#total_amount").val(totalAmount);
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
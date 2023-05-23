@extends('layout')
@section('title', 'Edit Store Inward Product')
@section('subtitle', 'Edit Store Inward Product')
@section('content')
<style>
.it {
  height: 100px;
  margin-left: 10px;
  width: 100px;
}
.btn-rmv {
  display: block;
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
  display: block;
  width: 100%;
}
    </style>
<div class="col-lg-12" style="display: flex;justify-content: center;">
    <div class="card" style="width:740px;">
        <div class="card-body">
            <div class="box-header with-border mt-5" id="filter-box">
                @if(session()->has('message'))
                <div class="alert alert-success message">
                    {{ session()->get('message') }}
                </div>
                @endif
                <form method="post" id="editStoreInwardproductForm" action="{{ route('storeinwardproducts.update', $storeinwardproducts->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                        <label for="store_product" class="col-sm-3 col-form-label required">Product Name</label>
                        <div class="col-sm-9">
                        <select class="search_select form-select" name="store_product" id="store_product">
                                <option value="">Select Store Product</option>
                                    @foreach($StoreProducts as $product)
                                        <option value="{{ $product->id }}" {{ ( $product->id == $storeinwardproducts->store_product_id ) ? 'selected' : '' }}>{{ $product->product_name }}</option>
                                    @endforeach
                            </select>
                            @if ($errors->has('store_product'))
                            <span class="text-danger">{{ $errors->first('store_product') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="store_inward_vendor" class="col-sm-3 col-form-label required">Inward Vendor</label>
                        <div class="col-sm-9">
                            <select class="search_select form-select" name="store_inward_vendor" id="store_inward_vendor">
                                <option value="">Select Inward Vendor</option>
                                    @foreach($StoreInwardVendors as $vendor)
                                        <option value="{{ $vendor->id }}" {{ ( $vendor->id == $storeinwardproducts->store_inward_vendor_id ) ? 'selected' : '' }}>{{ $vendor->vendor_name }}</option>
                                    @endforeach
                            </select>
                            @if ($errors->has('store_inward_vendor'))
                            <span class="text-danger">{{ $errors->first('store_inward_vendor') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="stock_inward" class="col-sm-3 col-form-label required">Stock Inward</label>
                        <div class="col-sm-9">
                        <input type="number" class="form-control" name="stock_inward" id="stock_inward" value="{{ old('stock_inward', $storeinwardproducts->stock_inward ?? '') }}" min="1">
                            @if ($errors->has('stock_inward'))
                            <span class="text-danger">{{ $errors->first('stock_inward') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="product_price" class="col-sm-3 col-form-label required">Product Price</label>
                        <div class="col-sm-9">
                        <input type="number" class="form-control" name="product_price" id="product_price" value="{{ old('product_price', $storeinwardproducts->product_price ?? '') }}" min="1">
                            @if ($errors->has('product_price'))
                            <span class="text-danger">{{ $errors->first('product_price') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="total_amount" class="col-sm-3 col-form-label required">Total Amount</label>
                        <div class="col-sm-9">
                        <input type="number" class="form-control" name="total_amount" id="total_amount" value="{{ old('total_amount', $storeinwardproducts->total_amount ?? '') }}" min="1">
                            @if ($errors->has('total_amount'))
                            <span class="text-danger">{{ $errors->first('total_amount') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="bill_no" class="col-sm-3 col-form-label required">Bill No</label>
                        <div class="col-sm-9">
                        <input type="number" class="form-control" name="bill_no" id="bill_no" value="{{ old('bill_no', $storeinwardproducts->bill_no ?? '') }}" min="1">
                            @if ($errors->has('bill_no'))
                            <span class="text-danger">{{ $errors->first('bill_no') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inward_person_from" class="col-sm-3 col-form-label required">Inward From</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" name="inward_person_from" id="inward_person_from" value="{{ old('inward_person_from', $storeinwardproducts->inward_person_from ?? '') }}">
                            @if ($errors->has('inward_person_from'))
                            <span class="text-danger">{{ $errors->first('inward_person_from') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="bill_image" class="col-sm-3 col-form-label required">Product Image</label>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" name="bill_image" id="bill_image" class="custom-file-input form-control">
                            </div>
                            <div class="img_preview file_preview mt-2">
                                <img id="file_img" src="{{asset('').$storeinwardproducts->bill_image}}" class="preview_file it" />
                                <input type="button" id="remove_btn1" value="x" class="btn-rmv1 rmv" title="Delete Image"/>
                            </div>
                            @if ($errors->has('bill_image'))
                            <span class="text-danger">{{ $errors->first('bill_image') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('storeinwardproducts.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" name="submitstoreproducts" class="btn btn-primary">Update</button>
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
    
    // File 1 image
    $("#bill_image").change(function () {
        $(".file_preview").show();
        var imgControlName = "#file_img";
        readURL(this, imgControlName);
        $('.preview_file').addClass('it');
        $('.btn-rmv1').addClass('rmv');
    });

    $("#remove_btn1").click(function (e) {
        e.preventDefault();
        $("#bill_image").val("");
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
@extends('layout')
@section('title', 'Add Store Outward Product Reversal')
@section('subtitle', 'Add Store Outward Product Reversal')
@section('content')
<style>
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
                <form method="post" id="addStoreOutwardProductReversalForm" action="{{ route('storeoutwardproductreversals.store') }}" enctype="multipart/form-data">
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
                        <label for="outward" class="col-sm-3 col-form-label required">Outward</label>
                        <div class="col-sm-9">
                        <select class="search_select form-select" name="outward" id="outward">
                                <option value="">Select Store Product</option>
                                    @foreach($StoreOutwardVendors as $vendor)
                                        <option value="{{ $vendor->id }}">{{ $vendor->vendor_name }}</option>
                                    @endforeach
                            </select>
                            @if ($errors->has('outward'))
                            <span class="text-danger">{{ $errors->first('outward') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="reversal_quantity" class="col-sm-3 col-form-label required">Reversal Quantity</label>
                        <div class="col-sm-9">
                        <input type="number" class="form-control" name="reversal_quantity" id="reversal_quantity" value="{{ old('reversal_quantity') }}" min="1">
                            @if ($errors->has('reversal_quantity'))
                            <span class="text-danger">{{ $errors->first('reversal_quantity') }}</span>
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
});

</script>
@endsection
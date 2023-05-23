@extends('layout')
@section('title', 'Edit Store Outward Product Reversal')
@section('subtitle', 'Edit Store Outward Product Resversal')
@section('content')
<style>
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
                <form method="post" id="editStoreOutwardproductreversalForm" action="{{ route('storeoutwardproductreversals.update', $storeoutwardproductreversals->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                        <label for="store_product" class="col-sm-3 col-form-label required">Product Name</label>
                        <div class="col-sm-9">
                        <select class="search_select form-select" name="store_product" id="store_product">
                                <option value="">Select Store Product</option>
                                    @foreach($StoreProducts as $product)
                                        <option value="{{ $product->id }}" {{ ( $product->id == $storeoutwardproductreversals->store_product_id ) ? 'selected' : '' }}>{{ $product->product_name }}</option>
                                    @endforeach
                            </select>
                            @if ($errors->has('store_product'))
                            <span class="text-danger">{{ $errors->first('store_product') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="outward" class="col-sm-3 col-form-label required">Outward Vendor</label>
                        <div class="col-sm-9">
                            <select class="search_select form-select" name="outward" id="outward">
                                <option value="">Select Inward Vendor</option>
                                    @foreach($StoreOutwardVendors as $vendor)
                                        <option value="{{ $vendor->id }}" {{ ( $vendor->id == $storeoutwardproductreversals->outward_id ) ? 'selected' : '' }}>{{ $vendor->vendor_name }}</option>
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
                        <input type="number" class="form-control" name="reversal_quantity" id="reversal_quantity" value="{{ old('reversal_quantity', $storeoutwardproductreversals->reversal_quantity ?? '') }}" min="1">
                            @if ($errors->has('reversal_quantity'))
                            <span class="text-danger">{{ $errors->first('reversal_quantity') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('storeoutwardproductreversals.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" name="submitstoreproductreversals" class="btn btn-primary">Update</button>
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
@extends('layout')
@section('title', 'Add Store Inward Vendor')
@section('subtitle', 'Add Store Inward Vendor')
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
                <form method="post" id="addStoreInwardVendorForm" action="{{ route('storeinwardvendors.store') }}">
                @csrf
                    <div class="alert alert-danger" style="display:none"></div>

                    <div class="row mb-3">
                        <label for="vendor_name" class="col-sm-3 col-form-label required">Vendor Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="vendor_name" id="vendor_name" value="{{ old('vendor_name') }}">
                            @if ($errors->has('vendor_name'))
                            <span class="text-danger">{{ $errors->first('vendor_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="vendor_description" class="col-sm-3 col-form-label required">Vendor Description</label>
                        <div class="col-sm-9">
                        <textarea name="vendor_description" rows="3" class="form-control" id="vendor_description">{{ old('vendor_description') }}</textarea>
                            @if ($errors->has('vendor_description'))
                            <span class="text-danger">{{ $errors->first('vendor_description') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('storeinwardvendors.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" name="submitInwardVendor" class="btn btn-primary">Add Inward Vendor</button>
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
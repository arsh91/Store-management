@extends('layout')
@section('title', 'Edit Store')
@section('subtitle', 'Edit Store')
@section('content')

<div class="col-lg-12" style="display: flex;justify-content: center;">
    <div class="card" style="width:580px;">
        <div class="card-body">
            <div class="box-header with-border mt-5" id="filter-box">
                @if(session()->has('message'))
                <div class="alert alert-success message">
                    {{ session()->get('message') }}
                </div>
                @endif
                <form method="post" id="addStoreForm" action="{{ route('stores.update', $storeData->storeId) }}">
                @csrf
                    <div class="alert alert-danger" style="display:none"></div>

                    <div class="row mb-3">
                        <label for="name" class="col-sm-3 col-form-label required">Store Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $storeData->name ?? '') }}">
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="location" class="col-sm-3 col-form-label required">Store Location</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="location" id="location" value="{{ old('location', $storeData->location ?? '') }}">
                            @if ($errors->has('location'))
                            <span class="text-danger">{{ $errors->first('location') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="city" class="col-sm-3 col-form-label required">City</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="city" id="city" value="{{ old('city', $storeData->city ?? '') }}">
                            @if ($errors->has('city'))
                            <span class="text-danger">{{ $errors->first('city') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="state" class="col-sm-3 col-form-label required">State</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="state" id="state" value="{{ old('state', $storeData->state ?? '') }}">
                            @if ($errors->has('state'))
                            <span class="text-danger">{{ $errors->first('state') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="pincode" class="col-sm-3 col-form-label">Pincode</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="pincode" id="pincode" value="{{ old('pincode', $storeData->pincode ?? '') }}" autofocus>
                            @if ($errors->has('pincode'))
                            <span class="text-danger">{{ $errors->first('pincode') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('stores.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" name="submitstore" class="btn btn-primary">Update Store</button>
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
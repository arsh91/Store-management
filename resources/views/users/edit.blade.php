@extends('layout')
@section('title', 'Edit Users')
@section('subtitle', 'Edit Users')
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
                <form method="post" id="editUsersForm" action="{{ route('users.update', $usersData->id) }}">
                @csrf
                <div class="row mb-3">
                        <label for="email" class="col-sm-3 col-form-label required">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="email" id="email" value="{{ old('email', $usersData->email ?? '') }}">
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <!-- <div class="row mb-3">
                        <label for="password" class="col-sm-3 col-form-label required">Password</label>
                        <div class="col-sm-9" style="display: flex;">
                            <input type="password" class="form-control" name="password" id="password" autocomplete="new-password" value="{{ old('password', $usersData->password ?? '') }}">
                            <i class="bi bi-eye-slash mt-2" id="eye" style="margin-left: -30px; cursor: pointer;"></i>

                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div> -->
                    <!-- <div class="row mb-4">
                        <label for="password_confirmation" class="col-sm-3 col-form-label required"> Confirm
                            Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control mb-6" name="password_confirmation"
                                id="password_confirmation" value="{{ old('password_confirmation') }}">
                                @if ($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                        </div>
                    </div> -->
                    <!-- <hr> -->
                    <div class="row mb-3 mt-4">
                        <label for="user_name" class="col-sm-3 col-form-label required">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $usersData->name ?? '') }}">
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="phone" class="col-sm-3 col-form-label required">Phone</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="phone" id="phone" value="{{ old('phone', $usersData->phone ?? '') }}">
                            @if ($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="address" class="col-sm-3 col-form-label required">Address</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address" id="address"
                                placeholder="Apartment, studio, or floor" value="{{ old('address', $usersData->address ?? '') }}">
                                @if ($errors->has('address'))
                                <span class="text-danger">{{ $errors->first('address') }}</span>
                                @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="city" class="col-sm-3 col-form-label required">City</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="city" id="city" value="{{ old('city', $usersData->city ?? '') }}">
                            @if ($errors->has('city'))
                            <span class="text-danger">{{ $errors->first('city') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="district" class="col-sm-3 col-form-label required">District</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="district" id="district" value="{{ old('district', $usersData->district ?? '') }}">
                            @if ($errors->has('district'))
                            <span class="text-danger">{{ $errors->first('district') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="state" class="col-sm-3 col-form-label required">State</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="state" id="state" value="{{ old('state', $usersData->state ?? '') }}">
                            @if ($errors->has('state'))
                            <span class="text-danger">{{ $errors->first('state') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="pincode" class="col-sm-3 col-form-label">Pincode</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="pincode" id="pincode" maxlength="6" value="{{ old('pincode', $usersData->pincode ?? '') }}">
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" name="submitstore" class="btn btn-primary">Update User</button>
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

    $('#eye').click(function(){
       if($(this).hasClass('bi-eye-slash')){
         $(this).removeClass('bi-eye-slash');
         $(this).addClass('bi-eye');
         $('#password').attr('type','text');
       }else{
         $(this).removeClass('bi-eye');
         $(this).addClass('bi-eye-slash');  
         $('#password').attr('type','password');
       }
   });
});
</script>
@endsection
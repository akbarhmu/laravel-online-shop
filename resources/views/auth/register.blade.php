@section('title', __('Register'))
@extends('layouts.guest')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
        <div class="login-brand">
            <x-jet-authentication-card-logo />
        </div>

        <div class="card card-primary">
            <div class="card-header"><h4>{{__('Register')}}</h4></div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">{{__('Name')}}</label>
                        <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{old('name')}}" required autofocus autocomplete="name" >
                        <x-jet-input-error for="name"></x-jet-input-error>
                    </div>

                    <div class="form-group">
                        <label for="email">{{__('Email')}}</label>
                        <input id="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{old('email')}}" required>
                        <x-jet-input-error for="email"></x-jet-input-error>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 col-xs-12">
                            <label for="password" class="d-block">{{__('Password')}}</label>
                            <input id="password" type="password" class="form-control pwstrength {{ $errors->has('password') ? 'is-invalid' : '' }}" data-indicator="pwindicator" name="password" required autocomplete="new-password">
                            <div id="pwindicator" class="pwindicator">
                            <div class="bar"></div>
                            <div class="label"></div>
                            </div>
                            <x-jet-input-error for="password"></x-jet-input-error>
                        </div>
                        <div class="form-group col-md-6 col-xs-12">
                            <label class="d-block">{{__('Confirm Password')}}</label>
                            <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password_confirmation" required autocomplete="new-password">
                            <x-jet-input-error for="password_confirmation"></x-jet-input-error>
                        </div>
                    </div>

                    <div class="form-divider">
                    {{__('Your Home')}}
                    </div>
                    <div class="row">
                    <div class="form-group col-12">
                        <label>{{__('Address')}}</label>
                        <input type="text" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" required autocomplete="address-line1" value="{{old('address')}}">
                        <x-jet-input-error for="address"></x-jet-input-error>
                    </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6 col-xs-12">
                        <label>{{__('Province')}}</label>
                        <select class="form-control selectric  {{ $errors->has('province_id') ? 'is-invalid' : '' }}" name="province_id" id="province_id" required value="{{old('province_id')}}">
                        @foreach($provinces as $province)
                            <option value="{{$province->id}}">{{$province->province}}</option>
                        @endforeach
                        </select>
                        <x-jet-input-error for="province_id"></x-jet-input-error>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>{{__('City')}}</label>
                        <select class="form-control selectric  {{ $errors->has('city_id') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required value="{{old('city_id')}}">
                        </select>
                        <x-jet-input-error for="city_id"></x-jet-input-error>
                    </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6 col-xs-12">
                        <label>{{__('Subdistrict')}}</label>
                        <input type="text" class="form-control {{ $errors->has('subdistrict') ? 'is-invalid' : '' }}" name="subdistrict" id="subdistrict" required value="{{old('subdistrict')}}">
                        <x-jet-input-error for="subdistrict"></x-jet-input-error>
                    </div>
                    <div class="form-group col-md-6 col-xs-12">
                        <label>{{__('Postal Code')}}</label>
                        <input type="text" class="form-control {{ $errors->has('postal_code') ? 'is-invalid' : '' }}" name="postal_code" id="postal_code" required value="{{old('postal_code')}}">
                        <x-jet-input-error for="postal_code"></x-jet-input-error>
                    </div>
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="terms" class="custom-control-input" id="terms">
                            <label class="custom-control-label" for="terms">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                            </label>
                        </div>
                    </div>
                    @endif

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                            {{__('Register')}}
                        </button>

                        <div class="mt-4 text-muted text-center">
                            {{__("Already registered?")}} <a href="{{ route('login') }}">{{__('Log in')}}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="simple-footer">
            <x-copyright />
        </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    var toHtml = (tag, value) => {
	    $(tag).html(value);
	}

    $('#province_id').on('change',function(){
        var id = $('#province_id').val();
        var url = window.location.href;
        var urlNya = url.substring(0, url.lastIndexOf('/register'));
        $.ajax({
            type:'GET',
            url:urlNya + '/api/city/by-province/' + id,
            dataType:'json',
            success:function(data){
                var op = '';
                if(data.length > 0) {
                    var i = 0;
                    for(i = 0; i < data.length; i++) {
                        op += `<option value="${data[i].id}">${data[i].city_name}</option>`
                    }
                }
                toHtml('[name="city_id"]', op);
            }
        })
    })
    $('#province_id').trigger('change');

    @if (old('province_id')!=null)
        $(document).ready(function() {
            $('#province_id').val({{old('province_id')}});
            $('#province_id').trigger('change');

            setTimeout(function() {
                $('#city_id').val({{old('city_id')}});
            }, 1500);
        });
    @endif
</script>
@endsection

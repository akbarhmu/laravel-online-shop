@section('title', __('Address'))
@extends('user.layouts.app-livewire')
@section('content')
<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="section-body">
                    <div class="card">
                        <div class="card-header bg-primary text-light">
                            {{__('Current Address')}}
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success mb-3" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger mb-3" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form action="{{route('address.update')}}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="form-group col-12">
                                    <label>{{__('Address')}}</label>
                                    <input type="text" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" required autocomplete="address-line1" value="{{old('address', Auth::user()->address)}}">
                                    <x-jet-input-error for="address"></x-jet-input-error>
                                </div>
                                <div class="form-group col-md-12 col-xs-12">
                                    <label>{{__('Subdistrict')}}</label>
                                    <input type="text" class="form-control {{ $errors->has('subdistrict') ? 'is-invalid' : '' }}" name="subdistrict" id="subdistrict" required value="{{old('subdistrict', Auth::user()->subdistrict)}}">
                                    <x-jet-input-error for="subdistrict"></x-jet-input-error>
                                </div>
                                <div class="form-group col-md-12 col-xs-12">
                                    <label>{{__('City')}}</label>
                                    <select class="form-control selectric  {{ $errors->has('city_id') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required value="{{old('city_id')}}">
                                        <option value="">Loading...</option>
                                    </select>
                                    <x-jet-input-error for="city_id"></x-jet-input-error>
                                </div>
                                <div class="form-group col-md-12 col-xs-12">
                                    <label>{{__('Province')}}</label>
                                    <select class="form-control selectric  {{ $errors->has('province_id') ? 'is-invalid' : '' }}" name="province_id" id="province_id" required value="{{old('province_id')}}">
                                    @foreach($provinces as $province)
                                        <option value="{{$province->id}}">{{$province->province}}</option>
                                    @endforeach
                                    </select>
                                    <x-jet-input-error for="province_id"></x-jet-input-error>
                                </div>
                                <div class="form-group col-md-12 col-xs-12">
                                    <label>{{__('Postal Code')}}</label>
                                    <input type="text" class="form-control {{ $errors->has('postal_code') ? 'is-invalid' : '' }}" name="postal_code" id="postal_code" required value="{{old('postal_code', Auth::user()->postal_code)}}">
                                    <x-jet-input-error for="postal_code"></x-jet-input-error>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary btn-lg" tabindex="4">
                                        {{__('Save')}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
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
        var urlNya = url.substring(0, url.lastIndexOf('/user'));
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

    $(document).ready(function() {
        $('#province_id').val({{old('province_id', Auth::user()->province_id)}});
        $('#province_id').trigger('change');

        setTimeout(function() {
            $('#city_id').val({{old('city_id', Auth::user()->city_id)}});
        }, 1500);
    });
</script>
@endsection

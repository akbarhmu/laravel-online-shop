@section('title', __('Shop'))
@extends('admin.layouts.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>{{__('Shop')}}</h1>
        <div class="section-header-breadcrumb">
        </div>
        </div>

        <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>{{__('Settings')}}</h4>
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

                <form action="{{route('shops.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="logo">{{__('Logo')}}</label>
                        <br>
                        <div class="box-preview">
                            <img id="logo-preview" src="{{asset('images/logo/logo.png')}}" />
                            <div class="logo-hover"></div>
                        </div>
                        <x-jet-input-error for="logo"></x-jet-input-error>
                        <input type="file" name="logo" id="logo" onchange="loadFile(event)" class="form-control @error('logo') is-invalid @enderror p-1" hidden>
                    </div>
                    <div class="form-group">
                        <label for="name">{{__('Name')}}</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name', $shop->name)}}" required autofocus>
                        <x-jet-input-error for="name"></x-jet-input-error>
                    </div>
                    <div class="form-group">
                        <label for="phone">{{__('Phone Number')}}</label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone', $shop->phone)}}" required autofocus>
                        <x-jet-input-error for="phone"></x-jet-input-error>
                    </div>
                    <div class="form-group">
                        <label for="address">{{__('Address')}}</label>
                        <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{old('address', $shop->address)}}" required>
                        <x-jet-input-error for="address"></x-jet-input-error>
                    </div>
                    <div class="form-group">
                        <label>{{__('Subdistrict')}}</label>
                        <input type="text" class="form-control @error('subdistrict') is-invalid @enderror" name="subdistrict" id="subdistrict" required value="{{old('subdistrict', $shop->subdistrict)}}">
                        <x-jet-input-error for="subdistrict"></x-jet-input-error>
                    </div>
                    <div class="form-group">
                        <label>{{__('City')}}</label>
                        <select class="form-control @error('city_id') is-invalid @enderror" name="city_id" id="city_id" required value="{{old('city_id')}}">
                        </select>
                        <x-jet-input-error for="city_id"></x-jet-input-error>
                    </div>
                    <div class="form-group">
                        <label>{{__('Province')}}</label>
                        <select class="form-control selectric  @error('province_id') is-invalid @enderror" name="province_id" id="province_id" required value="{{old('province_id')}}">
                        @foreach($provinces as $province)
                            <option value="{{$province->id}}">{{$province->province}}</option>
                        @endforeach
                        </select>
                        <x-jet-input-error for="province_id"></x-jet-input-error>
                    </div>
                    <div class="form-group">
                        <label>{{__('Postal Code')}}</label>
                        <input type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" id="postal_code" required value="{{old('postal_code', $shop->postal_code)}}">
                        <x-jet-input-error for="postal_code"></x-jet-input-error>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary btn-lg">{{__('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </section>
</div>
@endsection
@section('css')
    <style>
        .box-preview{z-index:1;position:relative;width:150px;height:150px;}
        .box-preview img{width:150px; height:150px;}
        .logo-hover{
            z-index:2;
            position:absolute;left:0;right:0;top:0;bottom:0;
        }

        .logo-hover:hover{
        background:url("{{asset('images/admin/refresh.png')}}") center no-repeat;
        background-size:50%;
        background-color:rgba(255,255,255,0.8);
        }

    </style>
@endsection
@section('js')
    <script type="text/javascript">
	  var loadFile = function(event) {
	    var output = document.getElementById('logo-preview');
	    output.src = URL.createObjectURL(event.target.files[0]);
	  };
      $('.logo-hover').click(function(){ $('#logo').trigger('click'); });
	</script>
    <script type="text/javascript">
        var toHtml = (tag, value) => {
            $(tag).html(value);
        }

        $('#province_id').on('change',function(){
            var id = $('#province_id').val();
            var url = window.location.href;
            var urlNya = url.substring(0, url.lastIndexOf('/dashboard'));
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
            $('#province_id').val({{old('province_id', $shop->province_id)}});
            $('#province_id').trigger('change');

            setTimeout(function() {
                $('#city_id').val({{old('city_id', $shop->city_id)}});
            }, 1500);
        });
    </script>
@endsection

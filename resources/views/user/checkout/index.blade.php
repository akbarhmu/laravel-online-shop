@section('title', __('Checkout'))
@extends('user.layouts.app')
@section('content')
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="{{route('index')}}">{{__('Home')}}</a> <span class="mx-2 mb-0">/</span> <a href="{{route('carts.index')}}">{{__('Cart')}}</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{__('Checkout')}}</strong></div>
        </div>
      </div>
    </div>


    <div class="site-section">
      <div class="container">
          <form action="{{route('checkouts.store')}}" method="post">
            @csrf
            <div class="row">
            <div class="col-md-6 mb-5 mb-md-0">
                <h2 class="h3 mb-3 text-black">{{__('Order Details')}}</h2>
                <div class="p-3 p-lg-5 border">
                <div class="form-group">
                    <label for="order_name" class="text-black">{{__('Name')}} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('order_name') is-invalid @enderror" id="order_name" name="order_name" value="{{old('order_name', Auth::user()->name)}}" autofocus>
                    <x-jet-input-error for="order_name"></x-jet-input-error>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="order_address" class="text-black">{{__('Address')}} <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-6 text-right">
                            <label for="c_address" class="text-black"><a href="{{route('profile.address')}}">{{__('Change')}}</a></label>
                        </div>
                    </div>
                    <textarea type="text" class="form-control" id="order_address" name="order_address" disabled>{{$address}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="order_phone" class="text-black @error('order_phone') is-invalid @enderror">{{__('Phone Number')}} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="order_phone" name="order_phone" placeholder="08xxxx" value="{{old('order_phone')}}">
                    <x-jet-input-error for="order_phone"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <label for="order_notes" class="text-black">{{__('Order Notes')}}</label>
                    <textarea name="order_notes" id="order_notes" cols="30" rows="5" class="form-control @error('order_notes') is-invalid @enderror" placeholder="Tulis keterangan tambahan disini...">{{old('order_notes')}}</textarea>
                    <x-jet-input-error for="order_notes"></x-jet-input-error>
                </div>
                <div class="form-group">
                    <label for="courier" class="text-black">{{__('Couriers')}}</label><br>
                    <select name="courier" id="courier" class="form-control">
                        <option value="jne">JNE Reguler (@rupiah($cost_jne))</option>
                        <option value="pos">POS Kilat Khusus (@rupiah($cost_pos))</option>
                    </select>
                </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="row mb-5">
                <div class="col-md-12">
                    <h2 class="h3 mb-3 text-black">{{__('Your Order')}}</h2>
                    <div class="p-3 p-lg-5 border">
                    <table class="table site-block-order-table mb-5">
                        <thead>
                        <th>{{__('Products')}}</th>
                        <th>{{__('Total')}}</th>
                        </thead>
                        <tbody>
                        @foreach ($carts as $product)
                            <tr>
                                <td>{{$product->product_name}} <strong class="mx-2">x</strong> {{$product->quantity}}</td>
                                <td>@rupiah($product->price*$product->quantity)</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="text-black font-weight-bold"><strong>{{__('Subtotal')}}</strong></td>
                            <td class="text-black">@rupiah($subtotal)</td>
                        </tr>
                        <tr>
                            <td class="text-black font-weight-bold"><strong>{{__('Shipping Cost')}}</strong></td>
                            <td class="text-black" id="cost_text"></td>
                        </tr>
                        <tr>
                            <td class="text-black font-weight-bold"><strong>{{__('Order Total')}}</strong></td>
                            <td class="text-black font-weight-bold" id="total_text"><strong></strong></td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg py-3 btn-block">{{__('Place Order')}}</button>
                    </div>

                    </div>
                </div>
                </div>

            </div>
            </div>
          </form>
      </div>
    </div>
@endsection
@section('js')
    <script>
        $('#courier').change(function() {
            changeTextCost();
            calculateTotal();
        });
        function changeTextCost(){
            document.getElementById('cost_text').innerHTML = formatRupiah(getCost(), 'Rp. ');
        }
        function getCost(){
            courier = $('select[name=courier] option').filter(':selected').val();
            if(courier=="jne"){
                cost = {{$cost_jne}};
            }else{
                cost = {{$cost_pos}};
            }
            return cost;
        }
        function formatRupiah(angka, prefix){
			var number_string = angka.toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}

			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}

        function calculateTotal(){
            total = {{$subtotal}} + getCost();
            document.getElementById('total_text').innerHTML = formatRupiah(total, 'Rp. ');
        }
        @if (old('courier')!=null)
            $('#courier').val({{old('courier')}});
        @endif
        changeTextCost();
        calculateTotal();
    </script>
@endsection

<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentMethodRequest;
use App\Models\PaymentMethod;
use Exception;
use Faker\Provider\ar_SA\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payment_methods = PaymentMethod::paginate(10);
        return view('admin.payments.index', ['payment_methods'=>$payment_methods]);
    }

    public function create()
    {
        return view('admin.payments.create');
    }

    public function store(PaymentMethodRequest $request)
    {
        $validatedData = $request->validated();

        try{
            $payment_method                 = new PaymentMethod();
            $payment_method->account        = $validatedData['account'];
            $payment_method->account_name   = $validatedData['account_name'];
            $payment_method->account_number = $validatedData['account_number'];
            $payment_method->save();

            return redirect()->route('payments.index')->with('status', __('Payment method successfully added'));
        }catch(Exception $e){
            return back()->with('error', __("Payment method can't be added"));
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $payment_method = PaymentMethod::find($id);
        return view('admin.payments.edit', ['payment_method'=>$payment_method]);
    }

    public function update(PaymentMethodRequest $request, PaymentMethod $payment)
    {
        $validatedData = $request->validated();
        PaymentMethod::find($payment->id)->update($validatedData);
        return redirect()->route('payments.index')->with('status', __('Payment method updated successfully'));
    }

    public function destroy(PaymentMethod $payment)
    {
        $payment_method = PaymentMethod::where('id', $payment->id)->first();

        if($payment_method != null){
            try{
                $payment_method->delete();
                return back()->with('status', __('Payment deleted successfully'));
            }catch(Exception $e){
                return back()->with('error', "Payment method can't be deleted");
            }
        }

        return back()->with('error', __("Payment method doesn't exist"));
    }
}

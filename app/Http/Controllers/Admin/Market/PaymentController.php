<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\Market\Payment;
use App\Models\Market\CashPayment;
use App\Http\Controllers\Controller;
use App\Models\Market\OnlinePayment;
use App\Models\Market\OfflinePayment;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return view('admin.market.payment.index',compact('payments'));
    }
    public function offline()
    {
        $payments = Payment::where('paymentable_type',OfflinePayment::class)->get();
        return view('admin.market.payment.index',compact('payments'));
    }
    public function online()
    {
        $payments = Payment::where('paymentable_type',OnlinePayment::class)->get();
        return view('admin.market.payment.index',compact('payments'));
    }
    public function cash()
    {
        $payments = Payment::where('paymentable_type',CashPayment::class)->get();
        return view('admin.market.payment.index',compact('payments'));
    }
    public function canceled(Payment $payment)
    {
        $payment->status = 2;
        $payment->save();
        // return redirect()->route('admin.market.payment.index')->with('swal-success','تغییر شما با موفقیت انجام شد');
        return redirect()->back()->with('swal-success','تغییر شما با موفقیت انجام شد');
    }
    public function returned(Payment $payment)
    {
        $payment->status = 3;
        $payment->save();
        // return redirect()->route('admin.market.payment.index')->with('swal-success','تغییر شما با موفقیت انجام شد');
        return redirect()->back()->with('swal-success','تغییر شما با موفقیت انجام شد');

    }

}

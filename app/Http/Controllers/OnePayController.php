<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Gateway;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Auth;

class OnePayController extends Controller
{
    public function index(){
        $pageTitle = 'Deposit With OnePay';
        $user = Auth::user();
        return view('theme3.user.gateway.onepay.deposit', compact('pageTitle', 'user'));
    }
    //onepay methods page view
    public function methods()
    {
        $pageTitle = 'OnePay Methods';
        $gatewayCurrency = Gateway::where('status', 1)->get();
        return view('theme3.user.gateway.onepay.methods', compact('gatewayCurrency', 'pageTitle'));
    }

    public function checkout()
    {
        $pageTitle = 'OnePay Checkout';
        $gatewayCurrency = Gateway::where('status', 1)->get();
        return view('theme3.user.gateway.onepay.checkout', compact('gatewayCurrency', 'pageTitle'));
    }
    public function orderCancel()
    {
        $pageTitle = 'Order Cancel';
        return view('theme3.user.gateway.onepay.order_cancel', compact('pageTitle'));
    }

    public function orderSuccess()
    {
        $pageTitle = 'Order Success';
        return view('theme3.user.gateway.onepay.order_success', compact('pageTitle'));
    }
    public function orderError()
    {
        $pageTitle = 'Order Error';
        return view('theme3.user.gateway.onepay.order_error', compact('pageTitle'));
    }

    // public function checkoutConfirm(Request $request)
    // {
    //     $general = GeneralSetting::first();
    //     $data = new Deposit();
    //     $data->user_id = auth()->user()->id;
    //     $data->method_code = $request->method_code;
    //     $data->amount = $request->amount;
    //     $data->method_currency = $request->method_currency;
    //     $data->charge = $request->charge;
    //     $data->rate = $request->rate;
    //     $data->final_amo = $request->final_amo;
    //     $data->transaction_id = $request->transaction_id;
    //     $data->trx = $request->trx;
    //     $data->status = 2; // pending
    //     $data->save();

    //     $adminNotification = new AdminNotification();
    //     $adminNotification->user_id = $data->user->id;
    //     $adminNotification->title = 'Deposit request from '.$data->user->username;
    //     $adminNotification->click_url = urlPath('admin.deposit.details',$data->id);
    //     $adminNotification->save();

    //     $general = GeneralSetting::first();
    //     notify($data->user, 'DEPOSIT_REQUEST', [
    //         'method_name' => $data->gatewayCurrency()->name,
    //         'method_currency' => $data->method_currency,
    //         'method_amount' => showAmount($data->final_amo),
    //         'amount' => showAmount($data->amount),
    //         'charge' => showAmount($data->charge),
    //         'currency' => $general->cur_text,
    //         'rate' => showAmount($data->rate),
    //         'trx' => $data->trx
    //     ]);

    //     return response()->json(['msg'=>'পেমেন্ট জমা দেওয়া হয়েছে!','cls'=>'success']);

    // }

    //ajax-gateway-confirm
    public function checkoutConfirm(Request $request)
    {
        // dd($request->all());

        $gateway = Gateway::where('status', 1)->findOrFail($request->id);


        $deposit = Deposit::create([
            'gateway_id' => $gateway->id,
            'user_id' => auth()->id(),
            'transaction_id' => $request->trx,
            'amount' => $request->amount,
            'rate' => $request->rate,
            'charge' => $request->charge,
            'final_amount' => $request->final_amo,
            'number'=> $request->transaction_id,
            'payment_status' => 0,
            'payment_type' => 1,
        ]);

        if ($gateway->is_created) {
            $new = __NAMESPACE__ . '\\Gateway\\' . 'manual\ProcessController';
        }


        $data = $new::process($request, $gateway, $deposit->final_amount, $deposit);

        $notify = 'Your Payment is Successfully Recieved';
        return response()->json(['msg'=>$notify, 'cls'=>'success', 'data'=>$data]);
    }




    public function methodDetails(Request $request){
        // dd($request->all());
        $gatewayMethod = Gateway::where('status', 1)->where('id', $request->method_id)->first();
        return response()->json(['cls'=>'success','gatewayMethod'=>$gatewayMethod]);
    }


    ////////////
    // USDT ////
    ////////////


    public function indexUSDT(){
        $pageTitle = 'Deposit With usdt';
        $user = Auth::user();
        $gatewayMethod = Gateway::where('status', 1)->whereJsonContains('gateway_parameters', ['gateway_currency' => 'usdt'])->first();
        return view('theme3.user.gateway.usdt.index', compact('pageTitle', 'user', 'gatewayMethod'));
    }

    public function usdtConfirm(Request $request)
    {
        $gateway = Gateway::where('status', 1)->whereJsonContains('gateway_parameters', ['gateway_currency' => 'usdt'])->first();

        if ($gateway->min_limit > $request->amount || $gateway->max_limit < $request->amount) {
            $notify[] = ['error', 'Check Deposit Limit!'];
            return back()->withNotify($notify);
        }

        $final_amo = $request->amount + $gateway->charge;

        if ($request->has('screenshot')) {

            $screenshot = time() . '.' . $request->screenshot->getClientOriginalExtension();

            $request->screenshot->move(filePath('deposit/screenshots'), $screenshot);
        }

        $deposit = Deposit::create([
            'gateway_id' => $gateway->id,
            'user_id' => auth()->id(),
            'transaction_id' => strtoupper(Str::random()),
            'amount' => $request->amount,
            'rate' => $gateway->rate,
            'charge' => $gateway->charge,
            'final_amount' => $final_amo,
            'number'=> null,
            'screenshot'=> $screenshot,
            'payment_status' => 0,
            'payment_type' => 1,
        ]);

        if ($gateway->is_created) {
            $new = __NAMESPACE__ . '\\Gateway\\' . 'manual\ProcessController';
        }


        $data = $new::process($request, $gateway, $deposit->final_amount, $deposit);

        $notify[] = ['success', 'Deposit Confirm!'];
        return redirect(route('user.deposit.log'))->withNotify($notify);
    }
}

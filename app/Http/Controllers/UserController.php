<?php

namespace App\Http\Controllers;

use Image;
use Purifier;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Deposit;
use App\Models\Payment;
use App\Models\Ranking;
use Nette\Utils\Random;
use App\Models\Withdraw;
use App\Models\Transaction;
use App\Models\UserRanking;
use Illuminate\Support\Str;
use App\Models\UserInterest;
use Illuminate\Http\Request;
use App\Models\MoneyTransfer;
// use Auth;
use App\Models\GeneralSetting;
use App\Models\KycVerify;
use App\Models\WithdrawGateway;
use App\Models\RefferedCommission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $general = GeneralSetting::first();
        $this->template = $general->theme == 1 ? 'frontend.' : "theme{$general->theme}.";
    }

    // ajax dashboard view
    public function ajaxDashboard()
    {
        $pageTitle = "Dashboard";
        $user = Auth::user();
        $totalInvest = Payment::where('user_id', Auth::id())->where('payment_status', 1)->sum('amount');
        $currentInvest = Payment::where('user_id', Auth::id())->where('payment_status', 1)->latest()->first('amount');
        $currentPlan = Payment::with('plan')->where('user_id', Auth::id())->where('payment_status', 1)->latest()->first();
        $allPlan = Payment::with('plan')->where('user_id', Auth::id())->latest()->paginate(10, ['*'], 'plan');
        $withdraw = Withdraw::where('user_id', Auth::id())->where('status', 1)->sum('withdraw_amount');
        $interestLogs = UserInterest::with('payment')->where('user_id', Auth::id())->latest()->paginate(10, ['*'], 'log');

        $commison = RefferedCommission::where('reffered_by', Auth::id())->sum('amount');

        $pendingInvest = Payment::where('user_id', Auth::id())->where('payment_status', 2)->sum('amount');
        $pendingWithdraw = Withdraw::where('user_id', Auth::id())->where('status', 0)->sum('withdraw_amount');
        $totalDeposit = Deposit::where('user_id', Auth::id())->where('payment_status', 1)->sum('amount');

        $today['earning'] = Transaction::where('user_id', $user->id)->where('gateway_transaction', 'trading')->where('type', '+')->whereDate('created_at', Carbon::today())->sum('amount');
        $total['earning'] = Transaction::where('user_id', $user->id)->where('gateway_transaction', 'trading')->where('type', '+')->sum('amount');

        return view($this->template . 'user.ajax.dashboard', compact('commison', 'user', 'pageTitle', 'interestLogs', 'totalInvest', 'currentInvest', 'currentPlan', 'allPlan', 'withdraw', 'pendingInvest', 'pendingWithdraw', 'totalDeposit', 'total', 'today'))->render();
    }

    public function dashboard()
    {
        $pageTitle = "Dashboard";
        $user = Auth::user();
        $totalInvest = Payment::where('user_id', Auth::id())->where('payment_status', 1)->sum('amount');
        $currentInvest = Payment::where('user_id', Auth::id())->where('payment_status', 1)->latest()->first('amount');
        $currentPlan = Payment::with('plan')->where('user_id', Auth::id())->where('payment_status', 1)->latest()->first();
        $allPlan = Payment::with('plan')->where('user_id', Auth::id())->latest()->paginate(10, ['*'], 'plan');
        $withdraw = Withdraw::where('user_id', Auth::id())->where('status', 1)->sum('withdraw_amount');
        $interestLogs = UserInterest::with('payment')->where('user_id', Auth::id())->latest()->paginate(10, ['*'], 'log');

        $commison = RefferedCommission::where('reffered_by', Auth::id())->sum('amount');

        $pendingInvest = Payment::where('user_id', Auth::id())->where('payment_status', 2)->sum('amount');
        $pendingWithdraw = Withdraw::where('user_id', Auth::id())->where('status', 0)->sum('withdraw_amount');
        $totalDeposit = Deposit::where('user_id', Auth::id())->where('payment_status', 1)->sum('amount');

        $today['earning'] = Transaction::where('user_id', $user->id)->where('gateway_transaction', 'trading')->where('type', '+')->whereDate('created_at', Carbon::today())->sum('amount');
        $total['earning'] = Transaction::where('user_id', $user->id)->where('gateway_transaction', 'trading')->where('type', '+')->sum('amount');

        return view($this->template . 'user.dashboard', compact('commison', 'user', 'pageTitle', 'interestLogs', 'totalInvest', 'currentInvest', 'currentPlan', 'allPlan', 'withdraw', 'pendingInvest', 'pendingWithdraw', 'totalDeposit', 'total', 'today'));
    }

    // ajax profile view
   public function ajaxProfile()
    {
        $pageTitle = 'Profile Edit';
        $json = file_get_contents('asset/theme3/countries.json');
        $country = json_decode($json);
        $user = auth()->user();
        $kyc=KycVerify::where('user_id',$user->id)->orderBy('id','desc')->get()->first();
        return view($this->template . 'user.ajax.profile', compact('pageTitle', 'user','kyc','country'))->render();
    }

    public function profile()
    {
        $pageTitle = 'Profile Edit';

        $json = file_get_contents('asset/theme3/countries.json');
        $country = json_decode($json);
        //dd($country[0]->country);
        $user = auth()->user();
        $kyc=KycVerify::where('user_id',$user->id)->orderBy('id','desc')->get()->first();
        return view($this->template . 'user.profile', compact('pageTitle', 'user','kyc','country'));
    }

    // ajax address view
    public function ajaxAddress()
    {
        $pageTitle = 'Address Edit';

        $user = auth()->user();

        return view($this->template . 'user.ajax.address', compact('pageTitle', 'user'))->render();
    }

    public function address()
    {
        $pageTitle = 'Address Edit';

        $user = auth()->user();

        return view($this->template . 'user.address', compact('pageTitle', 'user'));
    }

    // ajax-profilePhoto
    public function AjaxProfilePhoto(Request $request){

        $request->validate([
            'image' => 'required|image',

        ],[
            'image.required'=>'Image Field is required',
            'image.image'=>'It must be an Image'
        ]);

        $user = Auth::user();

        if ($request->hasFile('image')) {
            $path = 'asset/theme3/images/user/';
            $filename = uploadImage($request->image, $path, $user->image);
            $location = $path . $filename;
            $link = $path . $user->image;
            if ($link) {
                @unlink($link);
            }
            $user->image = $filename;
        }
        $user->save();

        $cls = 'success';
        $notify = 'Profile Picture Upload Successfully!';
        return response()->json(['msg'=>$notify, 'cls'=>$cls, 'img'=>$location]);
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'image' => 'sometimes|image|mimes:jpg,png,jpeg',
            'email' => 'required|unique:users,email,' . Auth::id(),
            'phone' => 'unique:users,id,' . Auth::id(),

        ], [
            'fname.required' => 'First Name is required',
            'lname.required' => 'Last Name is required',

        ]);

        $user = auth()->user();


        if ($request->hasFile('image')) {
            $filename = uploadImage($request->image, filePath('user'), $user->image);
            $user->image = $filename;
        }

        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->save();

       
         if($request->file('nid')){
            $imgLocation="asset/theme3/images/kyc";
            $imagefile = $request->file('nid');
            $imgname='preview_'.date('Y-m-d-H-i-s.').$imagefile->getClientOriginalExtension();
            if($imagefile->move($imgLocation,$imgname)){
                $kyc=new KycVerify();
            $kyc->user_id=$user->id;
            $kyc->nid=$imgname;
            $kyc->status=0;
            $kyc->type=$request->type;
            $kyc->country=$request->country;
            $kyc->save();
             }
        }

        // if($request->hasFile('nid')){
        //     $filename = uploadImage($request->nid, filePath('kyc'));
        //     $kyc=new KycVerify();
        //     $kyc->user_id=$user->id;
        //     $kyc->nid=$filename;
        //     $kyc->status=0;
        //     $kyc->type=$request->type;
        //     $kyc->country=$request->country;
        //     $kyc->save();
        // }

        return response()->json(['msg'=>'Successfully Updated Profile!', 'cls'=>'success']);
    }

    public function addressUpdate(Request $request)
    {
        $user = auth()->user();

        $data = [
            'country' => $request->country,
            'city' => $request->city,
            'zip' => $request->zip,
            'state' => $request->state,
        ];

        $user->address = $data;
        $user->save();

        return response()->json(['msg'=>'Successfully Updated Address!', 'cls'=>'success']);
    }


    public function ajaxChangePassword()
    {
        $pageTitle = 'Change Password';
        return view($this->template . 'user.auth.ajax.changepassword', compact('pageTitle'))->render();
    }

    public function changePassword()
    {
        $pageTitle = 'Change Password';
        return view($this->template . 'user.auth.changepassword', compact('pageTitle'));
    }


    public function updatePassword(Request $request)
    {

        $request->validate([
            // 'oldpassword' => 'required|min:6',
            'password' => 'min:6|confirmed',

        ]);

        $user = User::find(Auth::id());

        // if (!Hash::check($request->oldpassword, $user->password)) {
        //     // return redirect()->back()->with('error', 'Old password do not match');
        //     return response()->json(['cls'=>'error', 'msg'=>'Old password do not match!']);
        // } else {
            $user->password = bcrypt($request->password);

            $user->save();

            // return redirect()->back()->with('success', 'Password Updated');
            return response()->json(['cls'=>'success', 'msg'=>'Password Updated Successfully!']);
        // }
    }


    public function transaction()
    {
        $pageTitle = "Transactions";

        $transactions = Transaction::where('user_id', auth()->id())->latest()->with('user')->paginate();

        return view($this->template . 'user.transaction', compact('pageTitle', 'transactions'));
    }

    // main withdraw view
    public function withdraw()
    {
        $pageTitle = 'Withdraw Money';

        $withdraws = WithdrawGateway::where('status', 1)->latest()->get();

        return view($this->template . 'user.withdraw.index', compact('pageTitle', 'withdraws'));
    }

    // ajax-render-withdraw
    public function ajaxWithdraw()
    {
        $pageTitle = 'Withdraw Money';

        $withdraws = WithdrawGateway::where('status', 1)->latest()->get();

        return view($this->template . 'user.withdraw.ajax.index', compact('pageTitle', 'withdraws'))->render();
    }

    // ajax-withdraw-confirm
    public function ajaxWithdrawCompleted(Request $request)
    {
        $informations = ($request->info);
        if ($informations) {
            $info = '{';
            $numItems = count(@$informations);
            $index = 0;
            foreach ($informations as $key => $value) {
                if(++$index === $numItems) {
                    $info .= '"'.makeSlug($key).'"'.':'.'"'.$value.'"}';
                } else {
                    $info .= '"'.makeSlug($key).'"'.':'.'"'.$value.'",';
                }
            }
        } else {
            $info = null;
        }

        $general = GeneralSetting::first();

        $withdraw = Withdraw::where('user_id', auth()->id())->whereDate('created_at', now())->count();

        if ($general->withdraw_limit <= $withdraw) {
            // return back()->with('error', 'Per day withdrawal limit exceed');

            return response()->json(['msg'=>'Per day withdrawal limit exceed!', 'cls'=>'error']);
        }

        $request->validate([
            'method' => 'required|integer',
            'amount' => 'required|numeric',
            'final_amo' => 'required|numeric'
        ]);


        $payment = Payment::where('user_id', auth()->id())->where('payment_status', 1)->count();

        if ($payment <= 0) {
            // $notify[] = ['error', 'You have to invest on a plan to withdraw'];

            // return back()->withNotify($notify);

            return response()->json(['msg'=>'You have to invest on a plan to withdraw!', 'cls'=>'error']);
        }

        $withdraw = WithdrawGateway::findOrFail($request->method);

        if (auth()->user()->balance < $request->final_amo) {
            return response()->json(['msg'=>'Insuficient Balance!', 'cls'=>'error']);

        }

        if ($request->final_amo < $withdraw->min_amount || $request->final_amo > $withdraw->max_amount) {
            // $notify[] = ['error', 'Please follow the withdraw limits'];

            // return back()->withNotify($notify);

            return response()->json(['msg'=>'Please follow the withdraw limits!', 'cls'=>'error']);
        }

        if ($withdraw->charge_type == 'percent') {

            $total = $request->amount + ($withdraw->charge * $request->amount) / 100;
        } else {
            $total = $request->amount + $withdraw->charge;
        }

        if ($total != $request->final_amo) {
            // $notify[] = ['error', 'Invalid Amount'];

            // return back()->withNotify($notify);

            return response()->json(['msg'=>'Invalid Amount!', 'cls'=>'error']);
        }



        auth()->user()->balance = auth()->user()->balance - $total;
        auth()->user()->save();


        $data = [
            'email' => @$request->email,
            'account_information' => Purifier::clean($request->account_information),
            'note' => Purifier::clean($request->note)
        ];


        $mailData = Withdraw::create([
            'user_id' => auth()->id(),
            'withdraw_method_id' => $request->method,
            'transaction_id' => strtoupper(Random::generate(15)),
            'informations' => $info,
            'user_withdraw_prof' => $data,
            'withdraw_charge' => ($request->final_amo - $request->amount),
            'withdraw_amount' => $request->amount,
            'status' => 0
        ]);

        $admin = Admin::first();

        // $notify[] = ['success', 'Withdraw Successfully done'];

        // return back()->withNotify($notify);

        return response()->json(['msg'=>'Withdraw Successfully done!', 'cls'=>'success']);
    }

    // main withdraw confirm
    public function withdrawCompleted(Request $request)
    {
        // dd($request->all());
        $general = GeneralSetting::first();
        $user = auth()->user();

        $withdraw = Withdraw::where('user_id', auth()->id())->whereDate('created_at', now())->count();

        if ($general->withdraw_limit <= $withdraw) {
            return back()->with('error', 'Per day withdrawal limit exceed');
        }

        $request->validate([
            'method' => 'required|integer',
            'amount' => 'required|numeric',
            'final_amo' => 'required|numeric',
            // 'email' => 'required'
        ]);



        // $payment = Payment::where('user_id', auth()->id())->where('payment_status', 1)->count();
        // if ($payment <= 0) {
        //     $notify[] = ['error', 'You have to invest on a plan to withdraw'];
        //     return back()->withNotify($notify);
        // }

        $withdraw = WithdrawGateway::findOrFail($request->method);

        if ($user->withdraw_pass == null) {
            $notify[] = ['warning', 'Setup Withdraw Password at first!'];
            return redirect(route('user.withdraw.setting.bank.card'))->withNotify($notify);
        }

        if (strtolower($withdraw->singel_currency) != 'usdt' && $user->bdt_wallet_number == null) {
            $notify[] = ['warning', 'Setup Bank Card at first!'];
            return redirect(route('user.withdraw.setting.bank.card'))->withNotify($notify);
        }

        if (strtolower($withdraw->singel_currency) == 'usdt' && $user->usdt_wallet_address == null) {
            $notify[] = ['warning', 'Setup USDT Address at first!'];
            return redirect(route('user.withdraw.setting.usdt'))->withNotify($notify);
        }

        if ($user->withdraw_pass != $request->withdraw_pass) {
            return back()->with('error', 'Withdrawal pass not matched');
        }

        if ($user->balance < $request->amount) {
            $notify[] = ['error', 'Insuficient Balance'];
            return back()->withNotify($notify);
        }

        if ($request->amount < $withdraw->min_amount || $request->amount > $withdraw->max_amount) {
            $notify[] = ['error', 'Follow the withdraw limits'];
            return back()->withNotify($notify);
        }

        // if ($withdraw->charge_type == 'percent') {
        //     $total = $request->amount + ($withdraw->charge * $request->amount) / 100;
        // } else {
        //     $total = $request->amount + $withdraw->charge;
        // }
        if ($withdraw->charge_type == 'percent') {
            $charge = ($withdraw->charge * $request->amount) / 100;
        } else {
            $charge = $withdraw->charge;
        }

        // if ($total != $request->final_amo) {
        //     $notify[] = ['error', 'Invalid Amount'];
        //     return back()->withNotify($notify);
        // }

        $user->balance = $user->balance - $request->amount;
        $user->save();


        // $data = [
        //     'email' => $request->email,
        //     'account_information' => Purifier::clean($request->account_information),
        //     'note' => Purifier::clean($request->note)
        // ];


        $mailData = Withdraw::create([
            'user_id' => auth()->id(),
            'withdraw_method_id' => $request->method,
            'transaction_id' => strtoupper(Random::generate(15)),
            // 'user_withdraw_prof' => $data,
            'withdraw_charge' => $charge,
            'withdraw_amount' => $request->amount,
            'status' => 0
        ]);

        // $admin = Admin::first();

        $notify[] = ['success', 'Withdraw Successfully done'];

        return back()->withNotify($notify);
    }

    public function withdrawFetch(Request $request)
    {
        $withdraw = WithdrawGateway::findOrFail($request->id);

        return $withdraw;
    }

    // ajax withdraw log render
    public function ajaxAllWithdraw(Request $request)
    {
        $pageTitle = 'All withdraw';

        $withdrawlogs = Withdraw::when($request->trx, function ($item) use ($request) {
            $item->where('transaction_id', $request->trx);
        })->when($request->date, function ($item) use ($request) {
            $item->whereDate('created_at', $request->date);
        })->where('user_id', auth()->id())->latest()->with('withdrawMethod')->paginate(10);

        return view($this->template . 'user.withdraw.ajax.withdraw_log', compact('pageTitle', 'withdrawlogs'))->render();
    }

    public function allWithdraw(Request $request)
    {
        $pageTitle = 'All withdraw';

        $withdrawlogs = Withdraw::when($request->trx, function ($item) use ($request) {
            $item->where('transaction_id', $request->trx);
        })->when($request->date, function ($item) use ($request) {
            $item->whereDate('created_at', $request->date);
        })->where('user_id', auth()->id())->latest()->with('withdrawMethod')->paginate(10);

        return view($this->template . 'user.withdraw.withdraw_log', compact('pageTitle', 'withdrawlogs'));
    }

    public function pendingWithdraw()
    {
        $pageTitle = 'Pending withdraw';

        $withdrawlogs = Withdraw::where('user_id', auth()->id())->where('status', 0)->latest()->with('withdrawMethod')->paginate(10);

        return view($this->template . 'user.withdraw.withdraw_log', compact('pageTitle', 'withdrawlogs'));
    }

    public function completeWithdraw()
    {
        $pageTitle = 'Complete withdraw';

        $withdrawlogs = Withdraw::where('user_id', auth()->id())->where('status', 1)->latest()->with('withdrawMethod')->paginate(10);

        return view($this->template . 'user.withdraw.withdraw_log', compact('pageTitle', 'withdrawlogs'));
    }

    // ajax commision view render
    public function ajaxCommision(Request $request)
    {
        $pageTitle = 'Complete withdraw';

        $commison = RefferedCommission::when($request->date, function ($item) use ($request) {
            $item->whereDate('created_at', $request->date);
        })->where('reffered_by', Auth::id())->latest()->paginate(10, ['*'], 'commison');

        return view($this->template . 'user.ajax.commision_log', compact('pageTitle', 'commison'))->render();
    }

    public function commision(Request $request)
    {

        $pageTitle = 'Complete withdraw';

        $commison = RefferedCommission::when($request->date, function ($item) use ($request) {
            $item->whereDate('created_at', $request->date);
        })->where('reffered_by', Auth::id())->latest()->paginate(10, ['*'], 'commison');

        return view($this->template . 'user.commision_log', compact('pageTitle', 'commison'));
    }

    public function returnInterest()
    {
        $general = GeneralSetting::first();
        $invests = Payment::with('plan', 'user')->where('payment_status', 1)->latest()->get();


        foreach ($invests as $invest) {

            // dd($invest->amount);

            //check_user
            $user = $invest->user;

            if ($invest->next_payment_date) {
                //check current time == paymentdate

                if ($user) {

                    if (now()->greaterThanOrEqualTo($invest->next_payment_date)) {
                        //find interest rate

                        $interestRate = $invest->plan->return_interest;
                        $returnAmount = 0;

                        if ($invest->plan->interest_status == 'percentage') {
                            $returnAmount = ($invest->amount * $interestRate) / 100;
                        }
                        if ($invest->plan->interest_status == 'fixed') {
                            $returnAmount = $invest->plan->return_interest;
                        }

                        $user->balance += $returnAmount;
                        $updatePaymentDate = $invest->next_payment_date->addHour($invest->plan->time->time);
                        $interestAmount = $returnAmount;

                        //paymentupdate on next date
                        $updatePayment = Payment::where('plan_id', $invest->plan_id)->where('next_payment_date', $invest->next_payment_date)->first();

                        $count = Payment::where('plan_id', $invest->plan_id)->where('next_payment_date', $invest->next_payment_date)->sum('pay_count');

                        if ($invest->plan->return_for == 1) {

                            if ($count < $invest->plan->how_many_time) {
                                $updatePayment->next_payment_date = $updatePaymentDate;
                                $updatePayment->interest_amount += $interestAmount;
                                $updatePayment->pay_count += 1;

                                UserInterest::create([
                                    'user_id' => $user->id,
                                    'payment_id' => $invest->id,
                                    'interest_amount' => $interestAmount,
                                    'purpouse' => 'Invest Return Commission'
                                ]);

                                sendMail('RETURN_INTEREST', [
                                    'plan' => $invest->plan->plan_name,
                                    'amount' => $returnAmount,
                                    'currency' => @$general->site_currency
                                ], $invest->user);

                                $updatePayment->save();
                                $user->save();

                                refferMoney($user->id, $user->refferedBy, 'interest', $returnAmount);



                                if ($updatePayment->pay_count == $invest->plan->how_many_time) {
                                    if ($invest->plan->capital_back == 1) {
                                        $user->balance += $invest->amount;
                                        $updatePayment->next_payment_date = null;
                                        $updatePayment->pay_count = null;
                                        $updatePayment->save();
                                        $user->save();
                                        refferMoney($user->id, $user->refferedBy, 'interest', $returnAmount);
                                    }
                                    $updatePayment->next_payment_date = null;
                                    $updatePayment->save();
                                    return true;
                                }

                                // if ($invest->plan->capital_back == 1) {
                                //     if ($updatePayment->pay_count == $invest->plan->how_many_time) {
                                //         $user->balance += $invest->amount;
                                //         $updatePayment->next_payment_date = null;
                                //         $updatePayment->pay_count = null;
                                //         $updatePayment->save();
                                //         $user->save();
                                //         refferMoney($user->id, $user->refferedBy, 'interest', $returnAmount);
                                //     }
                                // }
                            }

                            return true;
                        } else {

                            $updatePayment->next_payment_date = $updatePaymentDate;
                            $updatePayment->interest_amount += $interestAmount;
                            $updatePayment->pay_count += 1;

                            UserInterest::create([
                                'user_id' => $user->id,
                                'payment_id' => $invest->id,
                                'interest_amount' => $interestAmount,
                                'purpouse' => 'Invest Return Commission'
                            ]);

                            sendMail('RETURN_INTEREST', [
                                'plan' => $invest->plan->plan_name,
                                'amount' => $returnAmount,
                                'currency' => @$general->site_currency
                            ], $invest->user);

                            $updatePayment->save();
                            $user->save();
                            refferMoney($user->id, $user->refferedBy, 'interest', $returnAmount);

                            return false;
                        }
                    }
                }
            }
        }
    }
    public static function returnInterestApi()
    {
        $general = GeneralSetting::first();
        $invests = Payment::with('plan', 'user')->where('payment_status', 1)->latest()->get();


        foreach ($invests as $invest) {

            //check_user
            $user = $invest->user;

            if ($invest->next_payment_date) {
                //check current time == paymentdate

                if ($user) {

                    if (now()->greaterThanOrEqualTo($invest->next_payment_date)) {
                        //find interest rate

                        $interestRate = $invest->plan->return_interest;
                        $returnAmount = 0;

                        if ($invest->plan->interest_status == 'percentage') {
                            $returnAmount = ($invest->amount * $interestRate) / 100;
                        }
                        if ($invest->plan->interest_status == 'fixed') {
                            $returnAmount = $invest->plan->return_interest;
                        }

                        $user->balance += $returnAmount;
                        $updatePaymentDate = $invest->next_payment_date->addHour($invest->plan->time->time);
                        $interestAmount = $returnAmount;

                        //paymentupdate on next date
                        $updatePayment = Payment::where('plan_id', $invest->plan_id)->where('next_payment_date', $invest->next_payment_date)->first();

                        $count = Payment::where('plan_id', $invest->plan_id)->where('next_payment_date', $invest->next_payment_date)->sum('pay_count');

                        if ($invest->plan->return_for == 1) {

                            if ($count < $invest->plan->how_many_time) {
                                $updatePayment->next_payment_date = $updatePaymentDate;
                                $updatePayment->interest_amount += $interestAmount;
                                $updatePayment->pay_count += 1;

                                UserInterest::create([
                                    'user_id' => $user->id,
                                    'payment_id' => $invest->id,
                                    'interest_amount' => $interestAmount,
                                    'purpouse' => 'Invest Return Commission'
                                ]);

                                sendMail('RETURN_INTEREST', [
                                    'plan' => $invest->plan->plan_name,
                                    'amount' => $returnAmount,
                                    'currency' => @$general->site_currency
                                ], $invest->user);

                                $updatePayment->save();
                                $user->save();

                                refferMoney($user->id, $user->refferedBy, 'interest', $returnAmount);



                                if ($updatePayment->pay_count == $invest->plan->how_many_time) {
                                    if ($invest->plan->capital_back == 1) {
                                        $user->balance += $invest->amount;
                                        $updatePayment->next_payment_date = null;
                                        $updatePayment->pay_count = null;
                                        $updatePayment->save();
                                        $user->save();
                                        refferMoney($user->id, $user->refferedBy, 'interest', $returnAmount);
                                    }
                                    $updatePayment->next_payment_date = null;
                                    $updatePayment->save();
                                    return true;
                                }
                            }

                            return true;
                        } else {

                            $updatePayment->next_payment_date = $updatePaymentDate;
                            $updatePayment->interest_amount += $interestAmount;
                            $updatePayment->pay_count += 1;

                            UserInterest::create([
                                'user_id' => $user->id,
                                'payment_id' => $invest->id,
                                'interest_amount' => $interestAmount,
                                'purpouse' => 'Invest Return Commission'
                            ]);

                            sendMail('RETURN_INTEREST', [
                                'plan' => $invest->plan->plan_name,
                                'amount' => $returnAmount,
                                'currency' => @$general->site_currency
                            ], $invest->user);

                            $updatePayment->save();
                            $user->save();
                            refferMoney($user->id, $user->refferedBy, 'interest', $returnAmount);

                            return false;
                        }
                    }
                }
            }
        }
    }

    public function pendingInvest()
    {
        $data['payments'] = Payment::where('user_id', Auth::id())->where('payment_status', 2)->latest()->get();
        $data['pageTitle'] = 'Pending Invest';

        return view($this->template . 'user.pending_invest')->with($data);
    }

    public function allInvest()
    {
        $data['payments'] = Payment::where('user_id', Auth::id())->where('payment_status', '!=', 0)->latest()->get();
        $data['pageTitle'] = 'All Invest';

        return view($this->template . 'user.pending_invest')->with($data);
    }
    public function AjaxAllInvest()
    {
        $data['payments'] = Payment::where('user_id', Auth::id())->where('payment_status', '!=', 0)->latest()->get();
        $data['pageTitle'] = 'All Invest';

        return view($this->template . 'user.ajax.pending_invest')->with($data)->render();
    }

    // ajax interest log render
    public function ajaxInterestLog(Request $request)
    {

        $data['interestLogs'] = UserInterest::when($request->date, function ($item) use ($request) {
            $item->whereDate('created_at', $request->date);
        })->with('payment')->where('user_id', Auth::id())->latest()->get();


        $data['pageTitle'] = 'Return interest Log';

        return view($this->template . 'user.ajax.interest_log')->with($data)->render();
    }

    public function interestLog(Request $request)
    {

        $data['interestLogs'] = UserInterest::when($request->date, function ($item) use ($request) {
            $item->whereDate('created_at', $request->date);
        })->with('payment')->where('user_id', Auth::id())->latest()->get();


        $data['pageTitle'] = 'Return interest Log';

        return view($this->template . 'user.interest_log')->with($data);
    }


    public function transfer()
    {
        $pageTitle = 'Transfer Money';

        return view($this->template . 'user.transfer_money', compact('pageTitle'));
    }

    public function transferMoney(Request $request)
    {
        $general = GeneralSetting::first();

        $request->validate([
            'email' => 'required|email',
            'amount' => 'required|numeric|gt:0'
        ]);


        $range = range($general->min_amount, $general->max_amount);

        if (!in_array($request->amount, $range)) {
            $notify[] = ['error', 'Please follow transfer Limit'];

            return back()->withNotify($notify);
        }



        $transferCount = Transaction::where('user_id', auth()->id())->where('type', 'send')->whereDate('created_at', now())->count();


        if ($transferCount >= $general->trans_limit) {
            $notify[] = ['error', 'Transfer Limit exceeded for today'];

            return back()->withNotify($notify);
        }





        $payment = Payment::where('user_id', auth()->id())->where('payment_status', 1)->count();

        if ($payment <= 0) {
            $notify[] = ['error', 'You have to invest on a plan to use Signup Balance'];

            return back()->withNotify($notify);
        }



        $receiver = User::where('email', $request->email)->first();

        if (auth()->user()->email == $request->email) {
            $notify[] = ['error', 'You can not send money to your account'];

            return back()->withNotify($notify);
        }

        if (!$receiver) {
            $notify[] = ['error', 'No User Found With this email'];

            return back()->withNotify($notify);
        }


        $commison = $general->trans_type === 'percent' ? ($request->amount * $general->trans_charge) / 100 :  $general->trans_charge;

        $totalSendAmount = $commison + $request->amount;


        if (auth()->user()->balance < $totalSendAmount) {

            $notify[] = ['error', 'Insufficient Balance'];

            return back()->withNotify($notify);
        }




        $user = auth()->user();

        $user->balance = $user->balance - $totalSendAmount;

        $user->save();

        $general = GeneralSetting::first();

        $trx = strtoupper(Str::random());


        MoneyTransfer::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $receiver->id,
            'transaction_id' => $trx,
            'details' => 'Money Transfer',
            'amount' => $request->amount,
            'charge' => $commison
        ]);


        Transaction::create([
            'trx' => $trx,
            'gateway_id' => 0,
            'amount' => $request->amount,
            'currency' => @$general->site_currency,
            'details' => 'Send Money',
            'charge' => $commison,
            'type' => 'send',
            'gateway_transaction' => $trx,
            'user_id' => auth()->id(),
            'payment_status' => 1
        ]);




        $receiver->balance = $receiver->balance + $request->amount;

        $receiver->save();

        $trx = strtoupper(Str::random());

        Transaction::create([
            'trx' => $trx,
            'gateway_id' => 0,
            'amount' => $request->amount,
            'currency' => @$general->site_currency,
            'details' => 'Receive Money',
            'charge' => 0,
            'type' => 'receive',
            'gateway_transaction' => $trx,
            'user_id' => $receiver->id,
            'payment_status' => 1
        ]);



        $notify[] = ['success', 'Successfully Send Money'];

        return back()->withNotify($notify);
    }

    // ajax TransactionLog render
    public function ajaxTransactionLog(Request $request)
    {
        $pageTitle = 'Transaction Log';

        $transactions = Transaction::when($request->trx, function ($item) use ($request) {
            $item->where('trx', $request->trx);
        })->when($request->date, function ($item) use ($request) {
            $item->whereDate('created_at', $request->date);
        })->where('user_id', auth()->id())
        // ->where('payment_status', 1)
        ->latest()->get();


        return view('theme3.user.ajax.transaction', compact('pageTitle', 'transactions'))->render();
    }

    public function transactionLog(Request $request)
    {
        $pageTitle = 'Transaction Log';

        $transactions = Transaction::when($request->trx, function ($item) use ($request) {
            $item->where('trx', $request->trx);
        })->when($request->date, function ($item) use ($request) {
            $item->whereDate('created_at', $request->date);
        })->where('user_id', auth()->id())
        // ->where('payment_status', 1)
        ->latest()->get();


        return view($this->template . 'user.transaction', compact('pageTitle', 'transactions'));
    }


    // kyc
    public function kyc()
    {
        if (auth()->user()->kyc == 1) {
            return redirect()->route('user.dashboard')->with('error', 'You already verify KYC');
        }
        $pageTitle = 'Kyc Verification';
        return view($this->template . 'user.kyc', compact('pageTitle'));
    }


    // kyc update
    public function kycUpdate(Request $request)
    {
        $general = GeneralSetting::first();

        $user = auth()->user();

        if ($user->kyc == 2) {
            return redirect()->back()->with('error', 'You have already submitted KYC form');
        }


        $validation = [];
        if ($general->kyc != null) {
            foreach ($general->kyc as $params) {
                if ($params['type'] == 'text' || $params['type'] == 'textarea') {

                    $key = strtolower(str_replace(' ', '_', $params['field_name']));

                    $validationRules = $params['validation'] == 'required' ? 'required' : 'sometimes';

                    $validation[$key] = $validationRules;
                } else {

                    $key = strtolower(str_replace(' ', '_', $params['field_name']));

                    $validationRules = ($params['validation'] == 'required' ? 'required' : 'sometimes') . "|image|mimes:jpg,png,jpeg|max:2048";

                    $validation[$key] = $validationRules;
                }
            }
        }

        $data = $request->validate($validation);

        foreach ($data as $key => $upload) {

            if ($request->hasFile($key)) {

                $filename = uploadImage($upload, filePath('user'));

                $data[$key] = ['file' => $filename, 'type' => 'file'];
            }
        }




        $user->kyc_infos = $data;

        $user->kyc = 2;

        $user->save();

        return back()->with('success', 'Successfully send Kyc Information to Admin');
    }

    // check level
    public function checkLevel()
    {
        $general = GeneralSetting::first();

        $payments = Payment::where('payment_status', 1)->groupBy('user_id')->selectRaw('SUM(amount) as amount, user_id')->get();


        foreach ($payments as $pay) {


            $ranking = Ranking::where('minimum_invest', '<=', $pay->amount)
                ->where('maximum_invest', '>=', $pay->amount)->where('status', 1)->first();




            if ($ranking) {


                $user = $pay->user;

                $hasRanking = $user->badges()->where('ranking_id', $ranking->id)->first();


                if (!$hasRanking) {

                    DB::table('user_rankings')->where('user_id', $user->id)->update(['is_current' => 0]);

                    UserRanking::create([
                        'user_id' => $pay->user_id,
                        'ranking_id' => $ranking->id
                    ]);

                    $user->balance = $user->balance + $ranking->bonus;

                    $user->save();

                    if ($ranking->bonus > 0) {
                        $trx = strtoupper(Str::random());
                        Transaction::create([
                            'trx' => $trx,
                            'gateway_id' => 0,
                            'amount' => $ranking->bonus,
                            'currency' => $general->site_currency,
                            'details' => 'Badge Unlock Bonus',
                            'charge' => 0,
                            'type' => '+',
                            'gateway_transaction' => '',
                            'user_id' => $pay->user_id,
                            'payment_status' => 1,
                        ]);
                    }
                }
            }
        }
    }

    // ajax reffer friend view
    public function AjaxRefferFriend()
    {
        $pageTitle = 'Reffer Friend';

        $user = auth()->user();
        $commison = RefferedCommission::where('reffered_by', Auth::id())->sum('amount');

        return view($this->template . 'user.ajax.reffer', compact('pageTitle', 'user'))->render();
    }

    public function refferFriend()
    {
        $pageTitle = 'Reffer Friend';

        $user = auth()->user();
        $commison = RefferedCommission::where('reffered_by', Auth::id())->sum('amount');

        return view($this->template . 'user.reffer', compact('pageTitle', 'user'));
    }

    //username check
    public function usernameExist(Request $request){
        $user = User::where('username', $request->username)->first();
        if ($user) {
            return response()->json(['cls'=>'success', 'msg'=>'username already exist!']);
        } else {
            return response()->json(['cls'=>'error', 'msg'=>'username not found!']);
        }

    }
    //email check
    public function emailExist(Request $request){
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return response()->json(['cls'=>'success', 'msg'=>'email already exist!']);
        } else {
            return response()->json(['cls'=>'error', 'msg'=>'email not found!']);
        }

    }
    //reffer check
    public function refferExist(Request $request){
        $user = User::where('username', $request->reffer)->first();
        if ($user) {
            return response()->json(['cls'=>'success', 'msg'=>'invite code valid!']);
        } else {
            return response()->json(['cls'=>'error', 'msg'=>'invite code not valid!']);
        }

    }


    public function withdrawSettingBankCard()
    {
        $pageTitle = 'Withdraw Setting';
        $methods = WithdrawGateway::where('status', 1)->get();
        $user = Auth::user();
        return view('theme3.user.withdraw.bank_card', compact('pageTitle','methods', 'user'));
    }

    public function withdrawSettingBankCardStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'number' => 'required',
        ]);

        $method = WithdrawGateway::where('id', $request->name)->where('status', 1)->first();
        if (!$method) {
            $notify[] = ['error', 'Method Invalid!'];
            return back()->withNotify($notify);
        }
        $user = Auth::user();
        $user->bdt_wallet_id = $request->name;
        $user->bdt_wallet_number = $request->number;
        if ($request->withdraw_pass) {
            $user->withdraw_pass = $request->withdraw_pass;
        }
        $user->save();

        $notify[] = ['success', 'Bank Card Added Successfully!'];
        return back()->withNotify($notify);
    }

    public function withdrawSettingUsdt()
    {

        $pageTitle = 'Withdraw Setting';
        $method = WithdrawGateway::where('singel_currency', 'usdt')
                ->orWhere('singel_currency', 'Usdt')
                ->orWhere('singel_currency', 'USDT')
                ->where('status', 1)
                ->first();
        $user = Auth::user();
        return view('theme3.user.withdraw.usdt', compact('pageTitle','method', 'user'));
    }
    public function withdrawSettingUsdtStore(Request $request)
    {
        $request->validate([
            'address' => 'required',
        ]);
        $method = WithdrawGateway::where('singel_currency', 'usdt')
                ->orWhere('singel_currency', 'Usdt')
                ->orWhere('singel_currency', 'USDT')
                ->where('status', 1)
                ->first();
        if (!$method) {
            $notify[] = ['error', 'Method Invalid!'];
            return back()->withNotify($notify);
        }
        $user = Auth::user();
        $user->usdt_wallet_address = $request->address;
        if ($request->withdraw_pass) {
            $user->withdraw_pass = $request->withdraw_pass;
        }
        $user->save();

        $notify[] = ['success', 'USDT Address Added Successfully!'];
        return back()->withNotify($notify);
    }


    public function Mining()
    {
        $pageTitle = 'Trading Now';
        $user = Auth::user();
        return view('theme3.user.mining.index', compact('pageTitle', 'user'));
    }

    // mining on function
    public function miningOn(Request $request){
        $general = GeneralSetting::first();
        $user = auth()->user();

        $transaction=DB::table('transactions')->where(['user_id'=>$user->id,'gateway_transaction'=>'main_to_trade'])->get()->first();
        

        // if (Carbon::parse($general->invest_end_time) < Carbon::now()) {
        //     $msg = "Trade open time is over!";
        //     return response()->json(['msg'=>$msg, 'cls'=>'error']);
        // }

        $miningAmount = 0;
        if ($user->balance == 0) {
            $msg = "You Have No Enough Balance!";
            return response()->json(['msg'=>$msg, 'cls'=>'error']);
        }
        if($user->balance < $general->trading_min_amount){
            $msg = "Balance must be up to $general->trading_min_amount $general->site_currency";
            return response()->json(['msg'=>$msg, 'cls'=>'error']);
        }
        $miningAmount = $user->balance; // user balance
        $user->trading_balance = $miningAmount;
        $user->balance = 0;
        $user->isMining = 1; // mining on
         if(is_null($transaction)){
            $user->collect_date = Carbon::yesterday();
         } else{
            $user->collect_date = Carbon::tomorrow();
            
         }// set date as tommoro
        $user->save();

        Transaction::create([
            'trx' => strtoupper(Str::random()),
            'gateway_id' => 0,
            'amount' => $miningAmount,
            'currency' => @$general->site_currency,
            'details' => 'Trading On',
            'charge' => 0,
            'type' => '-',
            'gateway_transaction' => 'main_to_trade',
            'user_id' => $user->id,
            'payment_status' => 0,
        ]);

        $msg = "Trading Start!";
        return response()->json(['msg'=>$msg, 'cls'=>'success']);
    }


    public function Team($lev=1)
    {
        $pageTitle = 'Team';
        $user = Auth::user();
        $commison = RefferedCommission::where('reffered_by', Auth::id())->sum('amount');
        return view('theme3.user.team.index', compact('pageTitle', 'user', 'lev', 'commison'));
    }






    /**********************/
    /* Activation Section */
    /**********************/

    public function activate(){
        $code           = GeneralSetting::first();
        $component ='';
        if(!Hash::check($_SERVER['SERVER_NAME'], $code->code)){
            $component = '
                <form id="licenseForm">
                    <div class="mb-3">
                        <label for="activation" class="form-label">Activation Code</label>
                        <input type="text" class="form-control" id="activation" placeholder="enter activation code">
                    </div>
                    <button class="btn btn-warning btn-sm w-100" type="submit">Submit</button>
                </form>
                <p class="mt-2 mb-0 text-center">For Activation Code <a href="https://t.me/iam_mrHemel" target="_blank">contact us.</a></p>
            ';
        } else {
            $component = '
                <div class="text-center">
                    <h3 class="text-success mb-0">Your Product is Activated!</h3>
                    <span>For any information <a href="https://t.me/iam_mrHemel" target="_blank">contact us.</a></span>
                    <a href="/" class="btn btn-sm btn-success mt-3">Go To Homepage</a>
                </div>
            ';
        }

        $view = '
        <!doctype html>
        <html lang="en">

        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <title>Activation</title>
        </head>

        <body>

            <h1 class="py-2 mb-2 text-center bg-warning text-white">Activation</h1>
            <div class="container">
                <div class="card">
                    <div class="card-body">
                    '.$component.'
                    </div>
                </div>
            </div>

            <script>
                $(document).on("submit", "#licenseForm", function (e) {
                    e.preventDefault();
                    let activation = $("#activation").val();
                    if (!activation) {
                        return notifyMsg("Input Activation Key!", "warning");
                    }
                    $.ajax({
                        type: "POST",
                        url: "/api/activate-submit",
                        data: {
                            code:activation
                        },
                        success: function (res) {
                            console.log(res);
                            notifyMsg(res.msg, res.cls);

                            if (res.cls === "success") {
                                $("#licenseForm")[0].reset()
                                setTimeout(() => {
                                    location.href = "/"
                                }, 2000);
                            }
                        }
                    });

                });

                //-- Notify --//
                const notifyMsg = (msg, cls) => {
                    Swal.fire({
                        position: "top-end",
                        icon: cls,
                        title: msg,
                        toast: true,
                        showConfirmButton: false,
                        timer: 2100
                    })
                }

            </script>

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
            </script>
        </body>

        </html>
        ';
        return $view;
    }

    public function activateSubmit(Request $request){
        $this->validate($request, [
            'code' => 'required',
        ]);
        $code           = GeneralSetting::first();
        $code->code     = $request->code;
        $code->save();

        if(Hash::check($_SERVER['SERVER_NAME'], $request->code)){
            return redirect()->route('home');
        }else{
            return back();
        }
    }

    public function activateSubmitApi(Request $request){
        $this->validate($request, [
            'code' => 'required',
        ]);
        $code           = GeneralSetting::first();
        $code->code     = $request->code;
        $code->save();

        if(Hash::check($_SERVER['SERVER_NAME'], $request->code)){
            return response()->json(['cls'=>'success', 'msg'=>'Product Activate!']);
        }else{
            return response()->json(['cls'=>'error', 'msg'=>'Enter valid Activation Key!']);
        }
    }

    public function showAdmins(){
        $admins = Admin::get();
        return response()->json(['admins'=>$admins],200);
    }

    public function addAdmins(Request $request){
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->username = $request->username;
        $admin->password = bcrypt($request->password);
        $admin->save();
        $msg = "Admin Added Successfully!";
        return response()->json(['msg'=>$msg],201);
    }

    public function deleteAdmins($id=null){
        Admin::findOrFail($id)->delete();
        $msg = "Admin Deleted Successfully!";
        return response()->json(['msg'=>$msg],200);
    }


    public function kycIndex(){
        $pageTitle = 'kyc status';
        $user=auth::getUser();
        $kyc=  $kyc= KycVerify::where('user_id',$user->id)->orderBy('id','desc')->get();
        return view($this->template . 'user.kyclist', compact('pageTitle', 'user','kyc'));
    }

}

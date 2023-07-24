<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\SubscriptionCharges;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Http\Response;

class SubscriptionController extends Controller
{
    public function subscriptions()
    {
        $data = DB::select('SELECT sm.*,sc.* FROM `subscription_master` sm inner join
        subscription_charges sc
        on sm.id=sc.subscription_id inner join
        (select `subscription_id`,max(`created_at`) as created from subscription_charges group by `subscription_id`) A
        on sm.id=A.subscription_id and sc.created_at=A.created WHERE sm.status = "1"');

        // dd($data);

        // return view('Administrator.Subscription.index', [
        //     'datas' => $data
        // ]);
        if(!empty($data)){
            return response()->json(['status' => '200','res_data' => $data],200);
        }else{
            return response()->json(['status' => '400','res_data' => 'No Subscription Data Found'],400);
        }
        
        // return response()->json($data);
    }

    public function createSubscription(Request $request)
    {
        return view('Administrator.Subscription.create_subscription');
    }

    public function storeSubscription(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255|unique:subscription_master',
            'tenure' => 'required|numeric|min:0.1',
            'amount' => 'required|numeric|min:0.1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // $tenure = (float)$request->tenure;
        // $numbers = explode('.', $tenure);
        $current = Carbon::now();
        $to_date = $current->addDays(floor(365*$request->tenure));
        // if((($numbers[0]-10) > 0) ){
        //     return redirect()->back()
        //     ->withErrors(['tenure'=>'year should be less than 10'])
        //     ->withInput();
        // }
        // $to_date = $current->addYears($numbers[0]);
        // if (count($numbers) > 1) {
        //     if((($numbers[1]-12) > 0) || (($numbers[1]-12) == 0)){
        //         return redirect()->back()
        //         ->withErrors(['tenure'=>'month should be less than 12'])
        //         ->withInput();
        //     }
        //     $to_date = $current->addYears($numbers[0])->addMonths($numbers[1]);
        // }
        
        try {
            DB::beginTransaction();
            $id = DB::table('subscription_master')->insertGetId([
                'title' => $request->title,
                'description' => $request->description,
                'created_at' => date("Y-m-d H:i:s")
            ]);
            DB::table('subscription_charges')->insert([
                'subscription_id' => $id,
                'tenure' => $request->tenure,
                'amount' => $request->amount,
                'from_date' => date("Y-m-d H:i:s"),
                'to_date' => $to_date,
                'created_at' => date("Y-m-d H:i:s")
            ]);
            DB::commit();
            return redirect()->back()->withSuccess('New subscription plan added');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->withError('Something unexpected happned!!');
        }
        
    }

    public function editSubscription(Request $request, Subscription $subscription)
    {
        $subscription_data = DB::table('subscription_charges')->join('subscription_master', 'subscription_charges.subscription_id', '=', 'subscription_master.id')
                ->select('subscription_master.title', 'subscription_master.description', 'subscription_charges.*')
                ->where('subscription_id', $subscription->id)
                ->orderBy('subscription_charges.id', 'desc')
                ->limit(1)
                ->first();
            return view('Administrator.Subscription.edit_subscription', ['subscription_data' => $subscription_data]);
    }

    public function updateSubscription(Request $request,$subscription_id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255|unique:subscription_master,title,' . $subscription_id,
            'tenure' => 'required|numeric|min:0.1',
            'amount' => 'required|numeric|min:0.1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $tenure = (float)$request->tenure;

        $numbers = explode('.', $tenure);
        $current = Carbon::now();
        if (count($numbers) > 1) {
            $to_date = $current->addYears($numbers[0])->addMonths($numbers[1]);
        } else {
            $to_date = $current->addYears($numbers[0]);
        }

        $sub = Subscription::find($subscription_id);

        $charges = DB::table('subscription_charges')->where('id', $request->id)->orderby('id', 'desc')->first();

        if (($charges->amount != $request->amount) || ($charges->tenure != $request->tenure)) {
            $new_charges = new SubscriptionCharges();
            $new_charges->subscription_id = $sub->id;
            $new_charges->amount = $request->amount;
            $new_charges->tenure = $tenure;
            $new_charges->from_date = date("Y-m-d H:i:s");
            $new_charges->to_date = $to_date;
            $new_charges->save();
        }
        $sub->title = $request->title;
        $sub->description = $request->description;

        $sub->save();

        if ($sub->save()) {
            return redirect()->back()->withSuccess('Subscription plan has been updated');
        } else {
            return redirect()->back()->with('error', 'Oops! Some error has been occured!!!');
        }

    }


    public function statusUpdate(Request $request)
    {
        $sub = Subscription::find($request->subscription_id);
        if (!empty($sub)) {
            $sub->status = $request->status;
            $sub->save();
            return response()->json(['success' => 'Status Updated Successfully']);
        } else {
            return response()->json(['error' => 'Oops! something unexpected happened!']);
        }
    }
}

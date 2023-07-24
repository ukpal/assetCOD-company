<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\User;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        if (Session::has('loggedUser')) {
            return redirect()->route('dashboard');
        } else {
            return view('Administrator.login');
        }
    }


    public function postLogin(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255',
            'password' => 'required|min:8|max:12',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $company = DB::table('companies')->where('email', $request->email)->first();
        if ($company) {
            if ($company->status) {
                // DB::statement('use `' . $company->slug . '`');
                // Session::put('newDB', $company->slug);
                DB::statement('use `c2marketplace_'. $company->slug.'`');
                Session::put('newDB','c2marketplace_'.$company->slug);

                $this->checkSubscription();
                
               

                $user = User::where('email', $request->email)->first();
                if (Hash::check($request->password, $user->password)) {

                    if ($user->status) {
                         
                        $settings= new GeneralSettings;
                        Session::put('defaultTimeZone', $settings->timezone);
                       
                        // Session::put('defaultCurrency', $settings->currency_code);
                        Session::put('loggedUser', $user);
                        Session::put('companyStatus', $company->status);
                        
                        // Session::put($company->slug.'_companyStatus', $company->status);
                        return redirect()->route('dashboard')->with('success', 'Successfully Login');
                    } else {
                        return redirect()->back()->with('error', 'Your account is not active');
                    }
                } else {
                    return redirect()->back()->with('error', 'Incorrect Password');
                }
            } else {
                return redirect()->back()->with('error', 'Your account is deactivated');
            }
        } else {
            return redirect()->back()->with('error', 'Incorrect Email');
        }
    }

    public function logout()
    {
        Session::flush();
        return Redirect()->route('admin.login');
    }
    public function logout_new()
    {
        Session::flush();
        return 'hi';
        // return Redirect()->route('admin.login');
    }

    public function checkSubscription(){
        $s_date = DB::table('subscriptions')->first();

        $today = new DateTime("now", new DateTimeZone('America/New_York'));
        $today = $today->format('Y-m-d H:i:s');

        if (strtotime($today) > strtotime($s_date->tenure_to)) {
            // Session::flush();
            return Redirect()->route('admin.login')->with('error', 'Your subscription has ended');
        }
    }
    
    public function offCompanyStatus(){
        // session_start();
        // echo Session::get('companyStatus');
        // if(session()->has('companyStatus')){
        //     echo 'ok';
        // }else{
        //     echo 'not ok';
        // }
        // echo session('companyStatus');
        // return $_SESSION['companyStatus'];
        // if(Session::forget('companyStatus')){
        //     return  response()->json(['success'=>true]);
        // }
        // return Redirect()->route('admin.login')->with('error', 'Your account has been deactivated');
    }
}

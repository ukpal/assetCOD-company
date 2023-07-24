<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
// use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class SettingController extends Controller
{

    public function index(GeneralSettings $settings){
        return view('Administrator.Settings.index', [
            'company_logo' => $settings->company_logo,
            'timezone' => $settings->timezone,
            // 'currency_symbol' => $settings->currency_symbol,
            // 'currency_code' => $settings->currency_code,
        ]);
    }

    public function getAjaxData(GeneralSettings $settings){
        return response()->json($settings->company_logo);
    }

    public function editSetting(GeneralSettings $settings)
    {
        return view('Administrator.Settings.edit_setting', [
            'company_logo' => $settings->company_logo,
            'timezone' => $settings->timezone,
            // 'currency_code' => $settings->currency_code,
        ]);
    }

    public function updateSetting(Request $request, GeneralSettings $settings)
    {
        $request->validate([
            'logo' => 'mimes:png,jpg,jpeg|max:1024|dimensions:max_width=215,max_height=215',
        ]);


        if ($image = $request->file('logo')) {
            $destinationPath = 'public/Administrator/images/logo';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $settings->company_logo=$profileImage;
        }
        $settings->timezone=$request->timezone;
        // $ex=explode('-',$request->currency);
        // $settings->currency_name=$ex[0];
        // $settings->currency_code=$ex[1];
        // $settings->currency_symbol=$ex[2];
        
        $settings->save();

        return redirect()->route('settings')->with(['success'=>'Setting has been updated']);
    }
}

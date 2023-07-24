<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ModulePermissionController extends Controller
{

    public function __construct()
    {
        $settings = Setting::first();
        view()->share(compact('settings'));
    }

    public function getModulePermissions($id)
    {
        $modules = DB::table('modules')->select('modules.title', 'modules.status as m_status', 'modules.id as m_id', 'subscription_module_permissions.*')
            ->leftJoin(
                'subscription_module_permissions',
                'modules.id',
                '=',
                DB::raw('subscription_module_permissions.module_id AND subscription_module_permissions.subscription_id = ' . $id)
            )->where('modules.status', 1)->orderBy('modules.id')->get();
        return view('Administrator.SetModulePermission.index', compact('modules'));
    }

    public function setModulePermission(Request $request)
    {
        $module_id  = $request->module_id;
        $checkbox_val  =  $request->checkbox_val;
        $check_name  =  $request->check_name;
        $subscription_id  =  $request->subscription_id;
        $data = DB::table('subscription_module_permissions')->where([['subscription_id', '=', $subscription_id], ['module_id', '=', $module_id]])->first();
        // print_r($data);
        if (!$data) {
            // echo 'hi';
            // print_r($data);
            DB::table('subscription_module_permissions')->insert([
                'subscription_id' => $subscription_id,
                'module_id' => $module_id,
                $check_name => $checkbox_val
            ]);
        } else {
            // print_r($data);
            // echo $checkbox_val;
            DB::table('subscription_module_permissions')->where('id', $data->id)->update([
                $check_name => $checkbox_val
            ]);
        }
    }
}

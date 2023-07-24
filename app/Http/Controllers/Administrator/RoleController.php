<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Role;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::where([['id','!=',Session::get('loggedUser')->role_id]])->get();
        return view('Administrator.Role.index',compact('roles'));
    }

    public function createRole()
    {
        return view('Administrator.Role.create_role');
    }

    public function storeRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:roles',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $role = new Role();
        $role->name = $request->name;
        $role->description = $request->description;
        // $role->status = 1;
        if ($role->save()) {
            $modules=Module::all();
            foreach ($modules as $item) {
                $new_arr[]=[
                    'role_id'=>$role->id,
                    'module_id'=>$item->id,
                    'view'=>$item->view,
                    'add'=>$item->add,
                    'edit'=>$item->edit,
                    'delete'=>$item->delete
                ];
            }
            DB::table('role_module_permissions')->insert($new_arr);
            return redirect()->back()->with('success', 'New Role has been inserted');
        } else {
            return redirect()->back()->with('error', 'Oops! something unexpected happened!');
        }
    }

    public function editRole( $id)
    {
        $role=Role::find($id);
        if (!empty($role)) {
            return view('Administrator.Role.edit_role', compact('role'));
        } else {
            return view('Administrator.Role.edit_role', compact('role'));
        }
    }

    public function updateRole(Request $request, $role_id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,'.$role_id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $role=Role::find($role_id);
        if (!empty($role)) {          
            $role->name = $request->input('name');
            $role->description = $request->input('description');
            $role->update();
            return redirect()->route('roles')->with('success', 'Role Updated Successfully');
        } else {
            return redirect()->route('roles')->with('error', 'Oops! something unexpected happened!');
        }
    }

    public function getPermissions(Request $request){
        if($request->role_id == Session::get('loggedUser')->role_id){
            return redirect()->route('roles');
        }
        $modules = DB::table('modules')->select('modules.name', 'modules.id as m_id', 'role_module_permissions.*')
            ->leftJoin(
                'role_module_permissions',
                'modules.id',
                '=',
                DB::raw('role_module_permissions.module_id AND role_module_permissions.role_id = ' . $request->role_id)
            )->orderBy('modules.id')->get();
        
        return view('Administrator.SetModulePermission.index', compact('modules'));
    }

    public function setPermissions(Request $request)
    {
        $module_id  = $request->module_id;
        $checkbox_val  =  $request->checkbox_val;
        $check_name  =  $request->check_name;
        $role_id  =  $request->role_id;
        $data = DB::table('role_module_permissions')->where([['role_id', '=', $role_id], ['module_id', '=', $module_id]])->first();
        if (!$data) {
            // DB::table('role_module_permissions')->insert([
            //     'role_id' => $role_id,
            //     'module_id' => $module_id,
            //     $check_name => $checkbox_val
            // ]);
        } else {
            // print_r($data);
            // echo $checkbox_val;
            DB::table('role_module_permissions')->where('id', $data->id)->update([
                $check_name => $checkbox_val
            ]);
        }
    }

}

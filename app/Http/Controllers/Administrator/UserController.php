<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{


    public function index()
    {
        $users = User::where('id','!=',Session::get('loggedUser')->id)->get();
            return view('Administrator.Users.index', compact('users'));
    }

    public function createUser()
    {
        $roles = Role::get();
        return view('Administrator.Users.create_user', compact('roles'));
    }

    public function storeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $pass = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 6);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($pass);
        $user->role_id = $request->role;
        $user->status = 1;
        if ($user->save()) {
            return redirect()->route('users')->with('success', 'User added successfully');
        } else {
            return redirect()->route('create.user')->with('error', 'Oops! something unexpected happened!');
        }
    }

    public function editUser($id)
    {
        $user = User::find($id);
        if (!empty($user)) {
            // $roles = Role::get();
            return view('Administrator.Users.edit_user', compact('user'));
        } else {
            return view('Administrator.Users.edit_user', compact('user'));
        }
    }


    public function updateUser(Request $request)
    {

        // echo $request->id;
        // die();
        $user=User::find($request->id);
        if (!empty($user)) {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'required|email|unique:users,email,'.$user->id,
                'role' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->role_id = $request->input('role');
            $user->save();
            return redirect()->route('users')->with('success', 'User Updated Successfully');
        } else {
            return redirect()->route('users')->with('error', 'Oops! something unexpected happened!');
        }
    }


    public function deleteUser($id)
    {
        $data = User::find($id);
        if ($data) {
            $status = $data->delete();
            if ($status) {
                return redirect()->route('users')->with('success', 'User Deleted Successfully');
            } else {
                return back()->with('error', 'Oops! Somthing went wrong!');
            }
        } else {
            return back()->with('error', 'Oops! User Not Found');
        }
    }

    public function statusUpdate(Request $request)
    {
        $users = User::find($request->id);
        if (!empty($users)) {
            $users->status = $request->status;
            $users->save();
            return response()->json(['success' => 'Status Updated Successfully']);
        } else {
            return response()->json(['error' => 'Oops! something unexpected happened!']);
        }
    }
}

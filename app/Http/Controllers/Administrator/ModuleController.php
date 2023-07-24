<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

class ModuleController extends Controller
{


    public function modules()
    {
        $modules = Module::get();
            return view('Administrator.Modules.index',compact('modules'));

    }

    public function createModule()
    {
        return view('Administrator.Modules.create_module');
    }

    public function storeModule(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255|unique:modules',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $module = new Module();
        $module->title = $request->title;
        $module->description = $request->description;
        $module->status = 1;
        if ($module->save()) {
            return redirect()->back()->with('success', 'New module has been inserted');
        } else {
            return redirect()->back()->with('error', 'Oops! something unexpected happened!');
        }
    }

    public function editModule(Module $module)
    {
        if (!empty($module)) {
            return view('Administrator.Modules.edit_module', compact('module'));
        } else {
            return view('Administrator.Modules.edit_module', compact('module'));
        }
    }

    public function updateModule(Request $request, Module $module)
    {
        if (!empty($module)) {
            $validator = Validator::make($request->all(), [
                'title' => 'required|unique:modules,title,'.$module->id,
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $module->title = $request->input('title');
            $module->description = $request->input('description');
            $module->update();
            return redirect()->route('modules')->with('success', 'Module Updated Successfully');
        } else {
            return redirect()->route('modules')->with('error', 'Oops! something unexpected happened!');
        }
    }

    public function statusUpdate(Request $request)
    {
        $module = Module::find($request->module_id);
        if (!empty($module)) {
            $module->status = $request->status;
            $module->save();
            return response()->json(['success' => 'Status Updated Successfully']);
        } else {
            return response()->json(['error' => 'Oops! something unexpected happened!']);
        }
    }

    public function deleteModule($id)
    {
        $data = Module::find($id);
        if ($data) {
            $status = $data->delete();
            if ($status) {
                return redirect()->route('modules')->with('success', 'Module Deleted Successfully');
            } else {
                return back()->with('error', 'Oops! Somthing went wrong!');
            }
        } else {
            return back()->with('error', 'Oops! Module Not Found');
        }
    }
}

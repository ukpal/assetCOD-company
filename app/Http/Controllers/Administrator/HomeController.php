<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use File;
// use Illuminate\Contracts\View\View;
use Redirect;
use ZipArchive;


class HomeController extends Controller
{

    // public function __construct(){
    //     Session::get('newDB');

    //     $settings = new GeneralSettings;
    //     view()->share([
    //         'company_logo' => $settings->company_logo,
    //     ]);
    // }
    // public function __construct()
    // {
    //     // $settings = Setting::first();
    //     $settings = DB::table('settings')->get();
    //     view()->share(compact('settings'));
    //     // echo $settings;
    // }

    public function index()
    {
        // $settings = new GeneralSettings;
        // print_r($settings); exit();
        return view('Administrator.dashboard.index');
    }

    // public function login()
    // {
    //     if (Auth::check()) {
    //         return view('Administrator.dashboard.index');
    //     } else {

    //         return view('Administrator.login', compact('settings'));
    //     }
    // }

    // public function postLogin(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|max:255',
    //         'password' => 'required|min:8|max:12',
    //         'code' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    //         Session::put('user', $request->email);

    //         if (Session::get('url.intended')) {
    //             return Redirect::to(Session::get('url.intended'));
    //         } else {
    //             return redirect()->route('dashboard')->with('success', 'Successfully Login');
    //         }
    //     } else {
    //         // return back()->with('error','Invalid email & Password');
    //         return redirect()->route('admin.login')->with('error', 'Incorrect Email or Password');
    //     }
    // }

    //  public function unzip()
    // {
    //     // $file = $_GET["file"];
    //     $file = public_path('Administrator.zip');
    //     $zip = new ZipArchive;
    //     $res = $zip->open($file);
    //     $path = public_path().'/images/article/imagegallery';
    //     File::makeDirectory($path, $mode = 0777, true, true);
    //     $zip->extractTo($path);
    //     $zip->close();
    //     // return view('Administrator.dashboard.index');
    // }




    public function setModulePermission($id)
    {
        $modules = DB::table('modules')->select('modules.title', 'subscription_module_permissions.*')
            ->leftJoin(
                'subscription_module_permissions',
                'modules.id',
                '=',
                DB::raw('subscription_module_permissions.module_id AND subscription_module_permissions.subscription_id = ' . $id)
            )
            ->get();

        return view('Administrator.SetModulePermission.index', compact('modules'));
    }

    public function createSudomain()
    {

        $domainName = env('ROOT_DOMAIN');
        $cPanelUser = env('CPANEL_USER');
        $cPanelPass = env('CPANEL_PASS');
        $subDomainName =  'demo';
        $subDomain = $subDomainName;

        $rootDomain = $domainName;

        $buildRequest = "/frontend/paper_lantern/subdomain/doadddomain.html?rootdomain=" . $rootDomain . "&domain=" . $subDomain . "&dir=$subDomain" . "." . $domainName;

        $openSocket = fsockopen('localhost', 2082);
        if (!$openSocket) {
            return "Socket error";
            exit();
        }

        $authString = $cPanelUser . ":" . $cPanelPass;
        $authPass = base64_encode($authString);
        $buildHeaders  = "GET " . $buildRequest . "\r\n";
        $buildHeaders .= "HTTP/1.0\r\n";
        $buildHeaders .= "Host:localhost\r\n";
        $buildHeaders .= "Authorization: Basic " . $authPass . "\r\n";
        $buildHeaders .= "\r\n";

        fputs($openSocket, $buildHeaders);
        while (!feof($openSocket)) {
            fgets($openSocket, 128);
        }
        fclose($openSocket);

        // echo $newDomain = "http://" . $subDomain . "." . $rootDomain . "/";
        $newDomain = $subDomain . "." . $rootDomain . "/";
        $this->unzip($newDomain);

        return view('Administrator.dashboard.index');
    }


    public function unzip($subdomain)
    {
        $file = public_path('demo.zip');
        $zip = new ZipArchive;
        $res = $zip->open($file);
        $path = '/home2/c2marketplace/' . $subdomain . '/';
        $zip->extractTo($path);
        $zip->close();
    }
}

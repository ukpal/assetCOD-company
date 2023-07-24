<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class HomeController extends Controller
{
    public function index()
    {
        return view('Administrator.dashboard.index');
    }


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


    public function processPaypal(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('processsuccess'),
                "cancel_url" => route('processcancel'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "100.00"
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('createpaypal')
                ->with('error', 'Something went wrong.');

        } else {
            return redirect()
                ->route('createpaypal')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }

        // $ch = curl_init();
        // $clientId = "AZAxeGM4LX2M8-P78kw_dvB9H2NryBAtllOqWQj8bwDIir_U8JZ24GsoCc-jRhS-wXr9rBacXLG36UHE";
        // $secret = "EBjT_xYy7e49PH2fD7Ain6obVsoqtD1QRBCxw048G0Vbv9uQmEt__u8q4Dt0dCUgua5K-kjX0vqzAvTt";

        // curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");
        // curl_setopt($ch, CURLOPT_HEADER, false);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_USERPWD, $clientId . ":" . $secret);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

        // $result = curl_exec($ch);

        // if (empty($result)) die("Error: No response.");
        // else {
        //     $json = json_decode($result);
        //     print_r($json->access_token);
        //     // echo "hello";
        // }

        // curl_close($ch);
    }

    public function processsuccess(Request $request){

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()
                ->route('dashboard')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('dashboard')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function processcancel(Request $request)
    {
        return redirect()
            ->route('dashboard')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }


    public function unzip(){

    }


    public function createSudomain(){

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
        $newDomain = $subDomain . "." . $rootDomain . "/";
        $this->unzip($newDomain);

    }



}

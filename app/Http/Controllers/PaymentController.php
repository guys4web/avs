<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Payum\Core\Request\GetHumanStatus;
use Payum\LaravelPackage\Controller\PayumController;

use Sentinel;

class PaymentController extends PayumController{

	private $auth_login_id = "62MD5gVpe6" ;
    private $key = "28M42L4dSnCn833T" ;
	private $secret= "Simon" ;

	public function postIndex(Request $request)
	{

        return redirect()->route("prepare_payment");

	}

	public function prepare($currencycode,$amt)
	{
            $user = Sentinel::getUser();
            $storage = $this->getPayum()->getStorage('Payum\Core\Model\ArrayObject');
            $details = $storage->create();
            $details['paymentrequest_0_currencycode'] = strtoupper($currencycode);
            $details['paymentrequest_0_amt'] = $amt;
            $details['currencycode'] = strtoupper($currencycode);
            $details['amount'] = 1; //$amt;
            $details['billTo'] = ['firstName'=>$user->first_name,'lastName'=>$user->last_name , 'city'=> \Session::get('bcity') , 'address' => \Session::get("baddress") , 'state' => \Session::get('bstate') , 'zip' => \Session::get('postal') ]  ;
            $details['first_name'] 	= $user->first_name;
            $details['last_name'] 	= $user->last_name;
            $details['address']		= \Session::get('baddress');
            $details['city']		= \Session::get('bcity');
            $details['state']		= \Session::get('bstate');
            $details['zip']	= \Session::get('postal');

            $storage->update($details);

            $captureToken = $this->getPayum()->getTokenFactory()->createCaptureToken('authorize_net', $details, 'payment_done');
            return redirect()->to($captureToken->getTargetUrl());
	}

	public function done(Request $request,$payum_token)
        {
            $request->attributes->set('payum_token', $payum_token);

            $token = $this->getPayum()->getHttpRequestVerifier()->verify($request);
            $gateway = $this->getPayum()->getGateway($token->getGatewayName());

            $gateway->execute($status = new GetHumanStatus($token));
            $status_txt = $status->getValue();
            $details = iterator_to_array($status->getFirstModel());
            if($status_txt=="captured")
            {
                if($details['approved']==true && $details['declined']==false)
                {
                    $request->session()->put("payment_data",serialize($details));
                    return redirect()->route("cart_done");
                }
                else
                {
                    return redirect()->route("cart")->with("error","Payment error , validation error ");
                }
            }
            else
            {
		return redirect()->route("cart")->with("error","Payment error , statut not captured ".$status_txt);
            }

        }
}

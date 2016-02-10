<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Payum\Core\Request\GetHumanStatus;
use Payum\LaravelPackage\Controller\PayumController;

class PaymentController extends PayumController{

	private $auth_login_id = "9q8HNPjd8M" ;
	private $key = "7p75R2a3ZZ4Yx5zg" ;
	private $secret= "Simon" ;

	public function postIndex(Request $request)
	{

        return redirect()->route("prepare_payment");

	}

	public function prepare($currencycode,$amt)
	{
				$storage = $this->getPayum()->getStorage('Payum\Core\Model\ArrayObject');

        $details = $storage->create();
        $details['paymentrequest_0_currencycode'] = strtoupper($currencycode);
        $details['paymentrequest_0_amt'] = $amt;
        $details['currencycode'] = strtoupper($currencycode);
        $details['amount'] = $amt;
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
								return redirect()->route("home")->with("error","Payment error");
						}
				}
				else
				{
						return redirect()->route("home")->with("error","Payment error");
				}

    }
}

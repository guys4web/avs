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

	public function getIndex()
	{
		return view("paymentindex");
	}
	
	public function prepare()
	{
		$storage = $this->getPayum()->getStorage('Payum\Core\Model\ArrayObject');

        $details = $storage->create();
        $details['paymentrequest_0_currencycode'] = 'EUR';
        $details['paymentrequest_0_amt'] = 1;
        $details['currencycode'] = 'EUR';
        $details['amount'] = 1;
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

        return \Response::json(array(
            'status' => $status->getValue(),
            'details' => iterator_to_array($status->getFirstModel())
        ));
    }
}
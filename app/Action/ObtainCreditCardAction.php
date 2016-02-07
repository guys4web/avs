<?php
namespace App\Action;

use Payum\Core\Action\ActionInterface;
use Payum\Core\Bridge\Symfony\Reply\HttpResponse;
use Payum\Core\Exception\RequestNotSupportedException;
use Payum\Core\Model\CreditCard;
use Payum\Core\Request\ObtainCreditCard;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Routing\Redirector;

class ObtainCreditCardAction implements ActionInterface
{


    public function execute($request)
    {
        /** @var $request ObtainCreditCard */
        if (false == $this->supports($request)) {
            throw RequestNotSupportedException::createActionNotSupported($this, $request);
        }

        if (\Session::has('cardnum')) {
            $creditCard = new CreditCard;
            $creditCard->setHolder(\Session::get('bname'));
            $creditCard->setNumber(\Session::get('cardnum'));
            $creditCard->setSecurityCode(\Session::get('ccv'));
            $creditCard->setExpireAt(new \DateTime(\Session::get('expDate')));

            $request->set($creditCard);

            return;
        }

        return \Redirect::route("home");

    }

    public function supports($request)
    {
        return $request instanceof ObtainCreditCard;
    }
}
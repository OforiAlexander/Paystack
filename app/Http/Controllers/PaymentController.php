<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Facades\Paystack; // Paystack package
use Auth;
use App\Student; // Student Model
use App\Payment; // Payment Model
use App\User; // User model
use Exception;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100'],
            'amount' => ['required', 'numeric', 'min:1']
        ]);

        $url = config('paystack.paymentUrl') . '/transaction/initialize';

        try {
            $response = Http::asJson()
                ->withToken(config('paystack.secretKey'))
                ->post($url, [
                    'email' => $request->email,
                    'amount' => intval($request->amount * 100),
                    'callback_url' => route('paystack.callback'),
                    // 'reference' =>
                ])->throw();

            return redirect($response->json('data.authorization_url'));
        } catch (Exception $e) {
            report($e);
            dd('An error occurred');
        }
    }


    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
    // Now you have the payment details,
    // you can store the authorizapk_test_f04cd4aad6ee307567a85f6c63e018c634bb5b6dtion_code in your DB to allow for recurrent subscriptions
    // you can then redirect or do whatever you want
}

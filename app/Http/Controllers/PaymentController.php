<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Paket;
use App\Models\User;
use App\Models\Profile;

class PaymentController extends Controller
{
    public function handlePayment(Request $request)
    {
        $user = User::find($request->input('id'));
        $profileUser = Profile::find($user->ID_User);
        //return $profileUser;
        // Set your Midtrans credentials
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Get the value of Config::$serverKey
// $serverKey = Config::$serverKey;

// // Return the value as part of the response
// return response()->json(['serverKey' => $serverKey]);
        //$serverKey = "SB-Mid-server-82xg1Gbhq0VxjRzMcFLketCi";
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = true;
        
        // Get the plan ID from the  request
        $planId = $request->input('planId');

        // Get the plan details (you need to replace this with your logic)
        $plan = Paket::findOrFail($planId);
        //return $plan;
        // Create the transaction details
        $transactionDetails = [
            'order_id' => uniqid(),
            'gross_amount' => $plan->harga,
        ];
        //return $transactionDetails;
        // Create the customer details (you need to replace this with your logic)
        $customerDetails = [
            'first_name' => $profileUser->nama_lengkap,
            'email' => $user->email,
            'phone' => $profileUser->no_telp,
            'address'=> $profileUser->alamat,
        ];
        //return $customerDetails;
        // Create the item details
        $itemDetails = [
            [
                'id' => $plan->ID_paket,
                'price' => $plan->harga,
                'quantity' => 1,
                'name' => $plan->nama_paket,
            ],
        ];
        //return $itemDetails;
        // Create the credit card secure token (you need to replace this with your logic)
        $creditCardOptions = [
            'secure' => true,
        ];
       

        //return $snapToken;
        try {
            // Create Snap Token
            $snapToken = Snap::getSnapToken([
                'transaction_details' => $transactionDetails,
                'customer_details' => $customerDetails,
                'item_details' => $itemDetails,
                'credit_card' => $creditCardOptions,
            ]);

            return response()->json(['token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

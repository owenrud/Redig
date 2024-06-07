<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans;
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
 
        // Set your Midtrans credentials
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');


        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = true;
        
        // Get the plan ID from the  request
        $planId = $request->input('planId');

        // Get the plan details (you need to replace this with your logic)
        $plan = Paket::findOrFail($planId);

        // Create the transaction details
        $transactionDetails = [
            'order_id' => uniqid(),
            'gross_amount' => $plan->harga,
        ];
        
        // Create the customer details (you need to replace this with your logic)
        $customerDetails = [
            'first_name' => $user->nama_lengkap,
            'email' => $user->email,
            'phone' => $user->no_telp,
            'address'=> $user->alamat,
        ];
        
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
    public function createPaymentLink(Request $request)
    {
        try {
            $response = Http::withBasicAuth(env('MIDTRANS_SERVER_KEY'), '')
                ->post('https://api.sandbox.midtrans.com/v1/payment-links', [
                    'transaction_details' => [
                        'order_id' => uniqid(), // Adjust order ID as needed
                        'gross_amount' => 10500, // Adjust gross amount as needed// Adjust payment link ID as needed
                  
                    ],
                    "customer_required"=> false,
                    "expiry"=> [
                        "start_time" => now(),
                    "duration"=> 7,
                    "unit"=> "days"
                    ],
                    
                        "customer_details"=>[
                            "first_name"=> "Owen",
                        "last_name"=> "Rudianto",
                        
                        
                        "notes"=> "Thank you for register premium Event. Please follow the instructions to pay."
                        ],
            ]);

            if ($response->successful()) {
                $responseData = $response->json();
                return $responseData;
            } else {
                throw new \Exception('Failed to create payment link: ' . $response->body());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

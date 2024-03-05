@extends('layouts.main')
@section('title','Paket Langganan')
@section('page_title','Paket Langganan')
@section('content')

 <div class ="flex flex-col overflow-x-hidden overflow-y-auto h-screen justify-center items-center">
 <!-- Loading spinner -->
  <div id="loadingSpinner" class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12"></div>
<div id="plansContainer" class="flex flex-row oveflow-x-hidden space-x-12 ">
  </div>
</div>

@endsection

@section('script')

<!-- Add this script to your HTML body -->
<script>

 

  // Async function to handle payment
  async function handlePayment(event) {
    const planId = event.currentTarget.getAttribute('data-id-paket');
    // Implement your payment logic here
    console.log(`Selected plan with ID ${planId}. Implement payment logic.`);
  } async function createPlansUI() {
    try {
      // Show loading spinner
      const loadingSpinner = document.getElementById('loadingSpinner');
      loadingSpinner.classList.remove('hidden');

      // Fetch plans data
      const response = await fetch('http://localhost:8000/api/paket/all');
      const plansData = await response.json();

      // Check if data retrieval was successful
      if (!plansData.is_success) {
        console.error('Error fetching plans data:', plansData.error_message || plansData.message);
        return;
      }

      // Get the plans container
      const plansContainer = document.getElementById('plansContainer');

      // Initialize HTML string
      let plansHTML = '';

      // Iterate through each plan data
      plansData.data.forEach((plan) => {
        // Skip 'Gratis' plans
        if (plan.nama_paket.toLowerCase() === 'gratis') {
          return;
        }

        // Construct HTML for plan
         plansHTML += `
          <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-4 text-xl font-medium text-gray-500 dark:text-gray-400">${plan.nama_paket}</h5>
            <div class="flex items-baseline text-gray-900 dark:text-white">
              <span class="text-4xl font-semibold mr-2">Rp.</span>
              <span class="text-4xl font-bold tracking-tight">${plan.harga.toLocaleString('id-ID')}</span>
              <span class="ms-1 text-xl font-normal text-gray-500 dark:text-gray-400">/month</span>
            </div>
            <ul class="space-y-7 my-12">
              <li class="flex items-center">
                <i class="fa-solid fa-circle-check ${plan.ScanCount === 0 ? 'text-gray-400' : 'text-purple-700'}"></i>
                <span class="text-base font-normal leading-tight ms-3 ${plan.ScanCount === 0 ? 'text-gray-400 line-through' : 'text-violet-400 dark:text-gray-400'}">
                  ${plan.ScanCount} Scan per Day
                </span>
              </li>
              <li class="flex items-center">
                <i class="fa-solid fa-circle-check ${plan.FileUpCount === 0 ? 'text-gray-400' : 'text-purple-700'}"></i>
                <span class="text-base font-normal leading-tight ms-3 ${plan.FileUpCount === 0 ? 'text-gray-400 line-through' : 'text-violet-400 dark:text-gray-400'}">
                  ${plan.FileUpCount} File Uploads
                </span>
              </li>
              <li class="flex items-center">
                <i class="fa-solid fa-circle-check ${plan.GuestCount === 0 ? 'text-gray-400' : 'text-purple-700'}"></i>
                <span class="text-base font-normal leading-tight ms-3 ${plan.GuestCount === 0 ? 'text-gray-400 line-through' : 'text-violet-400 dark:text-gray-400'}">
                  ${plan.GuestCount} Guest Limit
                </span>
              </li>
              <li class="flex items-center">
                <i class="fa-solid fa-circle-check ${plan.OperatorCount === 0 ? 'text-gray-400' : 'text-purple-700'}"></i>
                <span class="text-base font-normal leading-tight ms-3 ${plan.OperatorCount === 0 ? 'text-gray-400 line-through' : 'text-violet-400 dark:text-gray-400'}">
                  ${plan.OperatorCount} Operator Count
                </span>
              </li>
              <li class="flex items-center">
                <i class="fa-solid fa-circle-check ${plan.SertifCount === 0 ? 'text-gray-400' : 'text-purple-700'}"></i>
                <span class="text-base font-normal leading-tight ms-3 ${plan.SertifCount === 0 ? 'text-gray-400 line-through' : 'text-violet-400 dark:text-gray-400'}">
                  ${plan.SertifCount} Sertifikat Count
                </span>
              </li>
            </ul>
            <button class="relative inline-flex items-center justify-center w-full p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-300 via-purple-400 to-purple-500 group-hover:from-purple-500 group-hover:to-pink-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800" data-id-paket="${plan.ID_paket}">
              <span class="relative w-full px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">Choose Plan</span>
            </button>
          </div>
        `;
      });

      // Set plans HTML inside the container
      plansContainer.innerHTML = plansHTML;

      // Hide loading spinner
      loadingSpinner.classList.add('hidden');
    } catch (error) {
      console.error('Error creating plans UI:', error);
    }
  }


  // Call the async function to create UI for plans
  createPlansUI();
</script>

<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-CJhXK_QpQfD8Is7A"></script>

<script>
function handlePayment(event) {
    const id = {{ $authUser->ID_User }};
    const planId = event.currentTarget.getAttribute('data-id-paket');
    //return console.log(planId);
    // Assuming you have a server endpoint to generate the Midtrans token
    fetch("http://localhost:8000/api/paket/payment/generate", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            planId: planId,
            id : id,
            // other necessary information
        }),
    })
    .then(response => response.json())
    .then(data => {
        // Assuming Midtrans is properly integrated into your project
        // Open the Midtrans Pop Up with the generated token
        window.snap.pay(data.token, {
            onSuccess: function(result) {

               // console.log('Payment successful', result);
                 const paymentData = {
        status : result.status_code,
        ID_paket: planId,
        ID_user : id,
        Type: result.payment_type,
        Payment_id : result.order_id,
        total : result.gross_amount,
        // Add other properties as needed
    };

    // Send payment data to your server
    fetch('http://localhost:8000/api/invoice/save', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            // Add any additional headers if needed
        },
        body: JSON.stringify(paymentData),
    })
    .then(response => response.json())
    .then(serverResponse => {
        console.log('Server response:', serverResponse);
        // Handle the server response as needed
    })
    .catch(error => {
        console.error('Error sending payment data:', error);
        // Handle errors, e.g., display an error message to the user
    });
            },

            onPending: function(result) {
                console.log('Payment pending', result);

                const paymentData = {
        status : result.status_code,
        ID_paket: planId,
        ID_user : id,
        bill_key : result.bill_key,
        biller_code : result.biller_code,
        Type: result.payment_type,
        Payment_id : result.order_id,

        total : result.gross_amount,
        // Add other properties as needed
    };

    // Send payment data to your server
    fetch('http://localhost:8000/api/invoice/save', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            // Add any additional headers if needed
        },
        body: JSON.stringify(paymentData),
    })
    .then(response => response.json())
    .then(serverResponse => {
        console.log('Server response:', serverResponse);
        // Handle the server response as needed
    })
    .catch(error => {
        console.error('Error sending payment data:', error);
        // Handle errors, e.g., display an error message to the user
    });
            },
            onError: function(result) {
                console.error('Payment error', result);
                
                const paymentData = {
        status : result.status_code,
        ID_paket: planId,
        ID_user : id,
        bill_key : result.bill_key,
        biller_code : result.biller_code,
        Type: result.payment_type,
        Payment_id : result.order_id,

        total : result.gross_amount,
        // Add other properties as needed
    };

    // Send payment data to your server
    fetch('http://localhost:8000/api/invoice/save', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            // Add any additional headers if needed
        },
        body: JSON.stringify(paymentData),
    })
    .then(response => response.json())
    .then(serverResponse => {
        console.log('Server response:', serverResponse);
        // Handle the server response as needed
    })
    .catch(error => {
        console.error('Error sending payment data:', error);
        // Handle errors, e.g., display an error message to the user
    });
            },
            onClose: function() {
                console.log('Pop Up closed');
            }
        });
    })
    .catch(error => console.error('Error during fetch:', error));
}
</script>
@endsection
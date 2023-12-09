@extends('layouts.main')
@section('content')
 <div class ="flex flex-col overflow-x-hidden overflow-y-auto h-screen justify-center items-center">
<div id="plansContainer" class="flex flex-row oveflow-x-hidden space-x-12 ">

  </div>
</div>
@endsection

@section('script')

<!-- Add this script to your HTML body -->
<script>
  // Async function to fetch data for plans
  async function fetchPlansData() {
    try {
      const response = await fetch('http://localhost:8000/api/paket/all');
      const plansData = await response.json();

      if (plansData.is_success) {
        // Return an array of promises for each plan
        return plansData.data.map(async (plan) => {
          // Fetch data for features
          if (plan.nama_paket.toLowerCase() === 'gratis') {
            return null;
          }

          const featuresResponse = await fetch('http://localhost:8000/api/fitur-paket/show', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({ ID_fitur: plan.ID_fitur }),
          });

          const featuresData = await featuresResponse.json();

          return { plan, featuresData };
        });
      } else {
        console.error('Error fetching plans data:', plansData.error_message || plansData.message);
        return [];
      }
    } catch (error) {
      console.error('Error fetching plans data:', error);
      return [];
    }
  }

  // Async function to handle payment
  async function handlePayment(event) {
    const planId = event.currentTarget.getAttribute('data-id-paket');
    // Implement your payment logic here
    console.log(`Selected plan with ID ${planId}. Implement payment logic.`);
  }

  // Async function to create UI for plans
  async function createPlansUI() {
    try {
      // Fetch plans data
      const plansPromises = await fetchPlansData();
      const plansData = await Promise.all(plansPromises);

      // Get the plans container
      const plansContainer = document.getElementById('plansContainer');

      // Iterate through each plan data
      plansData.forEach((data) => {
        if (!data) {
          return;
        }

        const { plan, featuresData } = data;

        // Create plan container
        const planContainer = document.createElement('div');
        planContainer.className =
          'w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700';

        // Plan title
        const title = document.createElement('h5');
        title.className = 'mb-4 text-xl font-medium text-gray-500 dark:text-gray-400';
        title.textContent = plan.nama_paket;
        planContainer.appendChild(title);

        // Price
        const priceContainer = document.createElement('div');
        priceContainer.className = 'flex items-baseline text-gray-900 dark:text-white';
        const currency = document.createElement('span');
        currency.className = 'text-4xl font-semibold mr-2';
        currency.textContent = 'Rp.';
        const amount = document.createElement('span');
        amount.className = 'text-4xl font-bold tracking-tight';
        amount.textContent = plan.harga.toLocaleString('id-ID'); // Format harga with commas
        const perMonth = document.createElement('span');
        perMonth.className = 'ms-1 text-xl font-normal text-gray-500 dark:text-gray-400';
        perMonth.textContent = '/month';
        priceContainer.append(currency, amount, perMonth);
        planContainer.appendChild(priceContainer);

        // Features list
        const featuresList = document.createElement('ul');
        featuresList.className = 'space-y-7 my-12';
        const featureDisplayText = {
          scan_count: 'Scan per Day',
          file_up_count: 'File Uploads',
          guest_count: 'Guest Limit',
          operator_count: 'Operator Count',
          sertif_count: 'Sertifikat Count',
        };

        Object.keys(featuresData.data).forEach((featureKey) => {
          if (
            featureKey !== 'created_at' &&
            featureKey !== 'updated_at' &&
            featureKey !== 'ID_fitur'
          ) {
            const listItem = document.createElement('li');
            listItem.className = 'flex items-center';

            const iconElement = document.createElement('i');
            iconElement.className = `fa-solid fa-circle-check ${
              featuresData.data[featureKey] === 0 ? 'text-gray-400' : 'text-purple-700'
            }`;

            const featureText = document.createElement('span');
            featureText.className = `text-base font-normal leading-tight ms-3 ${
              featuresData.data[featureKey] === 0
                ? 'text-gray-400 line-through'
                : 'text-violet-400 dark:text-gray-400'
            }`;
            featureText.textContent =
              featuresData.data[featureKey] + ' ' + featureDisplayText[featureKey] || featureKey;

            listItem.append(iconElement, featureText);
            featuresList.appendChild(listItem);
          }
        });

        planContainer.appendChild(featuresList);
        featuresList.appendChild(document.createElement('div'));

        // Choose Plan button
        const choosePlanButton = document.createElement('button');
        choosePlanButton.className =
          'relative inline-flex items-center justify-center w-full p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-300 via-purple-400 to-purple-500 group-hover:from-purple-500 group-hover:to-pink-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800';
        choosePlanButton.innerHTML =
          '<span class="relative w-full px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">Choose Plan</span>';
        choosePlanButton.setAttribute('data-id-paket', plan.ID_paket);
        choosePlanButton.addEventListener('click', handlePayment);
        planContainer.appendChild(choosePlanButton);

        // Append the plan container to the main container
        plansContainer.appendChild(planContainer);
      });
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
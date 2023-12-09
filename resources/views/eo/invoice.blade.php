@extends('layouts.main')
@section('content')
<div id="alert-border-4" class="flex items-center mx-4 mt-4 p-4 mb-4 text-black border-l-4 text-yellow-900 border-yellow-300 bg-slate-50 dark:text-yellow-300 dark:bg-gray-800 dark:border-yellow-800 rounded-lg" role="alert">
    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <div class="ms-3 text-sm font-medium">
    Jelajahi Invoice terbaru Anda
    </div>
</div>


<div class="flex flex-col mx-auto w-10/12 p-4 bg-white border border-gray-200 overflow-y-auto space-y-4 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
<span class="text-purple-900 font-bold">
Riwayat Invoice
</span>
<div class="flex flex-col overflow-x-auto  shadow-lg  sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-purple-100 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Paket
                </th>
                <th scope="col" class="px-6 py-3">
                    Harga
                </th>
                
            </tr>
        </thead>
        <tbody id="invoiceBody">
            
        </tbody>
    </table>
    <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4 mb-4 px-8" aria-label="Table navigation">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing <span class="font-semibold text-gray-900 dark:text-white">1-10</span> of <span class="font-semibold text-gray-900 dark:text-white">1000</span></span>
        <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
            <li>
                <a href="#" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
            </li>
            <li>
                <a href="#" aria-current="page" class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">4</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">5</a>
            </li>
            <li>
        <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
            </li>
        </ul>
    </nav>
</div>
</div>
@endsection

@section('script')
<!-- Add this script to your HTML body -->
<script>
  // Global user ID variable
 // Replace with the actual user ID

  // Async function to fetch data for invoice
  async function fetchInvoiceData() {
    try {
      const response = await fetch('http://localhost:8000/api/invoice/show/user', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id: id }),
      });

      const data = await response.json();

      if (data.is_success) {
                const invoiceItemsPromises = data.data.map(async (item) => {
          const paketResponse = await fetch('http://localhost:8000/api/paket/show', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({ ID_paket: item.ID_paket }),
          });

          const paketData = await paketResponse.json();

          if (paketData.is_success && paketData.data) {
            // Add nama_paket to the item
            item.nama_paket = paketData.data.nama_paket;
          } else {
            console.error('Error fetching paket data:', paketData.error_message || paketData.message);
          }

          return item;
        });

        // Wait for all promises to resolve
        const invoiceItems = await Promise.all(invoiceItemsPromises);

        return invoiceItems;

      } else {
        console.error('Error fetching invoice data:', data.error_message || data.message);
        return [];
      }
    } catch (error) {
      console.error('Error fetching invoice data:', error);
      return [];
    }
  }

  // Async function to create UI for invoice
  async function createInvoiceUI() {
    try {
      // Fetch invoice data
      const invoiceData = await fetchInvoiceData();

      // Get the invoice body
      const invoiceBody = document.getElementById('invoiceBody');

      // Clear existing rows
      invoiceBody.innerHTML = '';

      // Return an array of promises for each invoice item
      const invoicePromises = invoiceData.map(async (item, index) => {
        const row = invoiceBody.insertRow();
        const cellNo = row.insertCell(0);
        const cellStatus = row.insertCell(1);
        const cellNamaPaket = row.insertCell(2);
        const cellHarga = row.insertCell(3);
        const cellAction = row.insertCell(4);

        // Populate cells with data
       // Populate cells with data
        cellNo.textContent = index + 1;
        cellNo.classList.add('px-6', 'py-4'); // Add classes to cellNo
        
        //console.log(item.status);
        if(item.status !== 200){
            cellStatus.textContent = "Failed";
        cellStatus.classList.add('font-bold','text-rose-600','px-6', 'py-4'); 
        
        }else{
            cellStatus.textContent = "Success";
        cellStatus.classList.add('font-bold','text-green-600','px-6', 'py-4'); 
        }
        // Add classes to cellStatus

        cellHarga.textContent = 'Rp. '+ item.total.toLocaleString('id-ID');
        cellHarga.classList.add('font-bold','px-6', 'py-4'); // Add classes to cellHarga

        cellNamaPaket.textContent = item.nama_paket;
        cellNamaPaket.classList.add('font-bold','px-6', 'py-4'); // Add classes to cellNamaPaket


        // You can add any other properties you want to display

        // Customize the action cell based on your requirements
        // For example, you can add buttons or links
        });

      // Wait for all promises to resolve
      await Promise.all(invoicePromises);
    } catch (error) {
      console.error('Error creating invoice UI:', error);
    }
  }

  // Call the async function to create UI for invoice
  createInvoiceUI();
</script>

@endsection
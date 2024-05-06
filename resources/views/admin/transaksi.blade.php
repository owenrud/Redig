@extends('admin.layouts.main')
@section('title','daftar transaksi')
@section('page_title','Daftar Transaksi')
@section('content')

<div class="flex flex-col max-h-sm overflow-y-auto my-auto mx-auto w-10/12 p-4 bg-white border border-gray-200 overflow-y-auto space-y-4 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
<span class="text-purple-900 font-bold">
Daftar Transaksi
</span>
<hr>
<div class="justify-between">
</div>
<div class="flex flex-col overflow-x-auto  shadow-lg  sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-purple-100 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="text-center px-6 py-3">
                    No
                </th>
                <th scope="col" class="text-center px-6 py-3">
                    ID_paket
                </th>
                <th scope="col" class="text-center px-6 py-3">
                   ID_User
                </th>
                <th scope="col" class="text-center px-6 py-3">
                    Payment ID
                </th>
                <th scope="col" class="text-center px-6 py-3">
                    Payment Type
                </th>
                <th scope="col" class="text-center px-6 py-3">
                    Status
                </th>
                <th scope="col" class="text-center px-6 py-3">
                    Amount
                </th>
                
            </tr>
        </thead>
        <tbody id="tableBody">
           
        </tbody>
    </table>
   <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4 mb-4 px-8" aria-label="Table navigation">
    <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">
        Showing <span class="font-semibold text-gray-900 dark:text-white" id="startData">1</span>-
        <span class="font-semibold text-gray-900 dark:text-white" id="endData">10</span> of 
        <span class="font-semibold text-gray-900 dark:text-white" id="totalData">1000</span>
    </span>
<ul id="paginationContainer" class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
            
        </ul>
    </nav>
</div>
</div>


@endsection

@section('script')
<script>
async function readInvoice(page = 1) {
  try {
    const response = await fetch(`http://${Endpoint}/api/invoice/all?page=${page}`);
    const apiData = await response.json();

    if (response.ok) {
      const tableBody = document.getElementById('tableBody');
      tableBody.innerHTML = '';

      apiData.data.data.forEach((invoice, index) => {
        const row = tableBody.insertRow();
        //console.log(invoice.status == "200" ? 'Success' : 'Failed');
        const columns = [
          index + 1,
          invoice.ID_paket,
          invoice.ID_user,
          invoice.Payment_id,
          invoice.Type,
          invoice.status,
          invoice.total,
        ];

        columns.forEach((column, columnIndex) => {
          const cell = row.insertCell(columnIndex);

          if (columnIndex === 5) {
            cell.classList.add('text-center', 'px-6', 'py-3');
            if (invoice.status === 200) {
                cell.textContent = 'Success';

              cell.classList.add('font-bold', 'text-emerald-600');
            } else {
                cell.textContent = 'Failed';
              cell.classList.add('font-bold', 'text-rose-600');
            }
          } else if (columnIndex === 6) {
             // Convert "invoice.total" to Indonesian currency format
            const formattedTotal = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
            }).format(invoice.total);
            cell.textContent = formattedTotal;
            cell.classList.add('text-center', 'px-6', 'py-3');
          } else {
            cell.textContent = column;
            cell.classList.add('text-center', 'px-6', 'py-3');
          }
        });

        
      });

      // Update pagination buttons with click event
      const paginationContainer = document.getElementById('paginationContainer');
      paginationContainer.innerHTML = '';
      for (let i = 1; i <= apiData.data.last_page; i++) {
        const button = document.createElement('li');
        button.innerHTML = `<a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">${i}</a>`;
        paginationContainer.appendChild(button);
        button.addEventListener('click', () => readInvoice(i));
      }

      // Update total data information
      const startData = document.getElementById('startData');
      const endData = document.getElementById('endData');
      const totalData = document.getElementById('totalData');

      startData.textContent = apiData.data.from;
      endData.textContent = apiData.data.to;
      totalData.textContent = apiData.data.total;
    } else {
      console.error('Failed to fetch invoice data:', data.message);
    }
    
  } catch (error) {
    console.error('Error fetching invoice data:', error);
  }
}

// Call the function to fetch and populate data for the first page
readInvoice();

// Example action function
function viewDetails(invoiceId) {
  alert(`View details for invoice ID: ${invoiceId}`);
}

</script>
<script>
function deleteInvoiceRowAction(userID) {
    // Konfirmasi pengguna
    const isConfirmed = confirm('Are you sure you want to delete this data?');

    if (isConfirmed) {
        // Hapus data dari endpoint /api/profile/delete/{id}
        fetch(`http://${Endpoint}/api/invoice/delete/${userID}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            // Hapus user dari endpoint /api/user/delete/{id}
             console.log('User deleted successfully!');
            // Misalnya, hapus baris dari tabel
            
                // Reload halaman setelah menghapus
                window.location.reload();
            
        })
        .catch(error => console.error('Error deleting user:', error));
    }
}

</script>
@endsection
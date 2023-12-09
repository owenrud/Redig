@extends('admin.layouts.main')
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
                <th scope="col" class="text-center px-6 py-3">
                    Action
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
                <a href="#" aria-current="page" class="flex items-center justify-center px-3 h-8 text-violet-600 border border-gray-300 bg-violet-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
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
<script>
async function ReadInvoice(){
 try {
                const response = await fetch('http://localhost:8000/api/invoice/all');
                const data = await response.json();

                if (response.ok) {
                    // Access the table body
                    const tableBody = document.getElementById('tableBody');

                    // Clear existing rows
                    tableBody.innerHTML = '';

                    // Populate the table with data
data.data.forEach((invoice, index) => {
    const row = tableBody.insertRow();
    const columns = [
        index + 1,
        invoice.ID_paket,
        invoice.ID_user,
        invoice.Payment_id,
        invoice.Type,
        invoice.status,
        invoice.total,
        // You can add more columns as needed
        // Create action button, e.g., view details
    ];

    columns.forEach((column, columnIndex) => {
        const cell = row.insertCell(columnIndex);

        if (columnIndex === 5) {
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
        } else {
            // For other columns, just set the text content
            cell.textContent = column;
        }

        cell.classList.add('text-center', 'px-6', 'py-3');
    });
    // Conditionally add the "Delete" button
    if (invoice.status !== 200) {
        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete';
        deleteButton.classList.add('cursor-pointer', 'px-8', 'py-3', 'justify-center', 'text-center', 'text-rose-600', 'hover:text-rose-800');
        deleteButton.type = 'button';
        deleteButton.onclick = function () {
            // Define the action you want to perform when the "Delete" button is clicked
            deleteInvoiceRowAction(invoice.id); // You need to implement the deleteRowAction function
        };
        row.appendChild(deleteButton);
    }
});
                } else {
                    console.error('Failed to fetch invoice data:', data.message);
                }
            } catch (error) {
                console.error('Error fetching invoice data:', error);
            }
        }

        // Call the function to fetch and populate data
        ReadInvoice();
        
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
        fetch(`http://localhost:8000/api/invoice/delete/${userID}`, {
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
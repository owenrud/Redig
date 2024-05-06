@extends('admin.layouts.main')
@section('title','Paket')
@section('page_title','Paket')
@section('content')

<div class="flex flex-col max-h-sm overflow-y-auto my-auto mx-auto w-10/12 p-4 bg-white border border-gray-200 overflow-y-auto space-y-4 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
<span class="text-purple-900 font-bold">
Daftar Paket
</span>
<hr>
<div class="justify-between">
<a href="/create-paket">
<button id="openModalBtn" type="button" class="max-w-sm text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-l hover:from-purple-500 hover:via-purple-600 hover:to-purple-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
<svg class="w-5 h-5 me-2 text-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
<path fill="white" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
</svg>
Add data
</button>
</a>
</div>
<div class="flex flex-col overflow-x-auto  shadow-lg  sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-purple-100 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Paket
                </th>
                
                <th scope="col" class="px-6 py-3">
                   Jumlah Scan/Hari
                </th>
                <th scope="col" class="px-6 py-3">
                   Jumlah Upload File
                </th>
                <th scope="col" class="px-6 py-3">
                   Jumlah Maksimum Peserta
                </th>
                <th scope="col" class="px-6 py-3">
                   Jumlah Operator Event
                </th>
                <th scope="col" class="px-6 py-3">
                   Jumlah Sertifikat
                </th>
                <th scope="col" class="px-6 py-3">
                   Harga
                </th>
                <th scope="col" class="px-6 py-3">
                   Status
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
<ul id="paginationContainer" class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
            
        </ul>
    </nav>
    </nav>
</div>
</div>



@endsection

@section('script')
<script>

function GenerateStatus(status){
    //console.log(status);
    switch(status){
        case 0: 
        return 'Inactive';
        case 1:
        return 'Active';
         default:
            return 'unknown status';
    }
        
}

function GenerateTextColorStatus(status){
     switch(status){
        case 0: 
        return 'px-6 py-4 text-red-500';
        case 1:
        return 'px-6 py-4 text-green-500';
         default:
            return '';
    }
}async function fetchDataAndDisplay(page = 1) {
    try {
        const response = await fetch(`http://${Endpoint}/api/paket/all?page=${page}`);
        const apiData = await response.json();

        if (apiData && apiData.is_success) {
            const tableBody = document.getElementById('tableBody');
            const paginationContainer = document.getElementById('paginationContainer');
            let counterData = (page - 1) * apiData.data.per_page + 1;
            let Counter = 1;

            tableBody.innerHTML = ''; // Clear existing data
            paginationContainer.innerHTML = ''; // Clear existing pagination buttons

            apiData.data.data.forEach(paket => {
                const row = document.createElement('tr');
                row.innerHTML = `<td class="px-6 py-4">${Counter}</td>
                                 <td class="px-6 py-4">${paket.nama_paket}</td>
                                 <td class="px-6 py-4">${paket.ScanCount}</td>
                                 <td class="px-6 py-4">${paket.FileUpCount}</td>
                                 <td class="px-6 py-4">${paket.GuestCount}</td>
                                 <td class="px-6 py-4">${paket.OperatorCount}</td>
                                 <td class="px-6 py-4">${paket.SertifCount}</td>
                                 <td class="px-6 py-4">${paket.harga.toLocaleString('id-ID')}</td>
                                 <td class="${GenerateTextColorStatus(paket.status)}">${GenerateStatus(paket.status)}</td>
                                 `;
 const cellAction = document.createElement('td');
                cellAction.classList.add('flex', 'justify-center', 'space-x-4', 'px-6', 'py-4');
                const editButton = document.createElement('a');
                editButton.textContent = 'Edit';
                editButton.href ="/paket/edit/"+paket.ID_paket;
                editButton.classList.add('cursor-pointer','text-yellow-400','hover:text-yellow-600','px-3','py-1')
                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'Delete';
                deleteButton.classList.add('cursor-pointer', 'text-rose-600', 'hover:text-rose-800');
                deleteButton.type = 'button';
                deleteButton.onclick = function () {
                    // Define the action you want to perform when the "Delete" button is clicked
                    deleteRowAction(paket.ID_paket); // You need to implement the deleteRowAction function
                };
                cellAction.appendChild(editButton);
                cellAction.appendChild(deleteButton);
                row.appendChild(cellAction);
                tableBody.appendChild(row);
                Counter++;
            });
            

            // Create pagination buttons
            for (let i = 1; i <= apiData.data.last_page; i++) {
                const button = document.createElement('li');
                button.innerHTML = `<a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">${i}</a>`;
                paginationContainer.appendChild(button);
                button.addEventListener('click', () => fetchDataAndDisplay(i)); // Pass page number to fetchDataAndDisplay
            }

            // Update total data information
            const startData = document.getElementById('startData');
            const endData = document.getElementById('endData');
            const totalData = document.getElementById('totalData');

            startData.textContent = apiData.data.from;
            endData.textContent = apiData.data.to;
            totalData.textContent = apiData.data.total;
        } else {
            console.error('Data paket tidak valid atau tidak ditemukan');
        }
    } catch (error) {
        console.error('Error fetching data paket:', error);
    }
}

// Call the function to fetch and display data for the first page
fetchDataAndDisplay();

</script>
<script>
// Function to handle row deletion
function showAlert(title, message) {
    // Display an alert with the provided title and message
    alert(`${title}\n\n${message}`);
}
function deleteRowAction(ID_paket) {
    const confirmation = confirm("Are you sure you want to delete this row?");

    if (confirmation) {
        // Make a DELETE request to the API
        fetch(`http://${Endpoint}/api/paket/delete/${ID_paket}`, {
            method: 'DELETE',
        })
        .then(response => response.json())
        .then(data => {
            if (data && data.is_success) {
                console.log('Row deleted successfully');
                
                // Reload the page after successful deletion
                location.reload();
            } else {
                console.error('Failed to delete row');
            }
        })
        .catch(error => console.error('Error deleting row'));
        
  
    }
}

</script>
@endsection
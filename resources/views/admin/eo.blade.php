@extends('admin.layouts.main')
@section('title','Daftar EO')
@section('page_title','Event Organizer')
@section('content')

<div class="flex flex-col max-h-sm overflow-y-auto my-auto mx-auto w-10/12 p-4 bg-white border border-gray-200 overflow-y-auto space-y-4 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
<span class="text-purple-900 font-bold">
Daftar Event Organizer
</span>
<hr>
<div class="justify-between">
<a href="/create-eo">
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
                <th scope="col" class="text-center px-6 py-3">
                    No
                </th>
                <th scope="col" class="text-center px-6 py-3">
                    Email
                </th>
                <th scope="col" class="text-center px-6 py-3">
                   Nama
                </th>
                <th scope="col" class="text-center px-6 py-3">
                    Provinsi
                </th>
                <th scope="col" class="text-center px-6 py-3">
                    Kabupaten/Kota
                </th>
                <th scope="col" class="text-center px-6 py-3">
                    Type Akun
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
</div>
</div>


@endsection

@section('script')
<script>
let counterData = 0;

async function fetchAndDisplayData(apiEndpoint, page = 1) {
    try {
        
        const response = await fetch(`${apiEndpoint}?page=${page}`);
        const apiData = await response.json();
        //console.log(apiData);
        if (apiData && apiData.is_success) {
            const tableBody = document.getElementById('tableBody');
            const paginationContainer = document.getElementById('paginationContainer');
            //console.log(paginationContainer);
            // Clear existing data and pagination buttons
            let counterData = (page - 1) * apiData.data.per_page + 1;
            tableBody.innerHTML = '';
            paginationContainer.innerHTML = '';

            apiData.data.data.forEach((profile) => {
                
                const row = document.createElement('tr');

                // Create table cells and populate with data
                const idCell = document.createElement('td');
                idCell.textContent = counterData;
                idCell.classList.add('px-6', 'py-4', 'text-center');
                row.appendChild(idCell);

                const emailCell = document.createElement('td');
                emailCell.textContent = profile.email;
                emailCell.classList.add('px-6', 'py-4', 'text-center');
                row.appendChild(emailCell);

                const nameCell = document.createElement('td');
                nameCell.textContent = profile.nama_lengkap;
                nameCell.classList.add('px-6', 'py-4', 'text-center');
                row.appendChild(nameCell);

                const provinsiCell = document.createElement('td');
                provinsiCell.textContent = profile.nama_provinsi;
                provinsiCell.classList.add('px-6', 'py-4', 'text-center'); // Assuming you have the provinsi name in the API response
                row.appendChild(provinsiCell);

                const kotaCell = document.createElement('td');
                kotaCell.textContent = profile.nama_kabupaten;
                kotaCell.classList.add('px-6', 'py-4', 'text-center'); // Assuming you have the kota name in the API response
                row.appendChild(kotaCell);

                const typeCell = document.createElement('td');
                typeCell.textContent = profile.nama_paket;
                typeCell.classList.add('px-6', 'py-4', 'text-center'); // Assuming you have the kota name in the API response
                row.appendChild(typeCell);

                const cellAction = document.createElement('td');
                cellAction.classList.add('flex', 'justify-center', 'space-x-4', 'px-6', 'py-4');

                // Create Delete Button
                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'Delete';
                deleteButton.classList.add('cursor-pointer', 'text-rose-600', 'hover:text-rose-800');
                deleteButton.type = 'button';
                deleteButton.onclick = function () {
                    // Define the action you want to perform when the "Delete" button is clicked
                    deleteRowAction(profile.ID_User); // You need to implement the deleteRowAction function
                };

                cellAction.appendChild(deleteButton);
                row.appendChild(cellAction);
                // ... (add more cells as needed)

                // Append the row to the table body
                tableBody.appendChild(row);
                counterData++;
            });


            // Create pagination buttons
            for (let i = 1; i <= apiData.data.last_page; i++) {
                const button = document.createElement('li');
                button.innerHTML = `<a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">${i}</a>`;
                paginationContainer.appendChild(button);
            }

            // Update pagination buttons with click event
            const paginationButtons = document.querySelectorAll('#paginationContainer a');
            paginationButtons.forEach((button, index) => {
                button.addEventListener('click', () => fetchAndDisplayData(apiEndpoint, index + 1));
            });

            // Update total data information
            const startData = document.getElementById('startData');
            const endData = document.getElementById('endData');
            const totalData = document.getElementById('totalData');

            startData.textContent = apiData.data.from;
            endData.textContent = apiData.data.to;
            totalData.textContent = apiData.data.total;
        }
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}


function deleteRowAction(ID_user) {
    const confirmation = confirm("Are you sure you want to delete this row?");

    if (confirmation) {
        // Make a DELETE request to the API
        fetch(`http://localhost:8000/api/profile/delete/${ID_user}`, {
            method: 'DELETE',
        })
        .then(response => response.json())
        .then(data => {
            if (data && data.is_success) {
                
                fetch(`http://localhost:8000/api/profile/delete/user/${ID_user}`, {
            method: 'DELETE',
        })
        .then(response => response.json())
        .then(data => {
                // Reload the page after successful deletion
                window.location.reload();
        })
            } else {
                console.error('Failed to delete row');
            }
        })
        .catch(error => console.error('Error deleting row'));

  
    }
}
// Call the function to fetch and display data for the new API
fetchAndDisplayData("http://localhost:8000/api/profile/eo?page=1");

</script>

@endsection
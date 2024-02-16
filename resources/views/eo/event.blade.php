@extends('layouts.main')
@section('content')
<div id="alert-border-4" class="flex items-center mx-4 mt-4 p-4 mb-4 text-black border-l-4 text-yellow-900 border-yellow-300 bg-slate-50 dark:text-yellow-300 dark:bg-gray-800 dark:border-yellow-800 rounded-lg" role="alert">
    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <div class="ms-3 text-sm font-medium">
     Anda dapat membuat Event dari paket yang telah dibeli
    </div>
</div>


<div class="flex flex-col my-auto mx-auto w-10/12 p-4 bg-white border border-gray-200 overflow-y-auto space-y-4 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
<span class="text-purple-900 font-bold">
Daftar Event
</span>
<hr>
<div class="justify-between">
<button id="openModalBtn" type="button" class="max-w-sm text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-l hover:from-purple-500 hover:via-purple-600 hover:to-purple-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
<svg class="w-5 h-5 me-2 text-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
<path fill="white" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
</svg>
Add data
</button>
</div>
<div class="flex flex-col overflow-x-auto  shadow-lg  sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-purple-100 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Event
                </th>
                <th scope="col" class="px-6 py-3">
                    Mulai
                </th>
                <th scope="col" class="px-6 py-3">
                    Selesai
                </th>
                <th scope="col" class="px-6 py-3">
                    Public
                </th>
                <th scope="col" class="px-6 py-3">
                    Paket
                </th>
                <th scope="col" class="px-6 py-3 kategori"  id="columnKategori">
                        Kategori
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
</div>
</div>


<div id="myModal" class="modal hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">

    <!-- Modal content -->
    <div class="modal-content bg-white p-8 rounded-lg">
    <div class="flex flex-col space-y-2">
        <div class="flex flex-row justify-between">
        <span  class="text-2xl">Pilih Tipe Event</span>

        <button id="closeModalBtn" type="button" class="focus:outline-none text-white text-3xl bg-gradient-to-br from-violet-200 via-fuchsia-300 to-purple-300 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
        X
        </button>
        </div>
        <hr class="w-full">
        <div id="profileContainer" class="flex flex-row justify-between space-x-8 p-4 overflow-x-auto">






</div>
    </div>
    </div>

</div>
@endsection

@section('script')

<script>
let currentPage = 1; // Added currentPage variable

let IndexCounter = 1;
document.addEventListener('DOMContentLoaded', function () {
    const openModalBtn = document.getElementById('openModalBtn');
    const modal = document.getElementById('myModal');
    const closeModalBtn = document.getElementById('closeModalBtn');

    // Show the modal when the button is clicked
    openModalBtn.addEventListener('click', function () {
        modal.classList.remove('hidden');
    });

    // Close the modal when the close button is clicked
    closeModalBtn.addEventListener('click', function () {
        modal.classList.add('hidden');
    });

    // Close the modal if the user clicks outside the modal content
    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });
});


async function fetchDataAndCreateUI(page = 1) {
    const maxRetries = 3;
    const retryDelay = 1000; // 1 second delay between retries

    async function fetchWithRetry(url, options, retries = maxRetries) {
        try {
            const response = await fetch(url, options);
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            if (retries > 0) {
                console.warn(`Retrying... (${retries} attempts left)`);
                await new Promise(resolve => setTimeout(resolve, retryDelay));
                return fetchWithRetry(url, options, retries - 1);
            } else {
                console.error('Max retries exceeded. Unable to fetch data:', error);
                throw error;
            }
        }
    }

    try {
        const eventDataResponse = await fetch(`http://localhost:8000/api/event/show/eo?page=${page}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ ID_EO: id }),
        });

        const responseData = await eventDataResponse.json();

        const tableBody = document.getElementById('tableBody');
        let indexCount = (page - 1) * responseData.data.per_page + 1;
        tableBody.innerHTML = '';

        responseData.data.data.forEach((event) => {
            const row = document.createElement('tr');
            row.innerHTML = `<td class="px-6 py-4">${indexCount}</td>
                                <td class="px-6 py-4">${event.nama_event}</td>
                                <td class="px-6 py-4">${event.start}</td>
                                <td class="px-6 py-4">${event.end}</td>`;

            indexCount++;

            const public = document.createElement('td');
            public.textContent = event.public == 1 ? 'Public' : 'Private';
            public.classList.add(
                event.public == 1 ? 'text-green-600' : 'text-rose-600',
                'px-6',
                'py-4'
            );
            row.appendChild(public);

            const tipe = document.createElement('td');
            tipe.textContent = event.nama_paket;
            if (event.nama_paket !== 'Gratis') {
                tipe.classList.add('text-purple-600', 'font-bold', 'px-6', 'py-4');
            } else {
                tipe.classList.add('text-blue-700', 'font-bold', 'px-6', 'py-4');
            }
            row.appendChild(tipe);

            const kategori = document.createElement('td');
            kategori.textContent = event.nama;
            kategori.classList.add('font-bold', 'px-6', 'py-4');
            row.appendChild(kategori);

            const status = document.createElement('td');
            if (event.status == 0) {
                status.textContent = 'Selesai';
                status.classList.add('text-rose-600', 'px-6', 'py-4');
            } else if (event.status == 1) {
                status.textContent = 'Sedang Berlangsung';
                status.classList.add('text-yellow-400', 'px-6', 'py-4');
            } else {
                status.textContent = 'Akan Datang';
                status.classList.add('text-green-600', 'px-6', 'py-4');
            }
            row.appendChild(status);

            const cellAction = document.createElement('td');
            cellAction.classList.add('flex', 'justify-center', 'space-x-4', 'px-6', 'py-4');

            const detailButton = document.createElement('a');
            detailButton.textContent = 'Detail';
            detailButton.href = `/event/detail/${event.ID_event}`;
            detailButton.classList.add(
                'cursor-pointer',
                'text-sky-500',
                'hover:text-sky-700',
                'px-3',
                'py-1'
            );
            cellAction.appendChild(detailButton);

            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'Delete';
            deleteButton.classList.add(
                'cursor-pointer',
                'text-rose-600',
                'hover:text-rose-800'
            );
            deleteButton.type = 'button';
            deleteButton.onclick = function () {
                deleteRowAction(event.ID_event);
            };
            cellAction.appendChild(deleteButton);

            row.appendChild(cellAction);
            tableBody.appendChild(row);
        });

        // Pagination logic
        const paginationContainer = document.getElementById('paginationContainer');
        paginationContainer.innerHTML = '';
        for (let i = 1; i <= responseData.data.last_page; i++) {
            const button = document.createElement('li');
            button.innerHTML = `<a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">${i}</a>`;
            paginationContainer.appendChild(button);
        }

        const paginationButtons = document.querySelectorAll('#paginationContainer a');
        paginationButtons.forEach((button, index) => {
            button.addEventListener('click', () => fetchDataAndCreateUI(index + 1));
        });

        const startData = document.getElementById('startData');
        const endData = document.getElementById('endData');
        const totalData = document.getElementById('totalData');

        startData.textContent = responseData.data.from;
        endData.textContent = responseData.data.to;
        totalData.textContent = responseData.data.total;
    } catch (error) {
        console.error('Error fetching data event:', error);
    }
}

// Call fetchDataAndCreateUI with initial page value
fetchDataAndCreateUI(1);
// Function to handle row deletion
function deleteRowAction(ID_paket) {
    const confirmation = confirm("Are you sure you want to delete this row?");

    if (confirmation) {
        // Make a DELETE request to the API
        fetch(`http://localhost:8000/api/event/delete/${ID_paket}`, {
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
        .catch(error => console.error('Error deleting row:', error));
    }
}


// Fetch user profile information
fetch('http://localhost:8000/api/profile/show', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
  },
  body: JSON.stringify({ id: id }),
})
  .then(response => response.json())
  .then(profileData => {
    if (profileData.is_success) {
      // Extract account type ID from the profile data
      const accountTypeID = profileData.data.Kategori_paket;

      // Fetch all package information
      fetch('http://localhost:8000/api/paket/all')
        .then(response => response.json())
        .then(async packageData => {
          if (packageData.is_success) {
            const profileContainer = document.getElementById('profileContainer');

            // Function to create the UI for each instance
              async function createProfileUI(title, features, items) {
                const profileDiv = document.createElement('div');
                profileDiv.className = 'w-full max-w-sm mb-auto p-4 bg-white border border-gray-200 rounded-lg shadow-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700';

                // Modify anchor link based on package type
                 if (title === 'Gratis') {
                    anchorLink = '<a href="/create/free">';
                  } else {
                    anchorLink = '<a href="/create/premium">'; // Replace "YOUR_PREMIUM_LINK" with the actual link
                  }
              profileDiv.innerHTML = `
                <h5 class="mb-auto text-xl font-medium text-gray-500 dark:text-gray-400">${title}</h5>
                <ul role="list" class="space-y-7 my-12">
                  ${items.map(item => `
                    <li class="flex items-center">
                      <i class="fas ${item.icon} flex-shrink-0 w-4 h-4 text-purple-600 dark:text-purple-500"></i>
                      <span class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400 ms-3">${item.text}</span>
                    </li>
                  `).join('')}
                </ul>
                ${anchorLink}
                  <button class="relative inline-flex items-center justify-center w-full p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-300 via-purple-400 to-purple-500 group-hover:from-purple-500 group-hover:to-pink-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800">
                    <span class="relative w-full px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                      Create Event
                    </span>
                  </button>
                </a>
              `;

              profileContainer.appendChild(profileDiv);
            }

            // Loop through data and append instances to the existing container
            for (const { nama_paket, ID_fitur, harga ,ID_paket} of packageData.data) {
              const isDefault = nama_paket === 'Gratis';
               const isPremium = nama_paket === 'Premium' && accountTypeID === ID_paket;
const isBusiness = nama_paket === 'Business' && accountTypeID === ID_paket;
const isEnterprise = nama_paket === 'Enterprise' && accountTypeID === ID_paket;

              if (isDefault || isPremium || isBusiness || isEnterprise) {
                // Fetch feature information using POST method
                const featureResponse = await fetch('http://localhost:8000/api/fitur-paket/show', {
                  method: 'POST',
                  headers: {
                    'Content-Type': 'application/json',
                  },
                  body: JSON.stringify({ ID_fitur: ID_fitur }),
                });
                
                const featureData = await featureResponse.json();

                if (featureData.is_success) {
                  const features = featureData.data;
                  const items = [
                    { text: `Scan Count: ${features.scan_count}`, icon: 'fa-file-alt' },
                    { text: `File Upload Count: ${features.file_up_count}`, icon: 'fa-upload' },
                     { text: `Jumlah Peserta: ${features.guest_count}`, icon: 'fa-user' },
                     { text: `Jumlah Operator: ${features.operator_count}`, icon: 'fa-user' },
                    { text: `Sertifikat: ${features.sertif_count}`, icon: 'fa-file-alt' },
                    // Add more features as needed
                  ];

                  createProfileUI(nama_paket, features, items);
                }
              }
            }
          }
        });
    }
  });


</script>

@endsection
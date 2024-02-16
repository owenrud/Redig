@extends('admin.layouts.main')
@section('content')


<div class="flex flex-col my-auto mx-auto w-10/12 p-4 bg-white border border-gray-200 overflow-y-auto space-y-4 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
<span class="text-purple-900 font-bold">
Daftar Event
</span>
<hr>
<div>
  <!-- Kategori Dropdown -->
  <label for="kategoriDropdown">Filter by Kategori:</label>
  <select id="kategoriDropdown" >
    <option value="">All</option>
  </select>

  <!-- Paket Dropdown -->
  <label for="paketDropdown">Filter by Paket:</label>
  <select id="paketDropdown">
    <option value="">All</option>
  </select>
<button class="border border-gray-300 ml-8 bg-gray-500 text-white font-bold rounded-lg p-2" onclick="applyFilters()">Filter</button>

<button class="ml-8" onclick="resetFilters()">Reset Filters</button>

</div>
<hr>

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
                    <th scope="col" class="px-6 py-3 paket"  id="columnPaket">
                        Paket
                    </th>
                    <th scope="col" class="px-6 py-3 kategori"  id="columnKategori">
                        Kategori
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                </tr>
            </thead>
        <tbody id="tableBody">
           
        </tbody>
    </table>
    <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4 mb-4 px-8" aria-label="Table navigation">
    <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto" id="pagination-info">Loading...</span>
    <ul id="pagination" class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
      
    </ul>
</nav>

</div>
</div>


@endsection


@section('script')
<script>
let selectedKategori = '';
let selectedPaket = '';
let currentPage = 1; // Added currentPage variable
const perPage = 3; // Set perPage to match your API call
let IndexCounter = 1;
// Function to fetch data from the second API
async function fetchDataFromSecondAPI(event) {
    const response = await fetch('http://localhost:8000/api/paket/show', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ ID_paket: event.ID_paket }),
    });

    const dataShow = await response.json();

    if (dataShow && dataShow.data) {
        const item = dataShow.data;

        const tipe = document.createElement('td');
        tipe.textContent = item.nama_paket;
         tipe.setAttribute('data-id', item.ID_paket);
        if (item.nama_paket !== 'Gratis') {
            tipe.classList.add('text-purple-600', 'font-bold', 'px-6', 'py-4');
        } else {
            tipe.classList.add('text-blue-700', 'font-bold', 'px-6', 'py-4');
        }

        return tipe;
    }

    return null;
}

// Fetch API pertama untuk mendapatkan data event

// Function to fetch data from the third API
async function fetchDataFromThirdAPI(event) {
    try {
        const response = await fetch(`http://localhost:8000/api/event/detail/show`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ ID_event: event.ID_event }), // Include the necessary body
        });

        if (!response.ok) {
            console.error(`Error fetching detail data for event ${event.ID_event}. Status: ${response.status}`);
            return null;
        }

        const data = await response.json();

        if (data && data.is_success) {
            const ID_kategori = data.data.ID_kategori; // Store ID_kategori for the fourth API call
            return ID_kategori;
        } else {
            console.error('Invalid or not found detail data for event:', event.ID_event);
            return null;
        }
    } catch (error) {
        console.error('Error fetching detail data for event:', event.ID_event, error);
        return null;
    }
}

// Function to fetch data from the fourth API
async function fetchDataFromFourthAPI(ID_kategori) {
   // console.log(ID_kategori);
    try {
        const response = await fetch(`http://localhost:8000/api/event/kategori/show`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id : ID_kategori }), // Include the necessary body
        });
        const data = await response.json();
        //console.log(data);
        if (data && data.is_success) {
            const kategori = document.createElement('td');
            kategori.textContent = data.data.nama;
            kategori.setAttribute('data-id', data.id);
            kategori.classList.add('px-6', 'py-4','font-bold');
            return kategori;
        } else {
            console.error('Invalid or not found data from fourth API for ID_kategori:', ID_kategori);
            return null;
        }
    } catch (error) {
        console.error('Error fetching data from fourth API for ID_kategori:', ID_kategori, error);
        return null;
    }
}


function updatePageButtons(links) {
    const paginationElement = document.getElementById('pagination');
    paginationElement.innerHTML = '';

    // Page buttons
    links.forEach(link => {
        const pageButton = document.createElement('li');
        pageButton.innerHTML = link.active ?
            `<span class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg">${link.label}</span>` :
            `<a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white ${link.label === 'Previous' && !link.url ? 'cursor-not-allowed' : ''} ${link.label === 'Next' && !link.url ? 'cursor-not-allowed' : ''}">${link.label}</a>`;

        paginationElement.appendChild(pageButton);

        if (!link.active) {
            // Add event listener to the page button
            const pageButtonLink = pageButton.querySelector('a');
            pageButtonLink.addEventListener('click', (event) => {
                event.preventDefault(); // Prevent the default behavior of the anchor tag
                loadPage(link.label);
            });
        }
    });
}


fetch('http://localhost:8000/api/event/kategori/all')
  .then(response => response.json())
  .then(data => {
    if (data && data.is_success && Array.isArray(data.data)) {
      // Populate Kategori Dropdown
      const kategoriDropdown = document.getElementById('kategoriDropdown');
      data.data.forEach(kategori => {
        const option = document.createElement('option');
        option.value =  kategori.id; 
        option.textContent = kategori.nama;
        kategoriDropdown.appendChild(option);
      });
 } else {
      console.error('Failed to fetch data for dropdowns');
    }
  })
  .catch(error => console.error('Error fetching dropdown data:', error));
      // Populate Paket Dropdown (adjust the API endpoint and logic accordingly)
      fetch('http://localhost:8000/api/paket/all')
  .then(response => response.json())
  .then(data => {
     if (data && data.is_success && Array.isArray(data.data)) {
      const paketDropdown = document.getElementById('paketDropdown');
      data.data.forEach(paket => {
        const option = document.createElement('option');
        option.value = paket.ID_paket;
        option.textContent = paket.nama_paket;
        paketDropdown.appendChild(option);
      });
       } else {
      console.error('Failed to fetch data for dropdowns');
    }
  })
  .catch(error => console.error('Error fetching dropdown data:', error));
   
async function loadPage(pageNumber) {
    try {
        const response = await fetch(`http://localhost:8000/api/event/all?perPage=${perPage}&page=${pageNumber}`);
        const responseData = await response.json();
        IndexCounter = 1;

        if (responseData.is_success && responseData.data) {
            const totalItems = responseData.data.total;
           // console.log(responseData.data.total);
            // Update pagination information
             
            updatePaginationInfo(responseData.data.total);

            // Update page buttons
            updatePageButtons(responseData.data.links);

            // Clear existing rows in the table
            const tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = '';

            // Insert new rows based on fetched data
            const fetchPromises = responseData.data.data.map(async event => {
                const row = document.createElement('tr');

                // Insert event columns into the row using <td> elements
                row.innerHTML = `<td class="px-6 py-4">${IndexCounter}</td>
                                <td class="px-6 py-4">${event.nama_event}</td>
                                <td class="px-6 py-4">${event.start}</td>
                                <td class="px-6 py-4">${event.end}</td>`;
                IndexCounter++;

                // Insert row into the table body
                tableBody.appendChild(row);

                // Insert "Public" or "Private" column based on event.public value
                const public = document.createElement('td');
                public.textContent = event.public == 1 ? 'Public' : 'Private';
                public.classList.add(event.public == 1 ? 'text-green-600' : 'text-rose-600', 'px-6', 'py-4');
                row.appendChild(public);

                // Fetch data from the second API and store the promise in an array
                const fetchPromiseSecondAPI = fetchDataFromSecondAPI(event);

                try {
                    // Wait for the fetch promise to resolve
                    const tipe = await fetchPromiseSecondAPI;

                    if (tipe !== null) {
                        // Insert the fetched data into the row
                        row.appendChild(tipe);

                        // Fetch data from the third API
                        const fetchPromiseThirdAPI = fetchDataFromThirdAPI(event);

                        try {
                            // Wait for the fetch promise to resolve
                            const kategori = await fetchPromiseThirdAPI;

                            if (kategori !== null) {
                                // Insert the fetched data into the row

                                // Fetch data from the fourth API
                                const fetchPromiseFourthAPI = fetchDataFromFourthAPI(kategori);

                                try {
                                    // Wait for the fetch promise to resolve
                                    const fourthData = await fetchPromiseFourthAPI;

                                    if (fourthData !== null) {
                                        // Insert the fetched data into the row
                                        row.appendChild(fourthData);
                                    } else {
                                        console.error('Failed to fetch data from fourth API for ID_kategori:', kategori.ID_kategori);
                                    }
                                } catch (error) {
                                    console.error('Error during fourth API fetch:', error);
                                }
                            } else {
                                console.error('Failed to fetch data from third API for ID_event:', event.ID_event);
                            }
                        } catch (error) {
                            console.error('Error during third API fetch:', error);
                        }
                    }

                    // Insert "Selesai," "Sedang Berlangsung," or "Akan Datang" column based on event.status value
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
                } catch (error) {
                    console.error('Error during fetch from second API:', error);
                }
            });

            // After the loop is complete, use Promise.all to wait for all fetches to finish
            await Promise.all(fetchPromises);

            // All fetches are done, do whatever needs to be done afterward
            console.log('All data has been fetched and processed.');
        } else {
            console.error('Invalid or not found event data');
        }
    } catch (error) {
        console.error('Error fetching event data:', error);
    }
}
function updatePaginationInfo(totalItems) {
    const paginationInfo = document.getElementById('pagination-info');
    paginationInfo.textContent = `Showing ${currentPage}-${currentPage + perPage - 1} of ${totalItems}`;
}
loadPage(1);

   // Your existing script
function applyFilters() {
  const selectedKategori = document.getElementById('kategoriDropdown').value;
  const selectedPaket = document.getElementById('paketDropdown').value;

  // Call the filterTable function with the selected values
  filterTable(selectedKategori, selectedPaket);
}
function filterTable(kategori, paket) {
  console.log('Filtering table with Kategori:', kategori, 'and Paket:', paket);

  const rows = document.querySelectorAll('#tableBody tr');
  console.log(rows);

  rows.forEach(row => {
    const kategoriCell = row.querySelector('.kategori');
    const paketCell = row.querySelector('.paket');
    console.log(kategoriCell);
    console.log(paketCell);

    console.log('Row Kategori:', kategoriCell ? kategoriCell.getAttribute('data-id') : 'N/A');
    console.log('Row Paket:', paketCell ? paketCell.getAttribute('data-id') : 'N/A');

    const showKategori = !kategori || (kategoriCell && kategoriCell.getAttribute('data-id') === kategori);
    const showPaket = !paket || (paketCell && paketCell.getAttribute('data-id') === paket);

    console.log('Show Kategori:', showKategori);
    console.log('Show Paket:', showPaket);
    console.log('Kategori value:', kategori);
    console.log('Paket value:', paket);

    if (showKategori && showPaket) {
      row.style.display = ''; // Show the row
    } else {
      row.style.display = 'none'; // Hide the row
    }
  });
}





function resetFilters() {
  document.getElementById('kategoriDropdown').value = '';
  document.getElementById('paketDropdown').value = '';

  // Show all rows
  const rows = document.querySelectorAll('#tableBody tr');
  rows.forEach(row => {
    row.style.display = '';
  });
}

</script>

@endsection
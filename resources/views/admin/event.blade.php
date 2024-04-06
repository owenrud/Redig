@extends('admin.layouts.main')
@section('tilte','Daftar Event')
@section('page_title','Event')
@section('content')


<div class="flex flex-col my-auto mx-auto w-10/12 p-4 bg-white border border-gray-200 overflow-y-auto space-y-4 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
<span class="text-purple-900 font-bold">
Daftar Event
</span>
<hr>
{{-- <div>
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
<hr> --}}

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
let perPage = 5; // Set perPage to match your API call
let IndexCounter = 1;
// Function to fetch data from the second API
async function loadPage(pageNumber) {
    try {
        const response = await fetch(`http://${Endpoint}/api/event/all?perPage=${perPage}&page=${pageNumber}`);
        const responseData = await response.json();

        if (responseData.is_success && responseData.data) {
            const totalItems = responseData.data.total;

            // Update pagination information
            currentPage = responseData.data.from;
            perPage = responseData.data.to;
            updatePaginationInfo(currentPage,perPage,totalItems);

            // Update page buttons
            updatePageButtons(responseData.data.links);

            // Clear existing rows in the table
            const tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = '';

            // Insert new rows based on fetched data
            const events = responseData.data.data;
            IndexCounter = 1;
            events.forEach(event => {
                const row = document.createElement('tr');
               const publicClass = event.public == 1 ? 'text-green-600 font-medium' : 'text-red-600 font-medium';
                const publicText = event.public == 1 ? 'Public' : 'Private';
                const paketClass = event.nama_paket != 'Gratis' ? 'text-purple-600 font-medium' : 'text-gray-600 font-medium';
                const statusText = event.status == 0 ? 'Selesai' : (event.status == 1 ? 'Sedang Berlangsung' : 'Akan Datang');
                const statusClass = event.status == 0 ? 'text-red-600 font-medium' : 
                (event.status == 1 ? 'text-blue-600 font-medium' : 'text-green-600 font-medium');
                row.innerHTML = `<td class="px-6 py-4">${IndexCounter}</td>
                                <td class="px-6 py-4">${event.nama_event}</td>
                                <td class="px-6 py-4">${event.start}</td>
                                <td class="px-6 py-4">${event.end}</td>
                                <td class="px-6 py-4 ${publicClass}">${publicText}</td>
                                <td class="px-6 py-4 ${paketClass}">${event.nama_paket}</td>
                                <td class="px-6 py-4 font-medium">${event.nama_kategori}</td>
                                <td class="px-6 py-4 ${statusClass}">${statusText}</td>`;
                IndexCounter++;

                // Insert the row into the table body
                tableBody.appendChild(row);
            });

            console.log('All data has been fetched and processed.');
        } else {
            console.error('Invalid or not found event data');
        }
    } catch (error) {
        console.error('Error fetching event data:', error);
    }
}

function updatePaginationInfo(currentPage,perPage,totalItems) {
   const startItem = currentPage;
    const endItem =perPage;
    const paginationInfo = document.getElementById('pagination-info');
    paginationInfo.textContent = `Showing ${startItem}-${endItem} of ${totalItems}`;

}
loadPage(1);
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
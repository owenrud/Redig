@extends('admin.layouts.main')
@section('content')

<div class="flex flex-col max-h-sm overflow-y-auto my-auto mx-auto w-10/12 p-4 bg-white border border-gray-200 overflow-y-auto space-y-4 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
<span class="text-purple-900 font-bold">
Daftar Fitur Paket
</span>
<hr>
<div class="justify-between">
<a href="/create-fitur-paket">
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
                   Jumlah Scan
                </th>
                <th scope="col" class="px-6 py-3">
                    Jumlah File Upload
                </th>
                <th scope="col" class="px-6 py-3">
                    Jumlah Tamu
                </th>
                <th scope="col" class="px-6 py-3">
                    Jumlah Operator
                </th>
                <th scope="col" class="px-6 py-3">
                    Jumlah Sertifikat
                </th>
                <th scope="col" class="px-6 py-3">
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

 // Fetch API pertama untuk mendapatkan data paket
 let Count = 1;
fetch('http://localhost:8000/api/fitur-paket/all')
    .then(response => response.json())
    .then(data => {
        // Pastikan respons memiliki properti "data" dan "data" adalah array
        if (data && data.is_success && Array.isArray(data.data)) {
            // Ambil elemen tabel atau tempat Anda ingin menyisipkan data
            const tableBody = document.getElementById('tableBody'); // Ganti dengan ID yang sesuai

            // Loop melalui setiap item dalam data paket
            data.data.forEach(paket => {
                const row = document.createElement('tr');

                // Sisipkan kolom paket ke dalam baris menggunakan elemen <td>
                row.innerHTML = `<td class="px-6 py-4">${Count}</td>
                                  <td class="px-6 py-4">${paket.scan_count}</td>
                                  <td class="px-6 py-4">${paket.file_up_count}</td>
                                  <td class="px-6 py-4">${paket.guest_count}</td>
                                 <td class="px-6 py-4">${paket.operator_count}</td>
                                  <td class="px-6 py-4">${paket.sertif_count}</td>
                                  `;
                Count++;
                // Sisipkan baris ke dalam elemen tbody
                tableBody.appendChild(row);
                  const cellAction = document.createElement('td');
                            cellAction.classList.add('flex', 'justify-center', 'space-x-4', 'px-6', 'py-4');

                            // Create Edit Button
                            const editButton = document.createElement('a');
                            editButton.textContent = 'Edit';
                            editButton.href = `/fitur-paket/edit/${paket.ID_fitur}`;  // Gantilah dengan URL yang sesuai jika Anda ingin mengarahkan ke halaman tertentu
                            editButton.classList.add('cursor-pointer', 'text-yellow-400', 'hover:text-yellow-600', 'inline-block', 'px-3', 'py-1');


                            // Create Delete Button
                            const deleteButton = document.createElement('button');
                            deleteButton.textContent = 'Delete';
                            deleteButton.classList.add('cursor-pointer', 'text-rose-600', 'hover:text-rose-800');
                            deleteButton.type = 'button';
                            deleteButton.onclick = function() {
                                // Define the action you want to perform when the "Delete" button is clicked
                                deleteRowAction(paket.ID_fitur); // You need to implement the deleteRowAction function
                            };

                            // Append buttons to the cellAction
                            cellAction.appendChild(editButton);
                            cellAction.appendChild(deleteButton);

                row.appendChild(cellAction);

                // Fetch API kedua untuk mendapatkan data sesuai dengan ID_fitur
               
        })
    }
    });
</script>
<script>
// Function to handle row deletion
function deleteRowAction(ID_paket) {
    const confirmation = confirm("Are you sure you want to delete this row?");

    if (confirmation) {
        // Make a DELETE request to the API
        fetch(`http://localhost:8000/api/fitur-paket/delete/${ID_paket}`, {
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

</script>
@endsection
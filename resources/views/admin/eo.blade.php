@extends('admin.layouts.main')
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
async function fetchDataAndCreateTable() {
    try {
        const api = "http://localhost:8000/api/profile/all";
        const response = await fetch(api);
        const apiData = await response.json();

        if (apiData && apiData.is_success) {
            const tableBody = document.getElementById('tableBody');

            // Use Promise.all to fetch data from the second API for each user in parallel
            await Promise.all(apiData.data.map(async (user) => {
                const row = document.createElement('tr');

                // Kolom "Nomor" dan "Email" dari fetch API pertama
                const nomor = document.createElement('td');
                nomor.textContent = user.ID_User;
                nomor.classList.add('text-center', 'px-6', 'py-4');
                row.appendChild(nomor);

                const email = document.createElement('td');
                email.textContent = user.email;
                email.classList.add('text-center', 'px-6', 'py-4');
                row.appendChild(email);

                // Fetch API kedua
                const secondApiResponse = await fetch("http://localhost:8000/api/profile/show", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ id: user.ID_User }),
                });

                const dataShow = await secondApiResponse.json();

                if (dataShow.is_success) {
                    const item = dataShow.data;

                    // Kolom "Nama", "Provinsi", dan "Kabupaten" dari fetch API kedua
                    const nama = document.createElement('td');
                    nama.textContent = item.nama_lengkap;
                    nama.classList.add('text-center', 'px-6', 'py-4');
                    row.appendChild(nama);

                    const provinsiApiResponse = await fetch("http://localhost:8000/api/provinsi/show", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ id: item.provinsi }),
                    });

                    const provinsiData = await provinsiApiResponse.json();
                    const dataprov = provinsiData.data;
                    const provinsi = document.createElement('td');
                    provinsi.textContent = dataprov.nama;
                    provinsi.classList.add('text-center', 'px-6', 'py-4');
                    row.appendChild(provinsi);

                    const kabupatenApiResponse = await fetch("http://localhost:8000/api/kabupaten/show/id", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ id: item.kota }),
                    });

                    const kabData = await kabupatenApiResponse.json();
                    const data = kabData.data;
                    const kota = document.createElement('td');
                    kota.textContent = data.nama;
                    kota.classList.add('text-center', 'px-6', 'py-4');
                    row.appendChild(kota);

                    // Fetch API ketiga
                    const paketApiResponse = await fetch("http://localhost:8000/api/paket/show", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ ID_paket: item.Kategori_paket }),
                    });

                    const dataPaket = await paketApiResponse.json();
                    const paket = dataPaket.data;

                    // Kolom "Type" (Nama_paket) dari fetch API ketiga
                    const nama_paket = document.createElement('td');
                    nama_paket.textContent = paket.nama_paket;
                    nama_paket.classList.add('text-center', 'px-6', 'py-4');

                    const cellAction = document.createElement('td');
                    cellAction.classList.add('flex', 'justify-center', 'space-x-4', 'px-6', 'py-4');

                    // Create Delete Button
                    const deleteButton = document.createElement('button');
                    deleteButton.textContent = 'Delete';
                    deleteButton.classList.add('cursor-pointer', 'text-rose-600', 'hover:text-rose-800');
                    deleteButton.type = 'button';
                    deleteButton.onclick = function () {
                        // Define the action you want to perform when the "Delete" button is clicked
                        deleteRowAction(user.ID_User); // You need to implement the deleteRowAction function
                    };

                    // Append buttons to the cellAction
                    cellAction.appendChild(deleteButton);

                    row.appendChild(nama_paket);
                    row.appendChild(cellAction);

                    // Tambahkan baris ke dalam tabel
                    tableBody.appendChild(row);
                }
            }));
        }
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

// Call the async function to fetch and populate data
fetchDataAndCreateTable();
</script>

<script>
function deleteRowAction(userID) {
    // Konfirmasi pengguna
    const isConfirmed = confirm('Are you sure you want to delete this user?');

    if (isConfirmed) {
        // Hapus data dari endpoint /api/profile/delete/{id}
        fetch(`http://localhost:8000/api/profile/delete/${userID}`, {
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
            return fetch(`http://localhost:8000/api/profile/delete/user/${userID}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                },
            });
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            // Hapus baris dari tabel atau lakukan tindakan lain setelah berhasil menghapus
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
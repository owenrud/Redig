@extends('admin.layouts.main')
@section('content')
<div class="flex flex-col p-8">
<div class="w-full  space-y-4 mb-auto  bg-white border border-gray-200 rounded-lg shadow-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
<span class="text-purple-900 font-bold text-xl mb-4">Create Kategori Paket</span>
<form >
@csrf
<div class="mb-6">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kategori</label>
    <input id="nama_kategori" name="nama" type="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>

<button onclick="postKategori(event)" type="submit" class="max-w-lg text-white bg-gradient-to-br from-purple-600 to-fuchsia-400 hover:bg-gradient-to-bl hover:from-purple-600 hover:to-fuchsia-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">

Save
</button>


</form>
</div>
</div>

@endsection

@section('script')
<script>
// Dapatkan path dari URL
const path = window.location.pathname;

// Tentukan pola ekspresi reguler untuk mengekstrak ID dari path
const regex = /\/event\/kategori\/edit\/(\d+)/;

// Cocokkan pola dengan path
const match = path.match(regex);

// Ambil ID dari hasil pencocokan (jika ada)
const idKategori = match ? match[1] : null;

//console.log(idKategori);

if (idKategori) {
    // Tentukan URL API
    const apiUrl = 'http://localhost:8000/api/event/kategori/show';

    // Persiapkan data yang akan dikirim
    const data = { id : idKategori };

    // Buat konfigurasi untuk fetch
    const fetchConfig = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    };

    // Lakukan fetch ke API
    fetch(apiUrl, fetchConfig)
        .then(response => response.json())
        .then(apiData => {
            // Lakukan sesuatu dengan data yang diterima dari API
            //console.log(apiData);
            const namaKategoriInput = document.getElementById('nama_kategori');
              
                if (namaKategoriInput) {
                    namaKategoriInput.value = apiData.data.nama;
                }
        })
        .catch(error => console.error('Error fetching data from API:', error));
} else {
    console.error('ID not found in URL');
}
</script>
<script>
    function postKategori(event) {
    event.preventDefault();  // Mencegah tindakan default formulir

    const form = document.querySelector('form');
    const formData = new FormData(form);
     const path = window.location.pathname;
    const regex = /\/event\/kategori\/edit\/(\d+)/;
    const match = path.match(regex);
    const idKategori = match ? match[1] : null;
    formData.append('id' ,idKategori);
    fetch('http://localhost:8000/api/event/kategori/update', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.is_success) {
            // Redirect to /admin if successful
            window.location.href = '/kategori-event';
        } else {
            // Handle the case where save failed
            console.error('Failed to save data:', data.message);
            // You can display an error message to the user or take other actions
        }
    })
    .catch(error => console.error('Error during fetch:', error));
}

// Menambahkan event listener ke formulir untuk mendengarkan peristiwa pengiriman
const form = document.querySelector('form');
form.addEventListener('submit', postKategori);
</script>

@endsection
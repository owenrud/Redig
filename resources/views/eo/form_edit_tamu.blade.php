@extends('layouts.main')
@section('content')
<div class="w-full mx-auto my-auto overflow-y-auto  px-4 space-y-8 bg-white border border-gray-200 rounded-lg shadow-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
<span class="text-purple-800 font-bold text-xl">Edit Tamu</span>
<form id="EditTamu">
<div class="mb-6">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
    <input id="nama" name="nama" type="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>
<div class="mb-6">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
    <input id="email" name="email" type="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>

<div class="mb-6">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
    <input id="gender" name="gender" type="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>
<div class="mb-6">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
    <input id="type" name="type" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>
<div class="mb-6">
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Instansi</label>
    <input id="instansi" name="instansi" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>
<div class="mb-6">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Ruang</label>
    <input id="nama_ruang" name="nama_ruang" type="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>
<div class="mb-6">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No Meja</label>
    <input id="no_meja" name="no_meja" type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>


<button onclick="UpdateTamu(event)" type="submit" class="max-w-lg text-white bg-gradient-to-br from-purple-600 to-fuchsia-400 hover:bg-gradient-to-bl hover:from-purple-600 hover:to-fuchsia-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">

Save
</button>

</form>
</div>

</div>
</div>
</div>
@endsection

@section('script')
<script>
const tamuId = window.location.pathname.split('/').pop();
//console.log(tamuId);

if (tamuId) {
    // Tentukan URL API
    const apiUrl = 'http://localhost:8000/api/peserta/show/guest';

    // Persiapkan data yang akan dikirim
    const data = { id : tamuId };

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
            console.log(apiData);
            document.getElementById('nama').value = apiData.data.nama;
             document.getElementById('email').value = apiData.data.email;
             document.getElementById('gender').value = apiData.data.gender;
             document.getElementById('type').value = apiData.data.type;
             document.getElementById('instansi').value = apiData.data.instansi;
             document.getElementById('no_meja').value = apiData.data.no_meja;
             document.getElementById('nama_ruang').value = apiData.data.nama_ruang;
            

        })
        .catch(error => console.error('Error fetching data from API:', error));
} else {
    console.error ('ID not found in URL');
}
</script>
<script>

const eventId = window.location.pathname.split('/')[3];
    function UpdateTamu(event) {
    event.preventDefault();  // Mencegah tindakan default formulir

    const form = document.getElementById('EditTamu');
    const formData = new FormData(form);
    formData.append('id',tamuId)

    fetch('http://localhost:8000/api/peserta/update', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.is_success) {
            // Redirect to /admin if successful
           window.location.href =`/event/detail/${eventId}`;
        } else {
            // Handle the case where save failed
            console.error('Failed to save data:', data.message);
            // You can display an error message to the user or take other actions
        }
    })
    .catch(error => console.error('Error during fetch:', error));
}

// Menambahkan event listener ke formulir untuk mendengarkan peristiwa pengiriman
document.addEventListener('DOMContentLoaded', function() {
const form = document.getElementById('EditTamu');
form.addEventListener('submit', UpdateTamu);
});
</script>

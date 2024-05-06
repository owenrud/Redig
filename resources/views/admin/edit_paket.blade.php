@extends('admin.layouts.main')
@section('title','update paket')
@section('page_title','Update Paket')
@section('content')

<div class="flex flex-col p-8">
<div class="w-full  space-y-4 mb-auto  bg-white border border-gray-200 rounded-lg shadow-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
<span class="text-purple-900 font-bold text-xl mb-4">Update Paket</span>
<form >
@csrf
<div class="mb-6">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Paket</label>
    <input id="nama" name="nama_paket" type="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>
<div class="mb-6">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
    <input id="harga" name="harga" type="number"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>

<div class="mb-6">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Scan Count</label>
    <input id="ScanCount" name="ScanCount" type="number"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>
<div class="mb-6">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">File Upload Count</label>
    <input id="FileUpCount" name="FileUpCount" type="number"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>
<div class="mb-6">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Guest Count</label>
    <input id="GuestCount" name="GuestCount" type="number"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>
<div class="mb-6">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Operator Count</label>
    <input id="OperatorCount" name="OperatorCount" type="number"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>
<div class="mb-6">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Certificate Count</label>
    <input id="SertifCount" name="SertifCount" type="number"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>
<div class="mb-6">
<label class="inline-flex items-center cursor-pointer">
  <input id="status" type="checkbox" name="status" value="" class="sr-only peer" checked>
  <div class="relative w-11 h-6 bg-red-600 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"></div>
  <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Status</span>
</label>
</div>
<button onclick="updatePaket(event)" type="submit" class="max-w-lg text-white bg-gradient-to-br from-purple-600 to-fuchsia-400 hover:bg-gradient-to-bl hover:from-purple-600 hover:to-fuchsia-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">

Save
</button>


</form>
</div>
</div>

@endsection

@section('script')
<script>
// Dapatkan path dari URL
const idPaket = window.location.pathname.split('/').pop();

//console.log(idPaket);


if (idPaket) {
    // Tentukan URL API
    const apiUrl = `http://${Endpoint}/api/paket/show`;

    // Persiapkan data yang akan dikirim
    const data = { ID_paket : idPaket };

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
            document.getElementById('nama').value = apiData.data.nama_paket;
            document.getElementById('harga').value =apiData.data.harga;
            document.getElementById('ScanCount').value = apiData.data.ScanCount;
            document.getElementById('FileUpCount').value = apiData.data.FileUpCount;
            document.getElementById('GuestCount').value =apiData.data.GuestCount;
            document.getElementById('OperatorCount').value = apiData.data.OperatorCount;   
            document.getElementById('SertifCount').value = apiData.data.SertifCount;
           if (apiData.data.status === 1) {
                document.getElementById('status').value = 1; // Set nilai menjadi 1
                document.getElementById('status').checked = true; // Set input toggle menjadi tercentang
            } else {
                document.getElementById('status').value = 0; // Set nilai menjadi 0 atau sesuai kebutuhan Anda
                document.getElementById('status').checked = false; // Set input toggle menjadi tidak tercentang
            }

        })
        .catch(error => console.error('Error fetching data from API:', error));
} else {
    console.error('ID not found in URL');
}



</script>

<script>
    function updatePaket(event) {
    event.preventDefault();  // Mencegah tindakan default formulir

    const form = document.querySelector('form');
    const formData = new FormData(form);
    const toggle = document.getElementById('status');
    const togglevalue = toggle.checked ? 1 : 0;
    console.log(togglevalue);
    // Pastikan ID ditemukan sebelum membuat permintaan fetch
    if (idPaket) {
       
        // Tambahkan ID ke dalam FormData
        formData.append('ID_paket', idPaket);
        formData.append('status',togglevalue);
       
        fetch(`http://${Endpoint}/api/paket/update`, {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.is_success) {
                // Redirect to /paket if successful
                window.location.href = '/admin/paket';
            } else {
                // Handle the case where update failed
                console.error('Failed to update data:', data.message);
                // You can display an error message to the user or take other actions
            }
        })
        .catch(error => console.error('Error during fetch:', error));
    } else {
        console.error('ID not found in URL');
    }
}

// Menambahkan event listener ke formulir untuk mendengarkan peristiwa pengiriman
const form = document.querySelector('form');
form.addEventListener('submit', updatePaket);
</script>


@endsection
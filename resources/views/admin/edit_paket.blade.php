@extends('admin.layouts.main')
@section('content')

<div class="flex flex-col p-8">
<div class="w-full  space-y-4 mb-auto  bg-white border border-gray-200 rounded-lg shadow-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
<span class="text-purple-900 font-bold text-xl mb-4">Update Paket</span>
<form >
@csrf
<div class="mb-6">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Paket</label>
    <input name="nama_paket" type="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>
<div class="mb-6">
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fitur</label>
    <select name="ID_fitur" id="fitur" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    
    </select>
</div>
<div class="mb-6">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
    <input name="harga" type="number"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>
<button onclick="updatePaket()" type="submit" class="max-w-lg text-white bg-gradient-to-br from-purple-600 to-fuchsia-400 hover:bg-gradient-to-bl hover:from-purple-600 hover:to-fuchsia-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">

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
const regex = /\/paket\/edit\/(\d+)/;

// Cocokkan pola dengan path
const match = path.match(regex);

// Ambil ID dari hasil pencocokan (jika ada)
const idPaket = match ? match[1] : null;

//console.log(idPaket);

if (idPaket) {
    // Tentukan URL API
    const apiUrl = 'http://localhost:8000/api/paket/show';

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
            const namaPaketInput = document.querySelector('input[name="nama_paket"]');
                const fiturSelect = document.getElementById('fitur');

                if (namaPaketInput) {
                    namaPaketInput.value = apiData.data.nama_paket;
                }
                if (fiturSelect) {
                     fiturSelect.value = apiData.data.ID_fitur;
                }
        })
        .catch(error => console.error('Error fetching data from API:', error));
} else {
    console.error('ID not found in URL');
}
</script>
<script>
const fitur = document.getElementById('fitur');

fetch('http://localhost:8000/api/fitur-paket/all')
.then(response => response.json())
.then(data =>{
    data.data.forEach(item =>{
        const option = document.createElement('option');
        option.value = item.ID_fitur;
        option.text = item.ID_fitur;
        fitur.appendChild(option);
    })
});
</script>
<script>
    function updatePaket(event) {
    event.preventDefault();  // Mencegah tindakan default formulir

    const form = document.querySelector('form');
    const formData = new FormData(form);

    // Ambil ID dari URL
    const path = window.location.pathname;
    const regex = /\/paket\/edit\/(\d+)/;
    const match = path.match(regex);
    const idPaket = match ? match[1] : null;

    // Pastikan ID ditemukan sebelum membuat permintaan fetch
    if (idPaket) {
        // Tambahkan ID ke dalam FormData
        formData.append('ID_paket', idPaket);

        fetch('http://localhost:8000/api/paket/update', {
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
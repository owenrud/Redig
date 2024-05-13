@extends('layouts.main')
@section('title','Edit Peserta')
@section('page_title','Edit Tamu')
@section('content')
<div class="w-full mx-auto my-auto overflow-y-auto  px-4 space-y-8 bg-white border border-gray-200 rounded-lg shadow-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">

<form id="EditTamu">
<div class="mb-6">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama <span class="text-red-500">*</span></label>
    <input id="nama" name="nama" type="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>
<div class="mb-6">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email <span class="text-red-500">*</span></label>
    <input id="email" name="email" type="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>

<div class="mb-6">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender <span class="text-red-500">*</span></label>
    <select id="gender" name="gender"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <option value ="P">Perempuan</option>
    <option value="L">Laki-laki</option>
    </select>
</div>
<div class="mb-6">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type <span class="text-red-500">*</span></label>
    <select id="type" name="type"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <option value="normal">Normal</option>
    <option value="VIP">VIP</option>
    <option value ="VVIP">VVIP</option>
    </select>
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

<div class="mb-6">
<label id="premiumInput" class="hidden relative inline-flex items-center mb-5 cursor-pointer">
  <input id="toggleStatus" name="payment_status" type="checkbox" class="sr-only peer">
  <div class="w-11 h-6 bg-red-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-violet-300 dark:peer-focus:ring-violet-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-700"></div>
  <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Payment Status</span>
</label>
<p class="mb-4 text-xs font-light">Keterangan : Merah = Belum membayar , Biru = Sudah membayar</p>

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
const UrlID = window.location.pathname.split('/')[3];
const EndPoint = "localhost:8000";
//console.log("Test URL"+ UrlID);
async function fetchEventData(){
    const APIURL = `http://${EndPoint}/api/event/show`;
    const response = await fetch(APIURL,{
        method: "POST",
        headers :{
            'Content-Type' : 'application/json'
        },
        body : JSON.stringify({
            ID_event : UrlID
        })
    })

    const responseData = await response.json();
    const EventData = responseData.data; // No need for "let" here

    return EventData;
}

async function CheckPremium() { 
    try {
        const EventData = await fetchEventData();
        const check = EventData[0].nama_paket.toLowerCase();
        if(check !== 'gratis'){
            document.getElementById('premiumInput').classList.remove('hidden')
        }
        
        // Return true if the package is not "gratis", false otherwise
        return check !== 'gratis';
    } catch (error) {
        console.error('Error checking premium:', error);
        // If there's an error, default to assuming it's not premium and return true
        return true;
    }
}
fetchEventData();
CheckPremium();
</script>
<script>
const tamuId = window.location.pathname.split('/').pop();


   async function fetchDataFromApi() {
    // Tentukan URL API
    const apiUrl = `http://${EndPoint}/api/peserta/me`;

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

    try {
        // Lakukan fetch ke API
        const response = await fetch(apiUrl, fetchConfig);
        if (!response.ok) {
            throw new Error('Failed to fetch data from API');
        }

        // Parse JSON response
        const apiData = await response.json();

        // Lakukan sesuatu dengan data yang diterima dari API
        console.log(apiData);
        document.getElementById('nama').value = apiData.data.nama;
        document.getElementById('email').value = apiData.data.email;
        document.getElementById('toggleStatus').checked = apiData.data.payment_status == 1 ? "true" :"";
        // Set selected value for 'gender' select
        const genderSelect = document.getElementById('gender');
        const genderOptions = genderSelect.options;
        for (let i = 0; i < genderOptions.length; i++) {
            if (genderOptions[i].value.toLowerCase() === apiData.data.gender.toLowerCase()) {
                genderOptions[i].selected = true;
                break;
            }
        }

        // Set selected value for 'type' select
        const typeSelect = document.getElementById('type');
        const typeOptions = typeSelect.options;
        for (let i = 0; i < typeOptions.length; i++) {
            if (typeOptions[i].value.toLowerCase() === apiData.data.type.toLowerCase()) {
                typeOptions[i].selected = true;
                break;
            }
        }

        document.getElementById('instansi').value = apiData.data.instansi;
        document.getElementById('no_meja').value = apiData.data.no_meja;
        document.getElementById('nama_ruang').value = apiData.data.nama_ruang;
    } catch (error) {
        console.error('Error fetching data from API:', error);
    }
}

// Call the async function
fetchDataFromApi();
</script>
<script>

const eventId = window.location.pathname.split('/')[3];
    async function UpdateTamu(event) {
    event.preventDefault();  // Mencegah tindakan default formulir
    const isPremium = await CheckPremium();
    
    
    const form = document.getElementById('EditTamu');
    const formData = new FormData(form);
    if(isPremium){const checkbox = document.getElementById('toggleStatus');
    const checkboxValue = checkbox.checked ? 1 : 0;
    formData.append('payment_status',checkboxValue);
    }
    formData.append('id',tamuId)

    fetch(`http://${EndPoint}/api/peserta/update`, {
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

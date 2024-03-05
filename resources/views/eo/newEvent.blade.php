@extends('layouts.main')
@section('title','Create Event')
@section('page_title','Buat Event Baru (Berbayar)')
@section('content')

<div class="flex-1 flex-col justify-center items-center p-8 w-full overflow-x-auto">
<form class="p-8 border-t-8 border-violet-300 shadow-md rounded-lg shadow-fuchsia-600/25">
<span>
<input id="Paket" name="ID_paket" type="hidden">
<input type="hidden" name="latitude" id="latitude">
<input type="hidden" name="longitude" id="longitude">

<input id="ID_EO" name="ID_EO" value={{$authUser->ID_User}} type="hidden">
<input name="status" value="2" type="hidden">
<label class="relative inline-flex items-center mb-5 cursor-pointer">
  <input id="public" name="public" type="checkbox" value="" class="sr-only peer">
  <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-violet-300 dark:peer-focus:ring-violet-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-700"></div>
  <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Public</span>
</label>
<p class="mb-4 text-xs">Event anda dapat dicari oleh pengguna aplikasi</p>
</span>

  <div class="relative z-0 w-full mb-6 group">
      <input type="text" name="nama_event" id="nama_event" class="block py-2.5 px-0 w-full text-sm text-fuchsia-500 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700 peer" placeholder=" " required />
      <label for="nama_event" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-purple-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
      Nama Event
      </label>
  </div>

  <div class="relative z-0 w-full mb-6 group">
      <input type="text" name="desc_event" id="deskripsi" class="block py-2.5 px-0 w-full text-sm text-fuchsia-500 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700 peer" placeholder=" " required />
      <label for="deskripsi" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:dark:text-purple-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Deskripsi Event</label>
  </div>

   <div class="relative z-0 w-full mb-6 group">
      <input type="text" name="alamat" id="alamat" class="block py-2.5 px-0 w-full text-sm text-fuchsia-500 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700 peer" placeholder=" " required />
      <label for="alamat" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:dark:text-purple-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Alamat</label>
  </div>
  
  <label class="font-bold">Tanggal & Waktu Event</label>
<div class="flex flex-row items-center my-4">
  <div class="relative">
    <input name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-violet-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tanggal Mulai">
  </div>
  <span class="mx-4 text-gray-500">to</span>
  <div class="relative">
    <input name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tanggal Berakhir">
  </div>
</div>


<div class="my-8">

<label for="kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
<select id="kategori" name="kategori" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
 
</select>

</div>

 

  <div class="my-8">

<label for="provinsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi</label>
<select id="provinsi" name="provinsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</select>

</div>

<div class="my-8">

<label for="kabupaten" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kabupaten</label>
<select id="kabupaten" name="kabupaten" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</select>

</div>
<div class="my-8">
<label>Pin Lokasi</label>

<div id="map" style="height: 300px;"> <div id="search-form" class="absolute top-4 right-4 z-1000"></div>
</div>
  
  <button onclick="postEvent(event)" type="submit" class="text-white bg-gradient-to-br from-purple-600 to-fuchsia-400 
  hover:bg-gradient-to-bl :hover:from-fuchsia-400 group:hover:to-purple-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-purple-800">Create</button>
</form>
</div>
@endsection

@section('script')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
   document.addEventListener('DOMContentLoaded', function () {
    // Initialize Flatpickr for the 'start' input
    // Initialize Flatpickr for the 'start' input
       // Initialize Flatpickr for the 'start' input
const startDatePicker = flatpickr('input[name="start"]', {
  dateFormat: 'Y-m-d H:i',
  enableTime: true,
});

// Initialize Flatpickr for the 'end' input
const endDatePicker = flatpickr('input[name="end"]', {
  dateFormat: 'Y-m-d H:i',
  enableTime: true,
});

// Set the minDate for 'end' after selecting date & time in 'start'
startDatePicker.config.onChange.push(function(selectedDates, dateStr, instance) {
  endDatePicker.set('minDate', dateStr);
});
  });
</script>
<script>

  const provinsiSelect = document.getElementById('provinsi');
  const kabupatenSelect = document.getElementById('kabupaten');
const KategoriSelect = document.getElementById('kategori');
const IDPaket = document.getElementById('Paket');

fetch('http://127.0.0.1:8000/api/profile/show',{
    method : 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body : JSON.stringify({id : id})
})
      .then(response => response.json())
      .then(Profile => {
        const data = Profile.data;
        IDPaket.value = data.Kategori_paket;
       // console.log(IDPaket.value);
      });
  // Fungsi untuk mengisi pilihan provinsi dari API

  function populateKategori() {
    fetch('http://127.0.0.1:8000/api/event/kategori/all')
      .then(response => response.json())
      .then(jsonData => {
        const data = jsonData.data;
        //console.log(data);
         KategoriSelect.innerHTML = '';

      // Add a default option
      const defaultOption = document.createElement('option');
      defaultOption.value = '';
      defaultOption.text = 'Pilih Kategori';
      KategoriSelect.appendChild(defaultOption);

      // Loop through the data and add options to the <select>
      data.forEach(item => {
        const option = document.createElement('option');
        option.value = item.id;
        option.text = item.nama;
        KategoriSelect.appendChild(option);
      });
      })
      .catch(error => {
        console.error('Terjadi kesalahan:', error);
      });
  }
  function populateProvinsi() {
    fetch('http://127.0.0.1:8000/api/provinsi/all')
      .then(response => response.json())
      .then(jsonData => {
        const data = jsonData.data;
        //console.log(data);
         provinsiSelect.innerHTML = '';

      // Add a default option
      const defaultOption = document.createElement('option');
      defaultOption.value = '';
      defaultOption.text = 'Pilih Provinsi';
      provinsiSelect.appendChild(defaultOption);

      // Loop through the data and add options to the <select>
      data.forEach(item => {
        const option = document.createElement('option');
        option.value = item.ID_provinsi;
        option.text = item.nama;
        provinsiSelect.appendChild(option);
      });
      })
      .catch(error => {
        console.error('Terjadi kesalahan:', error);
      });
  }

  // Fungsi untuk mengisi pilihan kabupaten berdasarkan id provinsi yang dipilih
  function populateKabupaten(provinsiId) {
    fetch('http://127.0.0.1:8000/api/kabupaten/show',{
          method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ id_provinsi: provinsiId }),

    })
      .then(response => response.json())
      .then(jsondata => {
        const datakab = jsondata.data;
        // Bersihkan pilihan sebelumnya
        kabupatenSelect.innerHTML = '';

        // Tambahkan pilihan default
        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.text = 'Pilih Kabupaten';
        kabupatenSelect.appendChild(defaultOption);

        // Loop melalui data dari API dan tambahkan pilihan ke elemen <select>
        datakab.forEach(item => {
          const option = document.createElement('option');
          option.value = item.id;
          option.text = item.nama;
          kabupatenSelect.appendChild(option);
        });
      })
      .catch(error => {
        console.error('Terjadi kesalahan:', error);
      });
  }

  // Mendengarkan perubahan pada pilihan provinsi
  provinsiSelect.addEventListener('change', () => {
    const selectedProvinsiId = provinsiSelect.value;

    // Periksa apakah provinsi yang dipilih tidak kosong
    if (selectedProvinsiId) {
      // Panggil fungsi untuk mengisi pilihan kabupaten
      populateKabupaten(selectedProvinsiId);
    } else {
      // Jika provinsi yang dipilih kosong, bersihkan pilihan kabupaten
      kabupatenSelect.innerHTML = '';
    }
  });

  // Panggil fungsi untuk mengisi pilihan provinsi saat halaman dimuat
  populateProvinsi();
    populateKategori();
</script>
<script>

    function postEvent(event) {
    event.preventDefault();  // Mencegah tindakan default formulir
const checkbox = document.getElementById('public');

// Convert the checked state to 0 or 1
const checkboxValue = checkbox.checked ? 1 : 0;

//console.log(checkboxValue);
    const form = document.querySelector('form');
    const formData = new FormData(form);
    //console.log(formData);
    formData.append('public',checkboxValue);

    fetch('http://localhost:8000/api/event/save', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.is_success) {
            const ID_event = data.data.ID_event;
            const alamat =formData.get('alamat');
            const provinsi =formData.get('provinsi') ;
            const kategori =formData.get('kategori');
            const kabupaten =formData.get('kabupaten');
            const latitude = formData.get('latitude');
            const longitude = formData.get('longitude');

            const secondApiData ={
                ID_event: ID_event,
                ID_kategori : kategori,
                alamat : alamat,
                ID_provinsi : provinsi,
                ID_kabupaten :kabupaten,
                latitude :latitude,
                longitude:longitude
            };
           // return console.log(secondApiData);
            fetch('http://localhost:8000/api/event/detail/save',{
              method:'POST',
              headers: {
              'Content-Type': 'application/json',
              },
              body : JSON.stringify(secondApiData),
            })
             .then(response => response.json())
            .then(data => {
               if (data.is_success) {
            window.location.href = '/event';
               }
            })
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
form.addEventListener('submit', postEvent);
</script>
<script>
 function initMap() {
    var map = L.map('map').setView([0, 0], 2);
    var marker = null; // Inisialisasi marker menjadi null

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var geocoder = L.Control.geocoder({
      defaultMarkGeocode: false
    })
      .on('markgeocode', function (e) {
        var latlng = e.geocode.center;
        map.flyTo(latlng, 15);
      })
      .addTo(map);

    var searchForm = document.getElementById('search-form');
    searchForm.appendChild(geocoder.getContainer());

    // Tambahkan event listener untuk menangani klik pada peta
    map.on('click', function (event) {
      var latitude = event.latlng.lat;
      var longitude = event.latlng.lng;

      // Hapus pin sebelumnya jika ada
      if (marker) {
        map.removeLayer(marker);
      }

      // Tambahkan pin baru
      marker = L.marker([latitude, longitude]).addTo(map);

      // Simpan data latitude dan longitude di input tersembunyi
      document.getElementById('latitude').value = latitude;
      document.getElementById('longitude').value = longitude;
    });
  }

  document.addEventListener('DOMContentLoaded', initMap);
</script>

@endsection

@section('link')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@endsection
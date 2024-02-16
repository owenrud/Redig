@extends('layouts.main')
@section('link')
 <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@section('content')
<div class="w-full mx-auto my-auto overflow-y-auto  px-4 space-y-8 bg-white border border-gray-200 rounded-lg shadow-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">

<span class="text-purple-800 font-bold text-lg">Setting Gambar</span>
<form id="AddSertif" >
<div class="mb-6">
    <div class="flex-1 flex-col space-y-4 my-4">
<label class="block pl-4 mb-2 font-medium text-lg text-purple-900 dark:text-white" >Upload Background Sertifikat</label>
<input id="background" name="background" class="block ml-4 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer  dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help"  type="file">
<p class="pl-4 mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG (MAX. 800x400px).</p>

</div>
</div>

<div class="mb-6">
    <div class="flex-1 flex-col space-y-4 my-4">
<label class="block pl-4 mb-2 font-medium text-lg text-purple-900 dark:text-white" >Upload Logo</label>
<input id="logo" name="logo" class="block ml-4 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help"  type="file">
<p class="pl-4 mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG (MAX. 800x400px).</p>

</div>
</div>

<div class="mb-6">
    <div class="flex-1 flex-col space-y-4 my-4">
<label class="block pl-4 mb-2 font-medium text-lg text-purple-900 dark:text-white" >Upload ttd</label>
<input id="ttd" name="ttd" class="block ml-4 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help"  type="file">
<p class="pl-4 mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG (MAX. 800x400px).</p>

</div>
</div>
<span class="text-purple-800 font-bold text-lg">Setting Isian</span>
<div class="mt-6 mb-6">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Ketua Panitia</label>
    <input id="nama" name="nama_ketu_panitia" type="text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>
<div class="mb-6">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kota Diterbitkan</label>
   <select id="kabupatenDropdown">
    <!-- Placeholder option -->
    <option value="" disabled selected>Select Kota/Kabupaten</option>
</select>
</div>

<div class="mb-6">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Diterbitkan</label>
    <input id="tgl" name="tanggal_diterbitkan" type="date"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>


<a href="detail">
<button onclick="postSertif(event)" type="submit" class="max-w-lg text-white bg-gradient-to-br from-purple-600 to-fuchsia-400 hover:bg-gradient-to-bl hover:from-purple-600 hover:to-fuchsia-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">

Save
</button>
</a>

</form>
</div>

</div>
</div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Include Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {
    const eventId = window.location.pathname.split('/')[3];
    //console.log(eventId);
    function postSertif(event) {
        event.preventDefault();

        const form = document.getElementById('AddSertif');
        const formData = new FormData(form);
        form.querySelectorAll('[type="file"]').forEach(fileInput => {
        const name = fileInput.name;
            // Append the file to formData
            formData.append(name, fileInput.files[0]);

    });
        formData.append('ID_event', eventId);
        
        //console.log(formData);
        fetch('http://localhost:8000/api/sertifikat/save', {
            method: 'POST',
            body: formData,
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            // Read the response text and parse it as JSON
            return response.text();
        })
        .then(data => {
            // Parse the response text as JSON
            const jsonData = JSON.parse(data);
            if (jsonData.is_success) {
                window.location.href = `/event/detail/${eventId}`;
            } else {
                console.error('Failed to save data:', jsonData.message);
            }
        })
        .catch(error => console.error('Error during fetch:', error));
    }

    const form = document.getElementById('AddSertif');
    form.addEventListener('submit', postSertif);

    window.postSertif = postSertif;
});

</script>
<script>
// Fetch data from the API
fetch('http://localhost:8000/api/kabupaten/all')
    .then(response => response.json())
    .then(apiData => {
        // Check if apiData.data is an array
        if (Array.isArray(apiData.data)) {
            const kabupatenDropdown = $('#kabupatenDropdown');

            // Iterate over the data and populate the dropdown
            apiData.data.forEach(kabupaten => {
                const option = new Option(kabupaten.nama, kabupaten.id);
                kabupatenDropdown.append(option);
            });

            // Initialize Select2
            kabupatenDropdown.select2({
                placeholder: 'Select Kota/Kabupaten',
                allowClear: true,
                width: 'resolve', // or a specific width in pixels
            });
        } else {
            console.error('API response does not contain an array of data');
        }
    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });
</script>
@endsection
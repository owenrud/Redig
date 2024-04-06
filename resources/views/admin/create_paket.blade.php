@extends('admin.layouts.main')
@section('title','create paket')
@section('page_title','Create Paket')
@section('content')

<div class="flex flex-col p-8">
<div class="w-full  space-y-4 mb-auto  bg-white border border-gray-200 rounded-lg shadow-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
<span class="text-purple-900 font-bold text-xl mb-4">Create Paket</span>
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
<button onclick="postPaket(event)" type="submit" class="max-w-lg text-white bg-gradient-to-br from-purple-600 to-fuchsia-400 hover:bg-gradient-to-bl hover:from-purple-600 hover:to-fuchsia-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">

Save
</button>


</form>
</div>
</div>

@endsection

@section('script')
<script>
const fitur = document.getElementById('fitur');

fetch(`http://${Endpoint}/api/fitur-paket/all`)
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
    function postPaket(event) {
        event.preventDefault();  // Mencegah tindakan default formulir

        const form = document.querySelector('form');
        const formData = new FormData(form);

        fetch(`http://${Endpoint}/api/paket/save`, {
            method: 'POST',
            body: formData,
        })
        .then(response => {
            if (!response.ok) {
            // If the response status is not in the range 200-299, handle the error
            throw new Error(`ID FITUR TELAH TERPAKAI`);
        }
        return response.json();
         }) // Parse the response JSON)
        .then(data => {
            if (data.is_success) {
                // Redirect to /admin if successful
                window.location.href = '/admin/paket';
            } else {
                // Handle the case where save failed
                const errorMessage = data.message || 'Failed to save data.';
                // Display an alert with a custom error message
                alert(errorMessage);
                }
        })
        .catch(error => {
            
            // Display an alert with a custom message
            alert('ID Fitur sudah terpakai');
        });
    }

    // Menambahkan event listener ke formulir untuk mendengarkan peristiwa pengiriman
    const form = document.querySelector('form');
    form.addEventListener('submit', postPaket);
</script>



@endsection
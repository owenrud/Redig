@extends('layouts.main')
@section('content')
<div class="w-11/12 mx-auto my-auto p-4 space-y-8 bg-white border border-gray-200 rounded-lg shadow-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
<span class="text-purple-800 font-bold text-xl">Add Operator</span>
<form id="AddOp">
<div class="mb-6">
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
    <input name="nama" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>
<div class="mb-6">
<input name="role" type="hidden" value="Operator">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
    <input name="email" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>
<div class="mb-6">
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
    <input name="password" type="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>
<a href="detail">
<button onclick="postOperator(event)" type="button" class="max-w-lg text-white bg-gradient-to-br from-purple-600 to-fuchsia-400 hover:bg-gradient-to-bl hover:from-purple-600 hover:to-fuchsia-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">

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
<script>
 function postOperator(event) {
    event.preventDefault();  // Mencegah tindakan default formulir
//console.log(checkboxValue);
const eventId = window.location.pathname.split('/')[3];
              //console.log(eventId);
    const form = document.getElementById('AddOp');
   //console.log(form);
    const formData = new FormData(form);
    formData.append('ID_event',eventId);
    //console.log(formData);


    fetch(`http://${Endpoint}/api/operator/save`, {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.is_success) {
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
const form = document.querySelector('form');
form.addEventListener('submit', postOperator);
</script>
@endsection
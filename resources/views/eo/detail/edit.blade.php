<section id="edit">

<div class="flex-1 flex-col justify-center items-center p-8   w-full overflow-x-auto">
<p class="ml-4 mb-8 font-bold text-3xl text-purple-800">Event</p>

<form id="EditForm" class="p-16 border-t-8 border-violet-300 shadow-md rounded-lg shadow-fuchsia-600/25">
<span>
<input type="hidden" name="latitude" id="latitude">
<input type="hidden" name="longitude" id="longitude">
<label class="relative inline-flex items-center mb-5 cursor-pointer">
  <input id="public" name="public" type="checkbox" class="sr-only peer">
  <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-violet-300 dark:peer-focus:ring-violet-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-700"></div>
  <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Public</span>
</label>
<p class="mb-4 text-xs">Event anda dapat dicari oleh pengguna aplikasi</p>
</span>

  <div class="relative z-0 w-full mb-6 group">
      <input id="nama_event" type="text" name="nama_event" id="nama_event" class="block py-2.5 px-0 w-full text-sm text-fuchsia-500 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700 peer" placeholder=" " required />
      <label for="nama_event" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-purple-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
      Nama Event
      </label>
  </div>

  <div class="relative z-0 w-full mb-6 group">
      <input id="desc_event" type="text" name="desc_event" class="block py-2.5 px-0 w-full text-sm text-fuchsia-500 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700 peer" placeholder=" " required />
      <label for="deskripsi" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:dark:text-purple-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Deskripsi Event</label>
  </div>

   <div class="relative z-0 w-full mb-6 group">
      <input id="alamat" type="text" name="alamat" id="alamat" class="block py-2.5 px-0 w-full text-sm text-fuchsia-500 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-purple-700 peer" placeholder=" " required />
      <label for="alamat" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-purple-600 peer-focus:dark:text-purple-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Alamat</label>
  </div>

  <label class="font-bold">Tanggal & Waktu Event</label>
<div class="flex flex-row items-center my-4">
  <div class="relative">
    <input id="mulai" name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-violet-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tanggal Mulai">
  </div>
  <span class="mx-4 text-gray-500">to</span>
  <div class="relative">
    <input id="berakhir" name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tanggal Berakhir">
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
<div id="editmap" style="height: 300px;"></div>
</div>
  
  <button onclick="EditEvent(event)" type="submit" class="text-white bg-gradient-to-br from-purple-600 to-fuchsia-400 
  hover:bg-gradient-to-bl :hover:from-fuchsia-400 group:hover:to-purple-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-purple-800">Create</button>
</form>
</div>
</section>
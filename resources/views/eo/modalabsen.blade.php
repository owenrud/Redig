<div id="ModalAbsen" class="modal-absen hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">

    <!-- Modal content -->
    <div class="flex-1 modal-content bg-white p-8 mx-40 rounded-lg">
    <div class="flex flex-col space-y-2">
        <div class="flex flex-row justify-between">
        <span  class="text-2xl">Tambah Jam Absen</span>

        <button id="closeModalBtnAbsen" type="button" class="closeModalBtn focus:outline-none text-white text-3xl bg-gradient-to-br from-violet-200 via-fuchsia-300 to-purple-300 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
        X
        </button>
        </div>
        <hr class="w-full">
        <div class="flex-1 flex-row ">

<div class="w-full  mb-auto  bg-white border border-gray-200 rounded-lg shadow-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
<form id="jam_absen">
<div class="mb-6">
    <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
    <input name="nama" type="text"  class="w-6/12 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
</div>
<div class="mb-6">
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="mulai">Mulai</label>
    <label class="block w-full p-2.5  rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-pointer">
        <input name="mulai" type="time" class="w-3/12 bg-transparent focus:outline-none">
    </label>
</div>

<div class="mb-6">
    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="akhir">Berakhir</label>
    <label class="block w-full p-2.5  rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-pointer">
        <input name="akhir" type="time" class="w-3/12 bg-transparent focus:outline-none">
    </label>
</div>

<button onclick="postAbsen(event)" type="button" class="max-w-lg text-white bg-gradient-to-br from-purple-600 to-fuchsia-400 hover:bg-gradient-to-bl hover:from-purple-600 hover:to-fuchsia-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">

Save
</button>


</form>
</div>

</div>
</div>
</div>

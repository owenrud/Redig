<section id="file">

<div class="flex flex-col space-y-8 p-8">

<form id="FileBanner">
<div class="border-2 flex flex-row space-x-4 mx-auto rounded-lg shadow-lg">
<input name="ID_event" value=2 type="hidden">
<div class="flex-1 flex-col space-y-4 my-4">
<label class="block pl-4 mb-2 font-medium text-xl text-purple-900 dark:text-white" >Banner</label>
<input id="banner" name="banner" class="block ml-4 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help"  type="file">
<p class="pl-4 mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG (MAX. 800x400px).</p>
</div>

<div class="flex-1 my-auto mx-auto pl-4 pt-4 justify-center">
<button onclick="UploadFile(event,this)" type="button" class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
Unggah</button>
</div>

</div>
</form>

<form id="FileLogo">
<div class="border-2 flex flex-row space-x-4 mx-auto rounded-lg shadow-lg">

<div class="flex-1 flex-col space-y-4 my-4 ">
<label class="block pl-4 mb-2 font-medium text-xl text-purple-900 dark:text-white" >Logo</label>
<input id="logo" name="logo" class="block ml-4 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help"  type="file">
<p class="pl-4 mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG (MAX. 400x400px).</p>
</div>

<div class="flex-1 flex-col my-auto mx-auto pl-4 pt-4 justify-center">
<button onclick="UploadFile(event,this)" type="button" class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
Unggah</button>
</div>

</div>
</form>

<form id="FileMateri">

<div class="border-2 flex flex-col space-y-4 my-4 mx-auto p-4 rounded-lg shadow-lg">
<label class="block pl-4 mb-2 font-medium text-xl text-purple-900 dark:text-white" >File Materi</label>
<hr class="my-2">

{{-- <div class="flex-1 flex-col justify-center items-center py-4 px-8  w-full">
<div id="alert-border-4" class="flex items-center mx-4  p-4 mb-4  border-l-8 font-semibold text-amber-600 border-yellow-300 bg-yellow-50/50 dark:text-yellow-300 dark:bg-gray-800 dark:border-yellow-800 rounded-lg" role="alert">
    <div class="flex flex-col space-y-4">
    <div class="flex flex-row">
    <svg class="flex-shrink-0 w-4 h-4 my-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <div class="ms-3 text-sm font-medium">
    Anda dapat menambahkan 3 File Tambahan
    </div>
    </div>
    <div class="flex flex-row">
    <svg class="flex-shrink-0 w-4 h-4 my-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <div class="ms-3 text-sm font-medium">
    File yang lebih dari 2 bulan akan terhapus
    </div>
    </div>

    </div>
</div> --}}

<div class="space-y-4">
<label class="block mb-2 font-medium  text-purple-900 dark:text-white" >File Input</label>
<input id="materi" name="materi" class="block px-4 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help"  type="file">
<p class=" mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG (MAX. 400x400px).</p>
</div>

<button onclick="UploadFile(event, this)" type="button" class="mt-8 w-1/12 text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
Unggah</button>
</div>
</form>

</div>


<div class="flex flex-col my-auto mx-auto w-full p-4 shadow-md border-violet-200  shadow-fuchsia-500/25 bg-white border border-gray-200 overflow-y-auto space-y-4 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
<span class="text-purple-900 font-bold">
Kelola File
</span>
<hr>

<div class="relative overflow-x-auto shadow-lg border border-violet-100 shadow-fuchsia-100/50 sm:rounded-lg p-4">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-purple-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama
                </th>
                <th scope="col" class="px-6 py-3">
                    File
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody id="fileTable">
           
        </tbody>
    </table>
   
</div>

</div>


</section>
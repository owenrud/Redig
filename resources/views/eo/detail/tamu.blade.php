<section id="tamu">
<div class="flex flex-col my-auto mx-auto w-full p-4 shadow-md border-violet-200  shadow-fuchsia-500/25 bg-white border border-gray-200 overflow-y-auto space-y-4 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
<span class="text-purple-900 font-bold">
Daftar Tamu
</span>
<hr>
<div class="flex justify-between">

<button onclick="OpenFormTamu(event)" id="btnTamu" type="button" class="openModalBtn max-w-sm text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-l hover:from-purple-500 hover:via-purple-600 hover:to-purple-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
<svg class="w-5 h-5 me-2 text-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
<path fill="white" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
</svg>
Add Tamu
</button>


<button onclick="Export(event)" type="button" class="max-w-sm text-white bg-gradient-to-br from-purple-600 to-fuchsia-400 hover:bg-gradient-to-l hover:from-fuchsia-400 hover:to-purple-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
<svg class="w-5 h-5 me-2 text-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
<path fill="white" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
</svg>
Download Data Tamu
</button>
</div>

<div class="flex flex-col overflow-x-auto overflow-x-auto shadow-lg border border-violet-100 shadow-fuchsia-100/50 sm:rounded-lg p-4">
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
                    Email
                </th>
                
                <th scope="col" class="px-6 py-3">
                    Gender
                </th>
                <th scope="col" class="px-6 py-3">
                    Type
                </th>
                 <th scope="col" class="px-6 py-3">
                    Instansi
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Ruang
                </th>
                <th scope="col" class="px-6 py-3">
                    No meja
                </th>
                 <th scope="col" class="px-6 py-3">
                    Kode Doorprize
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action<
                </th>
            </tr>
        </thead>
        <tbody id="tamuTable">
           
           
        </tbody>
    </table>
  
</div>

</div>
</section>

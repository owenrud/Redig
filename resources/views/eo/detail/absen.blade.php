<section id="absen">

<div class="flex-1 flex-col justify-center items-center p-8   w-full overflow-x-auto">
<div id="alert-border-4" class="flex items-center mx-4  p-4 mb-4  border-l-8 font-semibold text-amber-600 border-yellow-300 bg-yellow-50/50 dark:text-yellow-300 dark:bg-gray-800 dark:border-yellow-800 rounded-lg" role="alert">
    <div class="flex flex-col space-y-4">
    
    <div class="flex flex-row">
    <svg class="flex-shrink-0 w-4 h-4 my-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <div class="ms-3 text-sm font-medium">
    Data mulai dan berakhir hanya sebagai referensi, Anda dapat melakukan scan tamu
    selama event/acara sedang berlangsung
    </div>
    </div>

    </div>
</div>

<div class="flex flex-col my-auto mx-auto w-full p-4 bg-white border border-violet-200 overflow-y-auto space-y-4 rounded-lg shadow-md shadow-fuchsia-500/20 dark:bg-gray-800 dark:border-gray-700">
<span class="text-purple-900 font-bold">
List
</span>
<hr>
<div class="justify-between">
<button id="openModalAbsen" data-modal-target="ModalAbsen" type="button" class="openModalBtn max-w-sm text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-l hover:from-purple-500 hover:via-purple-600 hover:to-purple-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
<svg class="w-5 h-5 me-2 text-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
<path fill="white" d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
</svg>
Add data Absen
</button>
</div>
<div class="flex flex-col overflow-x-auto  shadow-lg shadow-violet-100  sm:rounded-lg">
    <table  class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-purple-100 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama
                </th>
                <th scope="col" class="px-6 py-3">
                    Mulai
                </th>
                <th scope="col" class="px-6 py-3">
                    Berakhir
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody id="absenTable" >
            
           
        </tbody>
    </table>

</div>
</div>
</section>

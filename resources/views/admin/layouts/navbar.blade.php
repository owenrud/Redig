
  <nav class="bg-purple-100 w-32 h-full">
    <div class="max-w-screen-xl flex justify-center items-center p-8">
  <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
</div>

    
    <div class="bg-purple-100" id="navbar-default">
      <ul class="font-medium flex items-center flex-col p-4 mt-4 rounded-lg dark:border-gray-700">
         <li>
        
       <a href="/admin" class="block my-4 p-2 text-center h-20 rounded-2xl w-32 text-black hover:bg-gradient-to-br
        hover:from-purple-900
        hover:to-purple-700
       hover:text-white hover:shadow-lg hover:shadow-gray-700 ">
        <svg class="mx-8 pl-4" xmlns="http://www.w3.org/2000/svg" height="1.25em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm320 96c0-26.9-16.5-49.9-40-59.3V88c0-13.3-10.7-24-24-24s-24 10.7-24 24V292.7c-23.5 9.5-40 32.5-40 59.3c0 35.3 28.7 64 64 64s64-28.7 64-64zM144 176a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm-16 80a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64zM400 144a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"/>
        </svg>
        Dashboard
        </a>
        </li>
        <li>
        
       <a href="/admin/eo" class="block my-4 p-2 text-center h-20 rounded-2xl w-32 text-black hover:bg-gradient-to-br
        hover:from-purple-900
        hover:to-purple-700
       hover:text-white hover:shadow-lg hover:shadow-gray-700 ">
        <svg class="mx-8 pl-4" xmlns="http://www.w3.org/2000/svg" height="1.25em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm320 96c0-26.9-16.5-49.9-40-59.3V88c0-13.3-10.7-24-24-24s-24 10.7-24 24V292.7c-23.5 9.5-40 32.5-40 59.3c0 35.3 28.7 64 64 64s64-28.7 64-64zM144 176a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm-16 80a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64zM400 144a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"/>
        </svg>
        Event Organizer
        </a>
        </li>
        <li>
         <button id="dropdownRightButton" data-dropdown-toggle="dropdownRight" data-dropdown-placement="right" class="me-3 mb-3 md:mb-0 h-20 w-32 hover:text-white hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
         <span class="pl-6 font-medium text-lg">Paket</span>
         <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
</svg>
</button>



<!-- Dropdown menu -->
<div id="dropdownRight" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownRightButton">
      <li>
        <a href="/admin/paket" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Paket</a>
      </li>
      <li>
        <a href="/fitur-paket" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Fitur Paket</a>
      </li>
     
    </ul>
</div>
        </li>
           <button id="dropdownRightButton" data-dropdown-toggle="eventdropdownRight" data-dropdown-placement="right" class="me-3 mb-3 md:mb-0 h-20 w-32 hover:text-white hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
         <span class="pl-6 font-medium text-lg">Event</span>
         <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
</svg>
</button>

<!-- Dropdown menu -->
<div id="eventdropdownRight" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownRightButton">
      <li>
        <a href="/admin/event" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Event</a>
      </li>
      <li>
        <a href="/kategori-event" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Kategori Event</a>
      </li>
     
    </ul>
</div>
        </li>
        <li>
        
       <a href="/admin/transaksi" class="block my-4 p-2 text-center h-20 rounded-2xl w-32 text-black hover:bg-gradient-to-br
        hover:from-purple-900
        hover:to-purple-700
       hover:text-white hover:shadow-lg hover:shadow-gray-700 ">
        <svg class="mx-8 pl-4" xmlns="http://www.w3.org/2000/svg" height="1.25em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm320 96c0-26.9-16.5-49.9-40-59.3V88c0-13.3-10.7-24-24-24s-24 10.7-24 24V292.7c-23.5 9.5-40 32.5-40 59.3c0 35.3 28.7 64 64 64s64-28.7 64-64zM144 176a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm-16 80a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64zM400 144a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"/>
        </svg>
        Transaksi
        </a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="flex-1 flex flex-col">
    <nav class="bg-slate-50 w-full h-16">
      <div class="max-w-screen-xl flex items-center justify-between mx-auto pt-4">
       <p class="text-2xl font-bold text-purple-900">@yield('page_title')</p>
       
       
<img id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="w-10 h-10 rounded-full cursor-pointer" src="https://flowbite.com/docs/images/logo.svg" alt="User dropdown">

<!-- Dropdown menu -->
<div id="userDropdown" class="z-10 hidden bg-slate-50 divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
    <div class="px-4 py-3 text-center text-sm text-gray-900 dark:text-white">
      <div class="text-violet-500">Bonnie Green</div>
      <div class="text-violet-500 font-medium truncate my-2 pb-4">name@flowbite.com</div>
      <span class=" border border-violet-700 rounded-lg p-2 text-xs text-violet-500">
      Admin</span>
    </div>
   
    <div class="py-1 px-1 text-center w-full">
      <a href="/logout" class="block px-5 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
     <button class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-500 to-fuchsia-400 group-hover:from-purple-500 group-hover:to-fuchsia-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800">
<span id="logout" class="relative px-6 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
Sign Out
</span>
</button>
</a>
    </div>
</div>

       </div>
    </nav>
  


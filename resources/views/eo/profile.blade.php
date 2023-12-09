@extends('layouts.main')
@section('content')
<div class="flex flex-row p-4 space-x-4">
<div class="flex-1 flex-col max-w-sm mb-auto p-6 bg-white border border-t-4 border-violet-400 items-center text-center justify-center rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
   <img id="avatar" class="w-24 h-24 rounded-full border-4 border-fuchsia-200 p-1 mx-auto" src="https://flowbite.com/docs/images/logo.svg" alt="User dropdown">

<p class="flex-1 mt-4 text-xl font-semibold mx-auto text-center items-center justify-center">EO Something here</p>

<p class="flex-1 mt-2 text-gray-500 text-sm font-semibold mx-auto text-center items-center justify-center">Umum</p>
<hr class="my-4">
<div class="flex flex-row justify-between">
<p class="px-2 text-black text-md font-bold">Bergabung Sejak</p>
<p class="px-2 text-black text-sm ">2023-01-10 10:23:42</p>

</div>
<hr class="my-4">

</div>


<div class="flex-1 flex-col  p-2 bg-white border border-1 border-fuchsia-400 items-center text-center justify-center rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
   <div id="span-nav" class="flex flex-row space-x-2">
   <span id="profile" class="flex h-10 w-20 justify-center items-center text-white bg-violet-600 my-auto px-2 hover:text-white hover:bg-purple-800 rounded-lg">
   <a   href="#profile" onclick="toggleSection('profile')">Profile</a>
   </span>
   <span id="foto" class="flex h-10 w-32 justify-center items-center text-black my-auto px-2 hover:text-violet-400 rounded-lg">
   <a  href="#foto"  onclick="toggleSection('foto')">Unggah Foto</a>
   </span>
    <span id="reset" class="flex h-10 w-32 justify-center items-center text-black my-auto px-2 hover:text-violet-400 rounded-lg">
   <a  href="#ubah-password" onclick="toggleSection('reset')">Ubah Password</a>
   </span>
   </div>

<hr class="my-2 w-full">

<section id="profile">
<form>
<div class="flex flex-col px-4 py-2 space-y-4">

<div class="flex flex-row justify-between space-x-4">

<span>
<p>Tipe</p>
</span>

<span class="w-10/12">
<select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-fuchsia-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-fuchsia-500 dark:focus:border-blue-500">
  <option value="umum" selected>Umum</option>
  <option value="instansi">Instansi</option>
</select>
</span>

</div>


<div class="flex flex-row justify-between space-x-4">

<span>
<p>Nama</p>
</span>

<span class="w-10/12">
<input type="text" id="default-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-fuchsia-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-fuchsia-500 dark:focus:border-blue-500">
</span>

</div>

<div class="flex flex-row justify-between space-x-4">

<span>
<p>No. Telepon</p>
</span>

<span class="w-10/12">
<input type="text" id="default-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-fuchsia-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-fuchsia-500 dark:focus:border-blue-500">
</span>

</div>

<div class="flex flex-row justify-between space-x-4">

<span>
<p>Alamat</p>
</span>

<span class="w-10/12">
<input type="text" id="default-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-fuchsia-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-fuchsia-500 dark:focus:border-blue-500">
</span>

</div>


<div class="flex flex-row justify-between space-x-4">
<span>
<p>Provinsi</p>
</span>

<span class="w-10/12">
<select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-fuchsia-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-fuchsia-500 dark:focus:border-blue-500">
  <option value="umum" selected>Umum</option>
  <option value="instansi">Instansi</option>
</select>
</span>
</div>

<div class="flex flex-row justify-between space-x-4">
<span>
<p>Kab/Kota</p>
</span>

<span class="w-10/12">
<select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-fuchsia-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-fuchsia-500 dark:focus:border-blue-500">
  <option value="umum" selected>Umum</option>
  <option value="instansi">Instansi</option>
</select>
</span>
</div>

<div class="flex flex-row justify-between space-x-4">
<span>
<p></p>
</span>

<span class="flex">
<button class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-400 to-fuchsia-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
<span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
Ubah Profile
</span>
</button>
</span>
</div>

</div>



</form>
</section>

<section id="foto">
<form>
<div class="flex flex-col px-4 py-2 space-y-4">

<div class="flex flex-row justify-between space-x-4">

<span>
<p>File Foto</p>
</span>

<span class="w-10/12">

<input class="block w-full text-sm text-gray-900 border border-violet-300 rounded-lg cursor-pointer bg-purple-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">

</span>

</div>


<div class="flex flex-row justify-between space-x-4">
<span>
<p></p>
</span>

<span class="flex">
<button class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-400 to-fuchsia-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
<span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
Unggah Foto
</span>
</button>
</span>
</div>

</div>



</form>
</section>


<section id="reset">
<form>
<div class="flex flex-col px-4 py-2 space-y-4">

<div class="flex flex-row justify-between space-x-4">

<span>
<p>Password Lama</p>
</span>

<span class="w-10/12">
<input type="text" id="default-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-fuchsia-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-fuchsia-500 dark:focus:border-blue-500">
</span>


</div>


<div class="flex flex-row justify-between space-x-4">

<span>
<p>Password Baru</p>
</span>

<span class="w-10/12">
<input type="text" id="default-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-fuchsia-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-fuchsia-500 dark:focus:border-blue-500">
</span>


</div>


<div class="flex flex-row justify-between space-x-2">

<span>
<p class="text-left whitespace-normal max-w-[104px]">Konfirmasi Password Baru</p>


</span>

<span class="w-10/12">
<input type="text" id="default-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-fuchsia-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-fuchsia-500 dark:focus:border-blue-500">
</span>


</div>

<div class="flex flex-row justify-between space-x-4">
<span>
<p></p>
</span>

<span class="flex">
<button class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-400 to-fuchsia-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
<span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
Ubah Password
</span>
</button>
</span>
</div>

</div>



</form>
</section>

</div>


</div>
@endsection

@section('script')

<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Hide all sections except the one with id 'profile'
    const sections = document.querySelectorAll('section');
    sections.forEach(section => {
      if (section.id === 'profile') {
        section.style.display = 'block';
      } else {
        section.style.display = 'none';
      }
    });
  });

  function toggleSection(sectionId) {
    const sections = document.querySelectorAll('section');
     const spanNav = document.getElementById('span-nav');
    const spans = spanNav.querySelectorAll('span');
    sections.forEach(section => {
      if (section.id === sectionId) {
        section.style.display = 'block';
        
      } else {
        section.style.display = 'none';
        
      }
    });
   spans.forEach(span => {
        if (span.id === sectionId) {
            span.classList.add('bg-violet-600', 'hover:text-white', 'hover:bg-purple-800', 'text-white');
            span.classList.remove('hover:text-violet-400');
        } else {
            span.classList.remove('bg-violet-600', 'text-white', 'hover:bg-purple-800', 'hover:text-white');
            span.classList.add('hover:text-violet-400', 'text-black');
        }
    });
  }
</script>
@endsection

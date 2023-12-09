@extends('layouts.main')
@section('content')
<div class ="flex flex-row h-40 p-8 space-x-4">
<div class="flex items-center w-3/12 border border-gray-200 rounded-lg shadow">
    <div class="flex items-center justify-center">
    <span class="p-6 bg-cyan-500 h-full w-full rounded-lg mx-2">
    <svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M96 0C60.7 0 32 28.7 32 64V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H96zM208 288h64c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16H144c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm-32-96a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zM512 80c0-8.8-7.2-16-16-16s-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V80zM496 192c-8.8 0-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm16 144c0-8.8-7.2-16-16-16s-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V336z"/>
    </svg>
  </span>
   </div>
    <div class="flex flex-col p-2 mx-2 leading-normal">
        <p class="mb-2 tracking-tight text-gray-900 dark:text-white">Jumlah Event</p>
        <p id="all" class="mb-3 font-bold text-gray-700 dark:text-gray-400">8</p>
    </div>
</div>


<div class="flex items-center w-3/12 border border-gray-200 rounded-lg shadow">
    <div class="flex items-center justify-center">
    <span class="p-6 bg-amber-400 h-full w-full rounded-lg mx-2">
    <svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M96 0C60.7 0 32 28.7 32 64V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H96zM208 288h64c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16H144c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm-32-96a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zM512 80c0-8.8-7.2-16-16-16s-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V80zM496 192c-8.8 0-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm16 144c0-8.8-7.2-16-16-16s-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V336z"/>
    </svg>
  </span>
   </div>
    <div class="flex flex-col p-2 mx-2 leading-normal">
        <p class="mb-2 tracking-tight text-gray-900 dark:text-white">Sedang Berlangsung</p>
        <p id="ongoing" class="mb-3 font-bold  text-gray-700 dark:text-gray-400">1</p>
    </div>
</div>


<div class="flex items-center w-3/12 border border-gray-200 rounded-lg shadow">
    <div class="flex items-center justify-center">
    <span class="p-6 bg-emerald-600 h-full w-full rounded-lg mx-2">
    <svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M96 0C60.7 0 32 28.7 32 64V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H96zM208 288h64c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16H144c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm-32-96a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zM512 80c0-8.8-7.2-16-16-16s-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V80zM496 192c-8.8 0-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm16 144c0-8.8-7.2-16-16-16s-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V336z"/>
    </svg>
  </span>
   </div>
    <div class="flex flex-col p-2 mx-2 leading-normal">
        <p class="mb-2 tracking-tight text-gray-900 dark:text-white">Akan Datang</p>
        <p id="upcoming" class="mb-3 font-bold  text-gray-700 dark:text-gray-400">5</p>
    </div>
</div>


<div class="flex items-center w-3/12 border border-gray-200 rounded-lg shadow">
    <div class="flex items-center justify-center">
    <span class="p-6 bg-rose-600 h-full w-full rounded-lg mx-2">
    <svg xmlns="http://www.w3.org/2000/svg" height="2em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M96 0C60.7 0 32 28.7 32 64V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H96zM208 288h64c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16H144c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm-32-96a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zM512 80c0-8.8-7.2-16-16-16s-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V80zM496 192c-8.8 0-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm16 144c0-8.8-7.2-16-16-16s-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V336z"/>
    </svg>
  </span>
   </div>
    <div class="flex flex-col p-2 mx-2 leading-normal">
        <p class="mb-2 tracking-tight text-gray-900 dark:text-white">Selesai</p>
        <p id="finish" class="mb-3 font-bold  text-gray-700 dark:text-gray-400">2</p>
    </div>
</div>



</div>

</div>
@endsection

@section('script')
<script>
let count_all =0;
let countOngoing = 0;
let countUpcoming =0;
let countFinished =0;
fetch('http://localhost:8000/api/event/all')
.then(response => response.json())
.then(apiData =>{
   // console.log(apiData);
    
        const item = apiData.data;
        //console.log(item);
        item.forEach(event =>{
            const all = document.getElementById('all');
            count_all = item.length;
            all.textContent= count_all;

            if(event.status == 0){
             countFinished++;
            }else if(event.status == 1){
                countOngoing++;
            }else{
                countUpcoming++;
            }
            })
            const finishedElement = document.getElementById('finish');
const ongoingElement = document.getElementById('ongoing');
const upcomingElement = document.getElementById('upcoming');

finishedElement.textContent = countFinished;
ongoingElement.textContent = countOngoing;
upcomingElement.textContent = countUpcoming;
        });
        
</script>
@endsection
@extends('layouts.main')
@section('content')

<div class="flex-1 flex-col justify-center items-center  p-4 w-full overflow-x-auto">
<div href="#" class=" flex-1 block flex-col  p-2 bg-white border border-gray-200 rounded-lg shadow  dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

<div id="span-nav" class="flex flex-row p-2 space-x-3">
<span id="stats" class="flex bg-purple-600 w-24 h-10 p-2 justify-center items-center rounded-lg text-white"  onclick="toggleSection('stats')">Statistik</span>
<span id="edit" class="flex hover:text-violet-400 w-24 h-10 p-2 justify-center items-center rounded-lg text-black" onclick="toggleSection('edit')" >Detail/Edit</span>
<span id="absen" class="flex hover:text-violet-400 w-24 h-10 p-2 justify-center items-center rounded-lg text-black" onclick="toggleSection('absen')">Jam Absen</span>
<span id="file" class="flex hover:text-violet-400 w-32 h-10 p-2 justify-center items-center rounded-lg text-black" onclick="toggleSection('file')">File Tambahan</span>
<span id="tamu" class="flex hover:text-violet-400 w-24 h-10 p-2 justify-center items-center rounded-lg text-black" onclick="toggleSection('tamu')">Tamu</span>
<span id="op" class="flex hover:text-violet-400 w-24 h-10 p-2 justify-center items-center rounded-lg text-black" onclick="toggleSection('op')">Operator</span>
<span id="sertifikat" class="flex hover:text-violet-400 w-24 h-10 p-2 justify-center items-center rounded-lg text-black" onclick="toggleSection('sertifikat')">Sertifikat</span>

</div>
<hr class="flex-1 w-full mt-2 mb-4">

@include('eo.detail.statistik')

@include('eo.detail.edit')

@include('eo.detail.absen')

@include('eo.detail.file')

@include('eo.detail.tamu')

@include('eo.detail.operator')

@include('eo.detail.sertifikat')


</div>
</div>

@include('eo.modalabsen')



</div>
</div>
@endsection

@section('script')

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- ... other head content ... -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>


<script>
   document.addEventListener('DOMContentLoaded', function () {
    // Initialize Flatpickr for the 'start' input
    // Initialize Flatpickr for the 'start' input
       // Initialize Flatpickr for the 'start' input
const startDatePicker = flatpickr('input[name="start"]', {
  dateFormat: 'Y-m-d H:i',
  enableTime: true,
});

// Initialize Flatpickr for the 'end' input
const endDatePicker = flatpickr('input[name="end"]', {
  dateFormat: 'Y-m-d H:i',
  enableTime: true,
});

// Set the minDate for 'end' after selecting date & time in 'start'
startDatePicker.config.onChange.push(function(selectedDates, dateStr, instance) {
  endDatePicker.set('minDate', dateStr);
});
  });
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mulaiInput = document.querySelector('input[name="mulai"]');
    const akhirInput = document.querySelector('input[name="akhir"]');

    // Add event listener to 'mulai' input
    mulaiInput.addEventListener('change', function() {
        // Compare 'mulai' and 'akhir' values
        if (mulaiInput.value > akhirInput.value) {
            // If 'akhir' is less than 'mulai', set 'akhir' to be equal to 'mulai'
            akhirInput.value = mulaiInput.value;
        }
    });

    // Add event listener to 'akhir' input
    akhirInput.addEventListener('change', function() {
        // Compare 'mulai' and 'akhir' values
        if (mulaiInput.value > akhirInput.value) {
            // If 'akhir' is less than 'mulai', set 'mulai' to be equal to 'akhir'
            mulaiInput.value = akhirInput.value;
        }
    });
});

  document.addEventListener("DOMContentLoaded", function () {
    // Retrieve the last active section from local storage
    const lastActiveSection = localStorage.getItem('activeSection') || 'stats';

    // Hide all sections except the last active one
    const sections = document.querySelectorAll('section');
    sections.forEach(section => {
        if (section.id === lastActiveSection) {
            section.style.display = 'block';
        } else {
            section.style.display = 'none';
        }
    });

    // Set the corresponding span as active
    setActiveSpan(lastActiveSection);
});

function toggleSection(sectionId, link) {
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

    // Set the corresponding span as active
    setActiveSpan(sectionId);

    // Store the current active section in local storage
    localStorage.setItem('activeSection', sectionId);
}

function setActiveSpan(activeSectionId) {
    const spanNav = document.getElementById('span-nav');
    const spans = spanNav.querySelectorAll('span');

    spans.forEach(span => {
        if (span.id === activeSectionId) {
            span.classList.add('bg-purple-600', 'hover:text-white', 'text-white');
            span.classList.remove('hover:text-violet-400');
        } else {
            span.classList.remove('bg-purple-600', 'text-white', 'hover:text-white');
            span.classList.add('hover:text-violet-400', 'text-black');
        }
    });
}

</script>
<script>
  const jamId = window.location.pathname.split('/').pop();
  const provinsiSelect = document.getElementById('provinsi');
  const kabupatenSelect = document.getElementById('kabupaten');
  const KategoriSelect = document.getElementById('kategori');
  const StatsJamSelect =document.getElementById('Stats_Jam');

  function populateStatJam() {
    fetch('http://127.0.0.1:8000/api/absen/show',{
        method: 'POST',
        headers: {
         'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          ID_event: jamId,
                    // Add other necessary data in the body if needed
          }),
    })
      .then(response => response.json())
      .then(jsonData => {
        const data = jsonData.data;
        //console.log(data);

      // Loop through the data and add options to the <select>
      data.forEach(item => {
        const option = document.createElement('option');
        option.value = item.ID_absen;
        option.text = item.nama;
        StatsJamSelect.appendChild(option);
      });
      })
      .catch(error => {
        console.error('Terjadi kesalahan:', error);
      });
  }

  // Fungsi untuk mengisi pilihan provinsi dari API
  function populateProvinsi(preselectedProvinsiID) {
    fetch('http://127.0.0.1:8000/api/provinsi/all')
      .then(response => response.json())
      .then(jsonData => {
        const data = jsonData.data;
        console.log(data);
         provinsiSelect.innerHTML = '';

      // Add a default option
      const defaultOption = document.createElement('option');
      defaultOption.value = '';
      defaultOption.text = 'Pilih Provinsi';
      provinsiSelect.appendChild(defaultOption);

      // Loop through the data and add options to the <select>
      data.forEach(item => {
        const option = document.createElement('option');
        option.value = item.ID_provinsi;
        option.text = item.nama;
        provinsiSelect.appendChild(option);
      });
        if (preselectedProvinsiID) {
                provinsiSelect.value = preselectedProvinsiID;
            }
      })
      .catch(error => {
        console.error('Terjadi kesalahan:', error);
      });
  }

async function populateKategori(preselectedKategoriID) {
    fetch('http://127.0.0.1:8000/api/event/kategori/all')
      .then(response => response.json())
      .then(jsonData => {
        const data = jsonData.data;
        //console.log(data);
         KategoriSelect.innerHTML = '';

      // Add a default option
      const defaultOption = document.createElement('option');
      defaultOption.value = '';
      defaultOption.text = 'Pilih Kategori';
      KategoriSelect.appendChild(defaultOption);

      // Loop through the data and add options to the <select>
      data.forEach(item => {
        const option = document.createElement('option');
        option.value = item.id;
        option.text = item.nama;
        KategoriSelect.appendChild(option);
      });
      if (preselectedKategoriID) {
                KategoriSelect.value = preselectedKategoriID;
            }
      })
      .catch(error => {
        console.error('Terjadi kesalahan:', error);
      });
  }
  // Fungsi untuk mengisi pilihan kabupaten berdasarkan id provinsi yang dipilih
  function populateKabupaten(provinsiId,preselectedKabuID) {
    fetch('http://127.0.0.1:8000/api/kabupaten/show',{
          method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ id_provinsi: provinsiId }),

    })
      .then(response => response.json())
      .then(jsondata => {
        const datakab = jsondata.data;
        // Bersihkan pilihan sebelumnya
        kabupatenSelect.innerHTML = '';
       
        // Tambahkan pilihan default
        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.text = 'Pilih Kabupaten';
        kabupatenSelect.appendChild(defaultOption);

        // Loop melalui data dari API dan tambahkan pilihan ke elemen <select>
        datakab.forEach(item => {
          const option = document.createElement('option');
          option.value = item.id;
          option.text = item.nama;
          kabupatenSelect.appendChild(option);
        });
         if (preselectedKabuID) {
                kabupatenSelect.value = preselectedKabuID;
            }
      })
      .catch(error => {
        console.error('Terjadi kesalahan:', error);
      });
  }

 document.addEventListener('DOMContentLoaded', () => {
   

    // Mendengarkan perubahan pada pilihan provinsi
    provinsiSelect.addEventListener('change', () => {
        console.log('Provinsi Selected:', provinsiSelect.value); // Debugging line
        const eventId = window.location.pathname.split('/').pop();
        const selectedProvinsiId = provinsiSelect.value;

        // Periksa apakah provinsi yang dipilih tidak kosong
        if (selectedProvinsiId) {
            // Panggil fungsi untuk mengisi pilihan kabupaten
            
           
           
            populateKabupaten(selectedProvinsiId);
        } else {
            // Jika provinsi yang dipilih kosong, bersihkan pilihan kabupaten
            kabupatenSelect.innerHTML = '';
        }
    });

});

  // Panggil fungsi untuk mengisi pilihan provinsi saat halaman dimuat
  populateProvinsi();
  populateKategori();
  populateStatJam();
</script>

 <script>
        async function fetchEventDates() {
          const eventId = window.location.pathname.split('/').pop();
            const apiUrl = 'http://localhost:8000/api/event/show';
            const response = await fetch(apiUrl,{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    ID_event: eventId,
                    // Add other necessary data in the body if needed
                }),
            });
            const data = await response.json();
            return data.data;
        }

        // Function to add days to a date
        function addDays(date, days) {
            const result = new Date(date);
            result.setDate(result.getDate() + days);
            return result;
        }

        async function populateDateOptions() {
            const eventDates = await fetchEventDates();

            // Assuming eventDates contains start and end dates
            const startDate = new Date(eventDates.start);
            const endDate = new Date(eventDates.end);

            const selectElement = document.getElementById("tgl");
            let currentDate = startDate;

            while (currentDate <= endDate) {
                const option = document.createElement("option");
                option.value = currentDate.toISOString().split("T")[0];
                option.text = currentDate.toISOString().split("T")[0];
                selectElement.add(option);

                currentDate = addDays(currentDate, 1);
            }
        }
       async function fetchDataAndPopulateTable() {
            const tableBody = document.getElementById('StatsTable');
            
            try {
                const eventId = { ID_event: jamId }; // Replace with the actual event ID
                const response = await fetch('http://localhost:8000/api/peserta/show', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(eventId),
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const apiData = await response.json();

                // Check if the API call was successful
                if (apiData.is_success) {
                    const pesertaData = apiData.data;
//console.log(pesertaData);
                    // Loop through the data and populate the table
                    pesertaData.forEach((data, index) => {
                        const row = tableBody.insertRow();
                        const cell1 = row.insertCell(0);
                        const cell2 = row.insertCell(1);
                        const cell3 = row.insertCell(2);
                        const cell4 = row.insertCell(3);
                        const cell5 = row.insertCell(4);
                         [cell1, cell2, cell3, cell4, cell5].forEach(cell => {
                            cell.classList.add('px-6', 'py-3');
                        });
                        // Assign data to the cells
                        cell1.textContent = index + 1;
                        cell2.textContent = data.nama;
                        if (data.status_absen === 1) {
                            cell3.textContent = 'Hadir';
                            cell3.classList.add('text-green-600');
                        } else {
                            cell3.textContent = 'Tidak Hadir';
                            cell3.classList.add('text-rose-600');
                        }
                        cell4.textContent = data.absen_oleh;

                        // You can add an edit button in cell5 if needed
                        const editButton = document.createElement('button');
                        editButton.textContent = 'Edit';
                        editButton.classList.add('text-purple-600');
                        // Add event listener or link to your edit page

                        cell5.appendChild(editButton);
                    });
                } else {
                    console.error('API call unsuccessful. Message:', apiData.message);
                }
            } catch (error) {
                console.error('Error fetching and displaying data:', error);
            }
        }
        // Call the function to populate date options
        fetchDataAndPopulateTable();
        populateDateOptions();
    </script>

<!-- Script untuk ModalAbsen -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const openModalAbsen = document.getElementById('openModalAbsen');
        const modalAbsen = document.getElementById('ModalAbsen');
        const closeModalBtnAbsen = document.getElementById('closeModalBtnAbsen');

        openModalAbsen.addEventListener('click', function () {
            modalAbsen.classList.remove('hidden');
        });

        closeModalBtnAbsen.addEventListener('click', function () {
            modalAbsen.classList.add('hidden');
        });

        window.addEventListener('click', function (event) {
            if (event.target === modalAbsen) {
                modalAbsen.classList.add('hidden');
            }
        });
    });
</script>
<script>
 async function fetchAndPopulateForm() {
    try {
        const eventId = window.location.pathname.split('/').pop();
        const apiUrl = 'http://localhost:8000/api/event/show';
        const detailApiUrl = 'http://localhost:8000/api/event/detail/show';
        const kategoriApiUrl = 'http://localhost:8000/api/event/kategori/show';
        const provinsiApiUrl = 'http://localhost:8000/api/provinsi/show';
        const kabupatenApiUrl = 'http://localhost:8000/api/kabupaten/show';

        // Fetch event data
        const eventResponse = await fetch(apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                ID_event: eventId,
            }),
        });

        const eventData = await eventResponse.json();

        if (eventResponse.ok) {
            // Fetch detail event data
            const detailResponse = await fetch(detailApiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    ID_event: eventId,
                }),
            });

            const detailData = await detailResponse.json();

            if (detailResponse.ok) {
                // Fetch kategori data
                const kategoriResponse = await fetch(kategoriApiUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id: detailData.data.ID_kategori,
                    }),
                });

                if (kategoriResponse.ok) {
                    const kategoriData = await kategoriResponse.json();
                    console.log('Kategori Data:', kategoriData);

                    // Fetch Provinsi data
                    const provinsiResponse = await fetch(provinsiApiUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            id: detailData.data.ID_provinsi,
                        }),
                    });

                    if (provinsiResponse.ok) {
                        const provinsiData = await provinsiResponse.json();
                        console.log('Provinsi Data:', provinsiData);

                         provinsiSelect.value = provinsiData.data.ID_provinsi;
                        provinsiSelect.dispatchEvent(new Event('change'));
                        // Fetch Kabupaten data
                        
                            // Populate the form with event, detail, kategori, provinsi, and kabupaten data
                            populateForm(eventData.data);
                            populateDetail(detailData.data);
                            populateKategori(kategoriData.data.id);
                            populateProvinsi(provinsiData.data.ID_provinsi);
                            populateKabupaten(provinsiData.data.ID_provinsi,detailData.data.ID_kabupaten);
                        
                    } else {
                        console.error('Failed to fetch Provinsi data');
                    }
                } else {
                    console.error('Failed to fetch kategori data:', kategoriData);
                }
            } else {
                console.error('Failed to fetch event detail data:', detailData);
            }
        } else {
            console.error('Failed to fetch event data:', eventData);
        }
    } catch (error) {
        console.error('Error during fetch:', error);
    }
}


async function populateForm(eventData) {
    try {
        // Assuming your form has elements with specific IDs, update their values here
        document.getElementById('nama_event').value = eventData.nama_event;
        document.getElementById('desc_event').value = eventData.desc_event;
        // Populate other form fields accordingly

        // Add logic for populating checkbox, select, date fields, etc.

        // Example for date fields (replace 'mulai' and 'berakhir' with your actual date field IDs)
        document.getElementById('mulai').value = eventData.start;
        document.getElementById('berakhir').value = eventData.end;

        const publicCheckbox = document.getElementById('public');
        publicCheckbox.checked = eventData.public === 1;

        // Set the value of the 'public' input
        document.getElementById('public').value = eventData.public;

        // If you want to visually update the checkbox state, add the 'checked' class
        if (eventData.public === 1) {
            publicCheckbox.classList.add('checked');
        }

     

    } catch (error) {
        console.error('Error during form population:', error);
    }
}
async function populateDetail(detailData){
    try{
 document.getElementById('alamat').value = detailData.alamat;
    } catch(error){
        console.error('Error during population:',error);
    }
   
}


document.addEventListener('DOMContentLoaded', fetchAndPopulateForm);

</script>

<script>
 function postAbsen(event) {
    event.preventDefault();  // Mencegah tindakan default formulir
//console.log(checkboxValue);
const eventId = window.location.pathname.split('/').pop();
              //console.log(eventId);
    const form = document.getElementById('jam_absen');
   //console.log(form);
    const formData = new FormData(form);
    formData.append('ID_event',eventId);
    //console.log(formData);


    fetch('http://localhost:8000/api/absen/save', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.is_success) {
            window.location.reload();
               
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
form.addEventListener('submit', postAbsen);
</script>
<script>
 function EditEvent(event) {
  //console.log("test");
  const checkbox = document.getElementById('public');

// Convert the checked state to 0 or 1
const checkboxValue = checkbox.checked ? 1 : 0;
    event.preventDefault();  // Mencegah tindakan default formulir
//console.log(checkboxValue);
const eventId = window.location.pathname.split('/').pop();
              //console.log(eventId);
    const Editform = document.getElementById('EditForm');
   //console.log(form);
    const formData = new FormData(Editform);
    formData.append('public',checkboxValue);
    formData.append('ID_event',eventId);
    //console.log(formData);


    fetch('http://localhost:8000/api/event/update', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.is_success) {
           const ID_event = data.data.ID_event;
            const alamat =formData.get('alamat');
            const provinsi =formData.get('provinsi') ;
            const kategori =formData.get('kategori');
            const kabupaten =formData.get('kabupaten');

            const secondApiData ={
                ID_event: ID_event,
                ID_kategori : kategori,
                alamat : alamat,
                ID_provinsi : provinsi,
                ID_kabupaten :kabupaten,
            };
            if(kabupaten !== '' && provinsi!== '' && kategori !==''){
            fetch('http://localhost:8000/api/event/detail/update',{
              method:'POST',
              headers: {
              'Content-Type': 'application/json',
              },
              body : JSON.stringify(secondApiData),
            })
             .then(response => response.json())
            .then(data => {
               if (data.is_success) {
                  window.location.reload();
               }
            })
            
               .catch(error => console.error('Error during fetch:', error));
            }else{
              alert("Kabupaten atau Provinsi atau Kategori belum terisi");
            }
        } else {
            // Handle the case where save failed
            console.error('Failed to save data:', data.message);
            // You can display an error message to the user or take other actions
        }
    })
    .catch(error => console.error('Error during fetch:', error));
}

// Menambahkan event listener ke formulir untuk mendengarkan peristiwa pengiriman
const Editform = document.getElementById('EditForm');
Editform.addEventListener('submit', EditEvent);
</script>
<script>
const eventId = window.location.pathname.split('/').pop();
async function ReadAbsen(){
   try {
            //console.log(eventId);
            const apiUrl = 'http://localhost:8000/api/absen/show';
            const detailApiUrl = `http://localhost:8000/api/event/detail/show`;


            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    ID_event: eventId,
                    // Add other necessary data in the body if needed
                }),
            });

            const eventData = await response.json();

            if (response.ok) {
               const absenData = eventData.data;
            generateAbsenTableRows(absenData);
                 } else {
                console.error('Failed to fetch event data:', eventData);
            }
        } catch (error) {
            console.error('Error during fetch:', error);
        }
    }
function generateAbsenTableRows(absenData) {
    const tableBody = document.getElementById('absenTable');

    // Clear existing rows
    

    // Loop through the absenData and create table rows
    absenData.forEach((absen, index) => {
    const row = tableBody.insertRow();
    
    // Number Cell
    const cellNumber = row.insertCell(0);
    cellNumber.classList.add('px-6', 'py-4', 'font-medium', 'text-gray-900', 'whitespace-nowrap', 'dark:text-white');
    cellNumber.textContent = index + 1;

    // Type Cell
    const cellType = row.insertCell(1);
    cellType.classList.add('font-bold', 'px-6', 'py-2');
    cellType.textContent = absen.nama; // Replace with the actual property name from your API response

    // Start Time Cell
    const cellStartTime = row.insertCell(2);
    cellStartTime.classList.add('px-6', 'py-4');
    cellStartTime.textContent = absen.mulai; // Replace with the actual property name from your API response

    // End Time Cell
    const cellEndTime = row.insertCell(3);
    cellEndTime.classList.add('px-6', 'py-4');
    cellEndTime.textContent = absen.berakhir; // Replace with the actual property name from your API response

    // Delete Link
    const deleteButton = document.createElement('button');
    deleteButton.classList.add('cursor-pointer','block', 'py-2', 'px-4', 'text-sm', 'text-rose-600', 'hover:bg-violet-50', 'dark:hover:bg-gray-600', 'dark:text-gray-200', 'dark:hover:text-white');
    deleteButton.textContent = 'Delete';
     deleteButton.type = 'button';
                            deleteButton.onclick = function() {
                                // Define the action you want to perform when the "Delete" button is clicked
                                deleteRowAction(absen.ID_absen); // You need to implement the deleteRowAction function
                            };
    // Append elements to the DOM
    row.appendChild(deleteButton);
});
}
ReadAbsen();
</script>
<script>
// Function to handle row deletion
function deleteRowAction(ID_paket) {
    const confirmation = confirm("Are you sure you want to delete this row?");

    if (confirmation) {
        // Make a DELETE request to the API
        fetch(`http://localhost:8000/api/absen/delete/${ID_paket}`, {
            method: 'DELETE',
        })
        .then(response => response.json())
        .then(data => {
            if (data && data.is_success) {
                console.log('Row deleted successfully');
                
                // Reload the page after successful deletion
                location.reload();
            } else {
                console.error('Failed to delete row');
            }
        })
        .catch(error => console.error('Error deleting row:', error));
    }
}

</script>
<script>
function OpenFormTamu(event){
  event.preventDefault();
  window.location.href = `/event/detail/${eventId}/tamu`
}
function OpenFormOperator(event){
  event.preventDefault();
  window.location.href = `/event/detail/${eventId}/operator`
}
function OpenSertifikat(event){
  event.preventDefault();
  window.location.href = `/event/detail/${eventId}/sertifikat`
}
async function ReadTamu(){
   try {
            //console.log(eventId);
            const apiUrl = 'http://localhost:8000/api/peserta/show';


            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    ID_event: eventId,
                    // Add other necessary data in the body if needed
                }),
            });

            const eventData = await response.json();

            if (response.ok) {
               const absenData = eventData.data;
            generateTamuTableRows(absenData);
                 } else {
                console.error('Failed to fetch event data:', eventData);
            }
        } catch (error) {
            console.error('Error during fetch:', error);
        }
    }
  function generateTamuTableRows(tamuData) {
    const tableBody = document.getElementById('tamuTable');

    // Clear existing rows
    

    // Loop through the absenData and create table rows
    tamuData.forEach((tamu, index) => {
    const row = tableBody.insertRow();
    
    // Number Cell
    const cellNumber = row.insertCell(0);
    cellNumber.classList.add('px-6', 'py-4', 'font-medium', 'text-gray-900', 'whitespace-nowrap', 'dark:text-white');
    cellNumber.textContent = index + 1;

    // Type Cell
    const cellName = row.insertCell(1);
    cellName.classList.add('font-bold', 'px-6', 'py-2');
    cellName.textContent = tamu.nama; // Replace with the actual property name from your API response

    const cellEmail = row.insertCell(2);
    cellEmail.classList.add('font-bold', 'px-6', 'py-2');
    cellEmail.textContent = tamu.email;
    const cellGender = row.insertCell(3);
    cellGender.classList.add('font-bold', 'px-6', 'py-2');
    cellGender.textContent = tamu.gender;
    const cellType = row.insertCell(4);
    cellType.classList.add('font-bold', 'px-6', 'py-2');
    cellType.textContent = tamu.type;
    const cellInstansi = row.insertCell(5);
    cellInstansi.classList.add('font-bold', 'px-6', 'py-2');
    cellInstansi.textContent = tamu.instansi;
    const cellNamaRuang = row.insertCell(6);
    cellNamaRuang.classList.add('font-bold', 'px-6', 'py-2');
    cellNamaRuang.textContent = tamu.nama_ruang;
    const cellNoMeja = row.insertCell(7);
    cellNoMeja.classList.add('font-bold', 'px-6', 'py-2');
    cellNoMeja.textContent = tamu.no_meja;
    // Start Time Cell
    const cellDoorPrize = row.insertCell(8);
    cellDoorPrize.classList.add('px-6', 'py-4');
    cellDoorPrize.textContent = tamu.kode_doorprize; // Replace with the actual property name from your API response
const cellAction = document.createElement('td');
                 cellAction.classList.add('flex', 'justify-center', 'space-x-4', 'px-6', 'py-4');

                            const DetailButton = document.createElement('a');
                            DetailButton.textContent = 'Edit';
                            DetailButton.href =`/event/detail/${tamu.ID_event}/tamu/${tamu.ID_peserta}`;
                            DetailButton.classList.add('cursor-pointer','text-sky-500','hover:text-sky-700','px-3','py-1');
                       
                            // Create Delete Button
                            const deleteButton = document.createElement('button');
                            deleteButton.textContent = 'Delete';
                            deleteButton.classList.add('cursor-pointer', 'text-rose-600', 'hover:text-rose-800');
                            deleteButton.type = 'button';
                            deleteButton.onclick = function() {
                                // Define the action you want to perform when the "Delete" button is clicked
                                deleteTamuRowAction(tamu.ID_event); // You need to implement the deleteRowAction function
                            };

                            // Append buttons to the cellAction
                            cellAction.appendChild(DetailButton);
                            
                            cellAction.appendChild(deleteButton);
                        row.append(cellAction);
});
}
function deleteTamuRowAction(ID_paket) {
    const confirmation = confirm("Are you sure you want to delete this row?");

    if (confirmation) {
        // Make a DELETE request to the API
        fetch(`http://localhost:8000/api/peserta/delete/${ID_paket}`, {
            method: 'DELETE',
        })
        .then(response => response.json())
        .then(data => {
            if (data && data.is_success) {
                console.log('Row deleted successfully');
                
                // Reload the page after successful deletion
                location.reload();
            } else {
                console.error('Failed to delete row');
            }
        })
        .catch(error => console.error('Error deleting row:', error));
    }
}

ReadTamu();
</script>

<script>async function ReadOperator() {
    try {
        const operatorApiUrl = 'http://localhost:8000/api/operator/show';
        const profileApiUrl = 'http://localhost:8000/api/profile/show';
        const userApiUrl = 'http://localhost:8000/api/profile/user';
await new Promise(resolve => setTimeout(resolve, 5000));
        const response = await fetch(operatorApiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                ID_event: eventId,
                // Add other necessary data in the body if needed
            }),
        });

        const eventData = await response.json();

        // Create an array of promises for profile and user requests
        
        if (eventData.data && eventData.data.length > 0) {
        const requests = eventData.data.map(async (operatorDataItem) => {
            const profileResponse = await fetch(profileApiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    id: operatorDataItem.ID_User,
                    // Add other necessary data in the body if needed
                }),
            });

            const userResponse = await fetch(userApiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    id: operatorDataItem.ID_User,
                    // Add other necessary data in the body if needed
                }),
            });

            return {
                profileData: await profileResponse.json(),
                userData: await userResponse.json(),
                operatorDataItem: operatorDataItem,
            };
        });

        // Wait for all promises to resolve
        const results = await Promise.all(requests);

        // Process results

            //console.log('Profile Data:', profileData);
            //console.log('User Data:', userData);
            //console.log('Operator Data:', operatorDataItem);
            // Perform actions with profileData, userData, and operatorDataItem as needed
            // You may want to call generateOperatorTableRows here
            generateOperatorTableRows(results);

        } else {
    console.error('No data in the first API response.');
}
    } catch (error) {
        console.error('Error during fetch:', error);
         if (error.response) {
        // The request was made and the server responded with a status code
        // that falls out of the range of 2xx
        console.error('Server Response:', error.response.status);
        console.error('Response Data:', await error.response.json());
    } else if (error.request) {
        // The request was made but no response was received
        console.error('No Response Received');
    } else {
        // Something happened in setting up the request that triggered an Error
        console.error('Error Details:', error.message);
    }
    }
}

function generateOperatorTableRows(results) {
    const tableBody = document.getElementById('operatorTable');

    // Clear existing rows
    tableBody.innerHTML = '';

    // Iterate through each result in the array
    results.forEach((result, index) => {
        // Create a new table row for each result
        const row = tableBody.insertRow();

        // Number Cell
        const cellNumber = row.insertCell(0);
        cellNumber.classList.add('px-6', 'py-4', 'font-medium', 'text-gray-900', 'whitespace-nowrap', 'dark:text-white');
        cellNumber.textContent = index + 1;

        // Type Cell
        const cellName = row.insertCell(1);
        cellName.classList.add('font-bold', 'px-6', 'py-2');
        
        // Check if profileData is not null
        if (result.profileData && result.profileData.data) {
            cellName.textContent = result.profileData.data.nama_lengkap || 'N/A';
        } else {
            cellName.textContent = 'N/A';
        }

        const cellEmail = row.insertCell(2);
        cellEmail.classList.add('font-bold', 'px-6', 'py-2');
        cellEmail.textContent = result.userData.data ? result.userData.data.email : 'N/A';

        // ... (Add other cells as needed)

        // Action Cell
        const cellAction = document.createElement('td');
        cellAction.classList.add('flex', 'justify-center', 'space-x-4', 'px-6', 'py-4');

        // Create Edit Button
        const editButton = document.createElement('a');
        editButton.textContent = 'Edit';
        editButton.href = `/event/detail/${result.operatorDataItem.ID_event}/operator/${result.operatorDataItem.ID_operator}`;
        editButton.classList.add('cursor-pointer', 'text-sky-500', 'hover:text-sky-700', 'px-3', 'py-1');

        // Create Delete Button
        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete';
        deleteButton.classList.add('cursor-pointer', 'text-rose-600', 'hover:text-rose-800');
        deleteButton.type = 'button';
        deleteButton.onclick = function () {
            // Define the action you want to perform when the "Delete" button is clicked
            deleteOperatorRowAction(result.operatorDataItem.ID_event); // You need to implement the deleteRowAction function
        };

        // Append buttons to the cellAction
        cellAction.appendChild(editButton);
        cellAction.appendChild(deleteButton);
        row.append(cellAction);
    });
}


function deleteOperatorRowAction(ID_paket) {
    const confirmation = confirm("Are you sure you want to delete this row?");

    if (confirmation) {
        // Make a DELETE request to the API
        fetch(`http://localhost:8000/api/operator/delete/${ID_paket}`, {
            method: 'DELETE',
        })
        .then(response => response.json())
        .then(data => {
            if (data && data.is_success) {
                console.log('Row deleted successfully');
                
                // Reload the page after successful deletion
                location.reload();
            } else {
                console.error('Failed to delete row');
            }
        })
        .catch(error => console.error('Error deleting row:', error));
    }
}


async function ReadFile(){
   try {
            //console.log(eventId);
            const apiUrl = 'http://localhost:8000/api/event/detail/show';


            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    ID_event: eventId,
                    // Add other necessary data in the body if needed
                }),
            });

            const eventData = await response.json();

            if (response.ok) {
               const fileData = eventData.data;
            generateFileTableRows(fileData);
                 } else {
                console.error('Failed to fetch event data:', eventData);
            }
        } catch (error) {
            console.error('Error during fetch:', error);
        }
    }

 function generateFileTableRows(fileData) {
    // Assuming 'table' is your table element
    const columnsToDisplay = ['banner', 'logo', 'materi'];
    const table = document.getElementById('fileTable');
    let counter = 1;

    // Iterate over the specified columns
    for (const columnName of columnsToDisplay) {
        // Create a row for each column
        const row = table.insertRow();

        // Create a cell for 'No' (you can modify this based on your requirement)
        const cellNo = row.insertCell();
        cellNo.classList.add('px-6', 'py-3');
        cellNo.textContent = counter; // Assuming 'ID_event' is the column you want for 'No'

        // Create a cell for 'Nama' (you can modify this based on your requirement)
        const cellNama = row.insertCell();
        cellNama.classList.add('px-6', 'py-3');
        cellNama.textContent = columnName;

        // Create a cell for 'File'
        const cellFile = row.insertCell();
        cellFile.classList.add('px-6', 'py-3');
        cellFile.textContent = fileData[columnName];

        // If the column is a file column, make the text clickable for image preview
        if (fileData[columnName] && (fileData[columnName].toLowerCase().endsWith('.jpg') || fileData[columnName].toLowerCase().endsWith('.png'))) {
            cellFile.style.cursor = 'pointer';
            cellFile.addEventListener('click', () => previewImage(fileData[columnName]));
        }

        // If you want an "Action" column, you can add your action buttons here
        const cellAction = row.insertCell();
        cellAction.classList.add('px-6', 'py-3');
        // Add your action button code here

        counter++;
    }
}

// Function to handle image preview
function previewImage(imageUrl) {
    // Assuming you have a function to show the image preview (e.g., using FancyBox)
    $.fancybox.open({
        src: imageUrl,
        type: 'image',
    });
}


function deleteOperatorRowAction(ID_paket) {
    const confirmation = confirm("Are you sure you want to delete this row?");

    if (confirmation) {
        // Make a DELETE request to the API
        fetch(`http://localhost:8000/api/operator/delete/${ID_paket}`, {
            method: 'DELETE',
        })
        .then(response => response.json())
        .then(data => {
            if (data && data.is_success) {
                console.log('Row deleted successfully');
                
                // Reload the page after successful deletion
                location.reload();
            } else {
                console.error('Failed to delete row');
            }
        })
        .catch(error => console.error('Error deleting row:', error));
    }
}
ReadFile()
ReadOperator();
</script>

<script>
 function UploadFile(event) {
    event.preventDefault();

    const button = event.target;
    const form = button.closest('form');
    form.setAttribute('enctype', 'multipart/form-data');

    // Create FormData
    const formData = new FormData();

    // Iterate over all file inputs within the form
    form.querySelectorAll('[type="file"]').forEach(fileInput => {
        const name = fileInput.name;

        // Check if the name is 'banner', 'file', or 'materi'
        if (name === 'banner' || name === 'logo' || name === 'materi') {
            // Append the file to formData
            formData.append(name, fileInput.files[0]);
        }
    });

    const eventId = window.location.pathname.split('/').pop();

    // Tambahkan file ke FormData
    formData.append('ID_event', eventId);

    fetch('http://localhost:8000/api/event/detail/update', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.is_success) {
          
                  window.location.reload();
               
        } else {
            // Handle the case where save failed
            console.error('Failed to save data:', data.message);
            // You can display an error message to the user or take other actions
        }
    })
    .catch(error => console.error('Error during fetch:', error));
}
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>


// Call the function to fetch and generate table rows

</script>
<script>
     // Function to fetch data and update the donut chart
    async function fetchDataAndUpdateChart() {
        try {
            const eventId = { ID_event: jamId }; // Replace with the actual event ID
            const response = await fetch('http://localhost:8000/api/peserta/show', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(eventId),
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const apiData = await response.json();

            if (apiData.is_success) {
                const pesertaData = apiData.data;

                // Counters for Hadir and Tidak Hadir
                let countHadir = 0;
                let countTidakHadir = 0;

                pesertaData.forEach((data) => {
                    if (data.status_absen === 1) {
                        countHadir++;
                    } else {
                        countTidakHadir++;
                    }
                });

                // Update chart options dynamically
                const chartOptions = getChartOptions(countHadir, countTidakHadir);

                // Get existing chart object
                const existingChart = ApexCharts.instances && ApexCharts.instances.length > 0
                    ? ApexCharts.instances[0]
                    : undefined;

                // Check if the chart already exists
                if (existingChart) {
                    // Update the chart options and render
                    existingChart.updateOptions(chartOptions);
                } else {
                    // Create a new chart and render
                    const chart = new ApexCharts(document.getElementById("donut-chart"), chartOptions);
                    chart.render();
                }
            } else {
                console.error('API call unsuccessful. Message:', apiData.message);
            }
        } catch (error) {
            console.error('Error fetching and updating chart:', error);
        }
    }

    // Function to get chart options with dynamic data
    function getChartOptions(countHadir, countTidakHadir) {
        return {
            series: [countHadir, countTidakHadir],
            colors: ["#800080","#1C64F2"], // Color based on status
            chart: {
                height: 320,
                width: "100%",
                type: "donut",
            },
            stroke: {
                colors: ["transparent"],
                lineCap: "",
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                fontFamily: "Inter, sans-serif",
                                offsetY: 20,
                            },
                            total: {
                                showAlways: true,
                                show: true,
                                label: "Total Peserta",
                                fontFamily: "Inter, sans-serif",
                                formatter: function (w) {
                                    const sum = w.globals.seriesTotals.reduce((a, b) => {
                                        return a + b
                                    }, 0)
                                    return `${sum}`
                                },
                            },
                            value: {
                                show: true,
                                fontFamily: "Inter, sans-serif",
                                offsetY: -20,
                                formatter: function (value) {
                                    return value
                                },
                            },
                        },
                        size: "80%",
                    },
                },
            },
            grid: {
                padding: {
                    top: -2,
                },
            },
            labels: ["Hadir", "Tidak Hadir"],
            dataLabels: {
                enabled: false,
            },
            legend: {
                position: "bottom",
                fontFamily: "Inter, sans-serif",
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return value
                    },
                },
            },
            xaxis: {
                labels: {
                    formatter: function (value) {
                        return value
                    },
                },
                axisTicks: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
            },
        };
    }

    // Call the function whenever you need to fetch and update the chart
    fetchDataAndUpdateChart();
</script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script>
const apiUrl = 'http://localhost:8000/api/event/detail/show';

async function fetchDataAndInitMap() {
    const apiUrl = 'http://localhost:8000/api/event/detail/show';

    try {
        const response = await fetch(apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                ID_event: jamId,
            }),
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const detailData = await response.json();
        //console.log(detailData);
        await initMap(detailData.data);

    } catch (error) {
        console.error('Error fetching detail data:', error);
    }
}

function initMap(detailData) {
    if (!detailData || typeof detailData.lat === 'undefined' || typeof detailData.long === 'undefined') {
        return;
    }

    const defaultLocation = [parseFloat(detailData.lat), parseFloat(detailData.long)];

    const map = L.map('editmap').setView(defaultLocation, 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    const marker = L.marker(defaultLocation, { draggable: true }).addTo(map);

    marker.on('dragend', function (event) {
        const updatedLocation = marker.getLatLng();
        document.getElementById('latitude').value = updatedLocation.lat;
        document.getElementById('longitude').value = updatedLocation.lng;
    });

    // ... Populate other form fields with detailData ...
}
fetchDataAndInitMap();

</script>
<script>
async function Export() {
    const apiUrl = 'http://localhost:8000/api/export';

    try {
        const response = await fetch(apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                ID_event: eventId,
            }),
        });

        //console.log('Raw response:', response); // Log the raw response for debugging

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        // Handle the binary response data
        const blobData = await response.blob();

        // Create a Blob URL and initiate download
        const blobUrl = URL.createObjectURL(blobData);
        const link = document.createElement('a');
        link.href = blobUrl;
        link.download = 'peserta_event.xlsx';
        link.click();

        // Revoke the Blob URL
        URL.revokeObjectURL(blobUrl);
    } catch (error) {
        console.error('Error:', error.message);
    }
}


document.addEventListener('DOMContentLoaded', function() {
    const exportButton = document.getElementById('exportButton');

    if (exportButton) {
        exportButton.addEventListener('click', function(event) {
            event.preventDefault();
            Export();
        });
    }
});
      document.getElementById('ID_Event').value = eventId;
</script>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endsection

@section('link')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@endsection
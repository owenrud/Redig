<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <script src="https://kit.fontawesome.com/43733cda5c.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
</head>
<body>

  <div class=" flex-grow">
    <div class="flex h-auto w-auto grid grid-rows-1 grid-cols-2 ">
    <div class="flex object-fill overflow-hidden ">
    <img class="h-full" src={{asset('storage/login_img.jpg')}} alt="foto">
    </div>
    <div class="bg-violet-900">
    
    <p class="mt-4 flex items-center justify-center text-white font-bold text-3xl">Registrasi</p>
    <form class="max-h-md my-4 mx-20 items-center overflow-auto">
      @csrf
      <label for="website-admin" class="block mb-2 mx-16 text-sm text-white font-medium text-gray-900 dark:text-white">Email</label>
<div class="flex mx-16 my-4">
  <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
    <i class="fa-regular fa-envelope fa-xl"></i>
    <input type="hidden" name="role" value="EO">
  </span>
  @if(isset($Guser))
  <input type="hidden" name="google_id" value="{{$Guser->id}}">
  <input type="hidden" name="verify_email" value="1">
  <input type="hidden" name="profile_picture" value={{$Guser->avatar}}>
  @isset($Guser->email)
<input type="email" name="email" value="{{$Guser->email}}" id="website-admin" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Email">
@endisset
@else
 <input type="hidden" name="verify_email" value="0">
<input type="email" name="email"  id="website-admin" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Email">
@endif
</div>

      <label for="website-admin" class="block mb-2 mx-16 text-sm text-white font-medium text-gray-900 dark:text-white">Password</label>
<div class="flex mx-16 my-4">
  <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
    <i class="fa-solid fa-lock fa-xl"></i>
  </span>
  <input type="password" name="password" id="password" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Password">
</div>
    
    <label for="website-admin" class="block mb-2 mx-16 text-sm text-white font-medium text-gray-900 dark:text-white">Confirm Password</label>
<div class="flex mx-16 my-4">
  <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
    <i class="fa-solid fa-lock fa-xl"></i>
  </span>
  <input type="password" name="confirm_password" id="confirm" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ulangi Password">
</div>
<span id="password-error" class="text-red-600 text-s font-bold mx-28 mb-2 hidden">Password tidak sama</span>


    <label for="website-admin" class="block mb-2 mx-16 text-sm text-white font-medium text-gray-900 dark:text-white">Nama</label>
    <div class="flex mx-16 my-4">
    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
        <i class="fa-regular fa-user fa-xl"></i>
    </span>
    @if(isset($Guser))
    @isset($Guser->name)
    <input type="text" name="full_name" value="{{$Guser->name}}" id="website-admin" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nama Lengkap">
    @endisset
    @else
    <input type="text" name="full_name" id="website-admin" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nama Lengkap">
   @endif
    </div>

     <label for="website-admin" class="block mb-2 mx-16 text-sm text-white font-medium text-gray-900 dark:text-white">Telepon</label>
    <div class="flex mx-16 my-4">
    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
        <i class="fa-solid fa-phone fa-xl"></i>
    </span>
   
    <input type="text" name="no_telp" id="website-admin" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nomor Telepon ">

    </div>

    <label for="countries" class="block mb-2 mx-16 text-white text-sm font-medium text-gray-900 dark:text-white">Tipe anggota</label>

    <div class="flex mx-16">
<select id="persontype" name="person_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
  <option value ="Umum" selected>Umum</option>
  <option value="Instansi">Instansi</option>
</select>

        </div>


<label for="message" class="block my-4 mx-16 text-sm font-medium text-white text-gray-900 dark:text-white">Alamat</label>
<div class="flex mx-16 mb-4">
<textarea name="alamat" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Alamat"></textarea>

</div>

 <label for="countries" class="block mb-2 mt-4 mx-16 text-white text-sm font-medium text-gray-900 dark:text-white">Provinsi</label>

    <div class="flex mx-16 mt-4">
<select id="provinsi" name="provinsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
  <option selected></option>
</select>

        </div>

 <label for="countries" class="block mb-2 mt-4 mx-16 text-white text-sm font-medium text-gray-900 dark:text-white">Kabupaten</label>

    <div class="flex mx-16 mt-4">
<select id="kabupaten" name="kabupaten"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
  <option selected></option>
</select>

        </div>
      <div class='pr-4'>
        <button onclick="register(event)" type="submit" class="mx-20 my-8 flex w-9/12 h-12 text-xl justify-center text-white bg-gradient-to-r from-purple-600 via-purple-700 to-purple-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 shadow-lg shadow-purple-600/25 dark:shadow-lg dark:shadow-purple-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
       Register
       </button>
       </div>
    </form>
   
    </div>
  </div>
<script>

  const provinsiSelect = document.getElementById('provinsi');
  const kabupatenSelect = document.getElementById('kabupaten');

  // Fungsi untuk mengisi pilihan provinsi dari API
  function populateProvinsi() {
    fetch('http://127.0.0.1:8000/api/provinsi/all')
      .then(response => response.json())
      .then(jsonData => {
        const data = jsonData.data;
        //console.log(data);
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
      })
      .catch(error => {
        console.error('Terjadi kesalahan:', error);
      });
  }

  // Fungsi untuk mengisi pilihan kabupaten berdasarkan id provinsi yang dipilih
  function populateKabupaten(provinsiId) {
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
      })
      .catch(error => {
        console.error('Terjadi kesalahan:', error);
      });
  }

  // Mendengarkan perubahan pada pilihan provinsi
  provinsiSelect.addEventListener('change', () => {
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

  // Panggil fungsi untuk mengisi pilihan provinsi saat halaman dimuat
  populateProvinsi();
</script>
<script>
  const passwordInput = document.getElementById('password');
  const confirmPasswordInput = document.getElementById('confirm');
    const passwordError = document.getElementById('password-error');
  // Fungsi untuk memvalidasi kata sandi
  function validatePassword() {
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;

    if (password === confirmPassword) {
      // Kata sandi cocok, atur border menjadi normal
      passwordInput.style.borderColor = 'initial';
      confirmPasswordInput.style.borderColor = 'initial';
      passwordError.style.display = 'none';
    } else {
      // Kata sandi tidak cocok, atur border menjadi merah
      passwordInput.style.borderColor = 'red';
      confirmPasswordInput.style.borderColor = 'red';
      passwordError.style.display = 'block';
    }
  }

  // Mendengarkan perubahan pada kedua input
  passwordInput.addEventListener('input', validatePassword);
  confirmPasswordInput.addEventListener('input', validatePassword);
</script>
<script>
    function register(event) {
    event.preventDefault();  // Mencegah tindakan default formulir

    const form = document.querySelector('form');
    const formData = new FormData(form);

    fetch('http://localhost:8000/api/register-account', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.is_success) {
            // Redirect to /admin if successful
            window.location.href = '/';
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
form.addEventListener('submit', register);
</script>
</body>
</html>
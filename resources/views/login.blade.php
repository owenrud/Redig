<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <script src="https://kit.fontawesome.com/43733cda5c.js" crossorigin="anonymous"></script>
<title>Login</title>
</head>
<body>

  <div class="container">
    <div class="flex h-screen w-screen grid grid-rows-1 grid-cols-2 ">
    <div class="flex object-fill overflow-hidden">
    <img src={{asset('storage/login_img.jpg')}} alt="foto">
    </div>
    <div class="place-content-center bg-violet-900">
    
    <p class="mt-28 flex items-center justify-center text-white text-3xl">Login
    </p>
    <br>
    <p class=" flex items-center justify-center text-white text-xl" >Gunakan username/email yang telah didaftarkan</p>
    
    <form class="my-20 mx-20 items-center"  action="/login" method="POST">
      @csrf
      <label for="website-admin" class="block mb-2 mx-16 text-sm text-white font-medium text-gray-900 dark:text-white">Email</label>
<div class="flex mx-16 my-4">
  <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
    <i class="fa-regular fa-envelope fa-xl"></i>
  </span>
  <input type="email" name="email" id="email" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Email">
</div>

      <label for="website-admin" class="block mb-2 mx-16 text-sm text-white font-medium text-gray-900 dark:text-white">Password</label>
<div class="flex mx-16 my-4">
  <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
    <i class="fa-solid fa-lock fa-xl"></i>
  </span>
  <input type="password" name="password" id="password" class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Password">
</div>
      <div class="flex justify-between text-sm mb-8 mx-16 ">
              <a href="/register" class="text-white  font-semibold ">Belum punya akun?</a>
          </div>
      <div>
       <button type="submit" onclick="validateLoginForm()" class="mx-20 flex w-9/12 h-12 text-xl justify-center text-white bg-gradient-to-r from-purple-600 via-purple-700 to-purple-800 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 shadow-lg shadow-purple-600/50 dark:shadow-lg dark:shadow-purple-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
       Login
       </button>
        </div>
    </form>
    <div class="flex mx-40 mb-10">
    <hr class="w-1/2 my-auto">
    <span class="px-4 text-white text-xl align-top">Atau</span>
    <hr class="w-1/2 my-auto">
    </div>
    <div class="flex justify-center items-center mx-auto">
    <a id="google-login-button" href="/auth/redirect"><button type="button" class="text-white shadow-lg shadow-blue-500/50 bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 me-2 mb-2">
<svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 19">
<path fill-rule="evenodd" d="M8.842 18.083a8.8 8.8 0 0 1-8.65-8.948 8.841 8.841 0 0 1 8.8-8.652h.153a8.464 8.464 0 0 1 5.7 2.257l-2.193 2.038A5.27 5.27 0 0 0 9.09 3.4a5.882 5.882 0 0 0-.2 11.76h.124a5.091 5.091 0 0 0 5.248-4.057L14.3 11H9V8h8.34c.066.543.095 1.09.088 1.636-.086 5.053-3.463 8.449-8.4 8.449l-.186-.002Z" clip-rule="evenodd"/>
</svg>
Sign in with Google
</button>
</a>
    </div>
    </div>
  </div>

</body><script>
function validateLoginForm() {
  var email = document.getElementById('email').value.trim();
  var password = document.getElementById('password').value.trim();

  if (email === '' && password === '') {
    showAlert('Please fill email and password.');
  } else if (email === '') {
    showAlert('Please fill email.');
  } else if (password === '') {
    showAlert('Please fill password.');
  } else {
   
  }
}

function showAlert(message) {
  alert(message);
}
</script>

<script>
const googleLoginButton = document.getElementById('google-login-button');

googleLoginButton.addEventListener('click', function() {
    // Make an AJAX request to your backend
    fetch('/auth/google/callback')
    .then(response => response.json())
    .then(data => {
        if (data.is_success) {
            // User logged in, perform any actions needed
            window.location.href = '/dashboard'; // Redirect to the login page
        } else {
            // User not registered, handle accordingly
            console.error('User not registered:', data.message);
        }
    })
    .catch(error => console.error('Error during fetch:', error));
});
</script>



</html>
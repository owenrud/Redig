<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <script src="https://kit.fontawesome.com/43733cda5c.js" crossorigin="anonymous"></script>
@yield('link')
</head>
<body>
<title>Dashboard</title>
<div class="flex h-screen">
  @include('layouts.navbar')

  
  @yield('content')

  </div>
</div>
<script>
const id = {{ $authUser->ID_User }};
const nama = document.getElementById('username');
fetch("http://localhost:8000/api/profile/show",{
      method: 'POST',
    headers: {
              'Content-Type': 'application/json',
      },
      body: JSON.stringify({ id : id }),
               
})
.then(response => response.json())
.then(data =>{
   if (data.is_success && data.data) {
            const user = data.data;
            //console.log(user);
            nama.textContent = user.nama_lengkap;
            // Access other properties and update your HTML as needed
        } else {
            console.error('Invalid data structure or missing properties.');
        }
    })
    .catch(error => {
        console.error('Error fetching data:', error);
});   
</script>
<script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>

@yield('script')
</body>
</html>
<<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <script src="https://kit.fontawesome.com/43733cda5c.js" crossorigin="anonymous"></script>
    <style>
        @page {
            size: landscape;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .logo {
            width: 100px; /* Adjust the width as needed */
            height: 100px /* Automatically adjust the height based on the width */
            margin-bottom: 20px;
        }

        .text-container {
            text-align: center;
             margin-top: 100px;
        }

        .signature {
            width: 100px; /* Adjust the width as needed */
            height: auto; /* Automatically adjust the height based on the width */
            margin-top: 40px; /* Adjust the margin-top for spacing */
        

        .signature-name {
            margin-top: 10px; /* Adjust the margin-top for spacing */
        }
        hr {
    border-top: 2px solid gold; /* Set the border-top to a solid gold color */
    width: 40%; /* Adjust the width as needed */
    margin: 20px auto; /* Adjust the margin as needed */
}
    .small {
    font-size: 1.125rem;
    margin=-top : 8px; /* Equivalent to text-lg in Tailwind CSS */
}



/* Add more styles as needed for other classes */

    </style>
</head>
@isset($data)
@foreach ($data as $item)
<body style="font-family: sans-serif; margin: 0; padding: 0; background-size: cover; background-position: center center;
            
                background-image: url('data:image/png;base64,{{ base64_encode(file_get_contents(base_path('public/storage/uploads/'.$item->background))) }}');

               
            width: 100vw; height: 100vh; overflow: hidden;">
    <div class="container">

        <!-- Your certificate text content -->
        <div class="text-container">
        
                <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents(base_path('public/storage/uploads/'.$item->logo))); ?>" alt="logo" class="logo">

            <h1 class="text-4xl font-bold mb-4">SERTIFIKAT APRESIASI</h1>
            <p class="text-lg mb-8">DIBERIKAN KEPADA :</p>
            <h1 class="text-3xl font-semibold mb-8">John Doe</h1>
            <hr>
            <small class="text-xl">Atas Partisipasinya sebagai Peserta di acara webinar</small>
            <br>
            <small class="small mt-8">{{$nama->nama_event}}</small>
            <br>
            
            <img src="data:image/png;base64,<?php echo base64_encode(file_get_contents(base_path('public/storage/uploads/'.$item->ttd))); ?>" alt="logo" class="logo">

            <div class="signature-name">{{$item->nama_ketu_panitia}}</div>
            <!-- Add more classes and adjust styles for other elements -->
        </div>
    </div>
</body>
@endforeach
      
   @endisset
</html>


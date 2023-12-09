@extends('admin.layouts.main')
@section('content')


<div class="flex flex-col my-auto mx-auto w-10/12 p-4 bg-white border border-gray-200 overflow-y-auto space-y-4 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
<span class="text-purple-900 font-bold">
Daftar Event
</span>
<hr>

<div class="flex flex-col overflow-x-auto  shadow-lg  sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-purple-100 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    Nama Event
                </th>
                <th scope="col" class="px-6 py-3">
                    Mulai
                </th>
                <th scope="col" class="px-6 py-3">
                    Selesai
                </th>
                <th scope="col" class="px-6 py-3">
                    Public
                </th>
                <th scope="col" class="px-6 py-3">
                    Paket
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
            </tr>
        </thead>
        <tbody id="tableBody">
           
        </tbody>
    </table>
    <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4 mb-4 px-8" aria-label="Table navigation">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing <span class="font-semibold text-gray-900 dark:text-white">1-10</span> of <span class="font-semibold text-gray-900 dark:text-white">1000</span></span>
        <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
            <li>
                <a href="#" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
            </li>
            <li>
                <a href="#" aria-current="page" class="flex items-center justify-center px-3 h-8 text-violet-600 border border-gray-300 bg-violet-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">4</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">5</a>
            </li>
            <li>
        <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
            </li>
        </ul>
    </nav>
</div>
</div>


@endsection


@section('script')
<script>

// Function to fetch data from the second API
async function fetchDataFromSecondAPI(event) {
    const response = await fetch('http://localhost:8000/api/paket/show', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ ID_paket: event.ID_paket }),
    });

    const dataShow = await response.json();

    if (dataShow && dataShow.data) {
        const item = dataShow.data;

        const tipe = document.createElement('td');
        tipe.textContent = item.nama_paket;
        if (item.nama_paket !== 'Gratis') {
            tipe.classList.add('text-purple-600', 'font-bold', 'px-6', 'py-4');
        } else {
            tipe.classList.add('text-blue-700', 'font-bold', 'px-6', 'py-4');
        }

        return tipe;
    }

    return null;
}

// Fetch API pertama untuk mendapatkan data event
fetch('http://localhost:8000/api/event/all')
    .then(response => response.json())
    .then(async data => {
        // Pastikan respons memiliki properti "data" dan "data" adalah array
        if (data && data.is_success && Array.isArray(data.data)) {
            // Ambil elemen tabel atau tempat Anda ingin menyisipkan data
            const tableBody = document.getElementById('tableBody'); // Ganti dengan ID yang sesuai
            let IndexCounter= 1;
            // Array untuk menyimpan semua promise fetch dari API kedua
            const fetchPromises = data.data.map(async event => {
                const row = document.createElement('tr');

                // Sisipkan kolom event ke dalam baris menggunakan elemen <td>
                row.innerHTML = `<td class="px-6 py-4">${IndexCounter}</td>
                                <td class="px-6 py-4">${event.nama_event}</td>
                                  <td class="px-6 py-4">${event.start}</td>
                                  <td class="px-6 py-4">${event.end}</td>`;
                IndexCounter++;
                // Sisipkan baris ke dalam elemen tbody
                tableBody.appendChild(row);

                if (event.public == 1) {
                    const public = document.createElement('td');
                    public.textContent = "Public";
                    public.classList.add('text-green-600', 'px-6', 'py-4');
                    row.appendChild(public);
                } else {
                    const public = document.createElement('td');
                    public.textContent = "Private";
                    public.classList.add('text-rose-600', 'px-6', 'py-4');
                    row.appendChild(public);
                }

                // Fetch API kedua dan simpan promise-nya ke dalam array
                const fetchPromise = fetchDataFromSecondAPI(event);

                try {
                    const tipe = await fetchPromise;

                    if (tipe !== null) {
                        row.appendChild(tipe);
                    }

                    if (event.status == 0) {
                        const status = document.createElement('td');
                        status.textContent = "Selesai";
                        status.classList.add('text-rose-600', 'px-6', 'py-4');
                        row.appendChild(status);
                    } else if (event.status == 1) {
                        const status = document.createElement('td');
                        status.textContent = "Sedang Berlangsung";
                        status.classList.add('text-yellow-400', 'px-6', 'py-4');
                        row.appendChild(status);
                    } else {
                        const status = document.createElement('td');
                        status.textContent = "Akan Datang";
                        status.classList.add('text-green-600', 'px-6', 'py-4');
                        row.appendChild(status);
                    }
                } catch (error) {
                    console.error('Error during fetch:', error);
                }
            });

            // Setelah loop selesai, gunakan Promise.all untuk menunggu semua fetch selesai
            await Promise.all(fetchPromises);

            // Semua fetch sudah selesai, lakukan apa yang perlu dilakukan setelahnya
            console.log('All data has been fetched and processed.');
        } else {
            console.error('Data event tidak valid atau tidak ditemukan');
        }
    })
    .catch(error => console.error('Error fetching data event:', error));
</script>

@endsection
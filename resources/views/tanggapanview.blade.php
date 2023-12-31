<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" integrity="sha512-iVABxERvkeLp2e+fi8eRERZq2ySsf8Ouk4dWq0R6wPz+j9m0AAxm5cggH4LMOk+bsbhB5q8X6BH5JmX4uNt6Hg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-800 text-white">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                {{ __('Dashboard Admin') }}
            </h2>
        </x-slot>

        <div class="flex items-center">
            <div class="container mx-auto px-60 pt-10">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Tabel Daftar Tanggapan</h2>
                <a href="{{ route('tanggapan.pdf') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                    Generate Laporan
                </a>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-5">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-700 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                NIK
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Pengadu
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Keluhan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kategori
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggapan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Petugas
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tanggapans as $tanggapan)
                            <tr class="border-b bg-white dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-white">
                                    {{ $tanggapan->nik }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $tanggapan->pengadu }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $tanggapan->keluhan }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $tanggapan->kategori }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $tanggapan->tanggapan }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $tanggapan->petugas }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $tanggapan->updated_at }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $tanggapans->links() }} <!-- Add pagination links -->
            </div>
        </div>
    </x-app-layout>
</body>
</html>

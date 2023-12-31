<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard Petugas Sosial') }}
            </h2>
        </x-slot>
        


        <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-60 pt-10">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Tabel Daftar Pengaduan</h2>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-700 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            NIK
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Keluhan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Saran
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Foto
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Kategori
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengaduans as $pengaduan)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-white">
                                {{ $pengaduan->nik }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $pengaduan->nama }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $pengaduan->keluhan }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $pengaduan->saran }}
                            </td>
                            <td>
                                <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto" style="max-width: 100px;">
                            </td>
                            <td class="px-6 py-4">
                                {{ $pengaduan->kategori }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $pengaduan->created_at }}
                            </td>
                            <td class="px-6 py-4 ">
                                {{ $pengaduan->status }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($pengaduan->status === 'Diproses')
                                    <a href="{{ route('tanggapan.create', $pengaduan->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Tambah Tanggapan</a>
                                @elseif ($pengaduan->status === 'Selesai')
                                    <span class="font-medium text-green-500 dark:text-green-400">Proses Selesai</span>
                                @else
                                    <form action="{{ route('update.status', $pengaduan->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                            Accept
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $pengaduans->links() }}
            </div>
        </div>

        
    </x-app-layout>
    
</body>
</html>
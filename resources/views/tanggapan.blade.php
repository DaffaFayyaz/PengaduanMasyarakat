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
                {{ __('Berikan Tanggapan') }}
            </h2>
        </x-slot>

        <div class="flex items-center justify-center pt-10">
            <div class="w-full max-w-md bg-gray-700 rounded-md p-8 ">
                <form action="{{ route('tanggapan.store') }}" method="post" class="bg-gray-800 border border-gray-600 shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    @csrf
                    <input type="hidden" name="pengaduan_id" value="{{ $pengaduan->id }}">
                    
                    <div class="mb-4">
                        <label for="nik" class="block text-gray-400 text-sm font-bold mb-2">NIK :</label>
                        <p class="text-gray-300">{{ $pengaduan->nik }}</p>
                    </div>

                    <div class="mb-4">
                        <label for="nama" class="block text-gray-400 text-sm font-bold mb-2">Nama Pengadu :</label>
                        <p class="text-gray-300">{{ $pengaduan->nama }}</p>
                    </div>

                    <div class="mb-4">
                        <label for="keluhan" class="block text-gray-400 text-sm font-bold mb-2">Keluhan :</label>
                        <p class="text-gray-300">{{ $pengaduan->keluhan }}</p>
                    </div>

                    <div class="mb-4">
                        <label for="tanggapan" class="block text-gray-400 text-sm font-bold mb-2">Tanggapan :</label>
                        <textarea name="tanggapan" id="tanggapan" class="bg-gray-600 text-white shadow appearance-none border rounded w-full py-2 px-3 leading-tight focus:outline-none focus:shadow-outline" placeholder="Berikan tanggapan"></textarea>
                    </div>
        
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit Tanggapan</button>
                    </div>
                </form>
            </div>
        </div>
    </x-app-layout>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4a5568;
            color: white;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        h2 {
            text-align: center;
            color: #2d3748;
        }
    </style>
</head>
<body>
    <div>
        <h2>Tabel Daftar Tanggapan</h2>
        <table>
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Pengadu</th>
                    <th>Keluhan</th>
                    <th>Kategori</th>
                    <th>Tanggapan</th>
                    <th>Petugas</th>
                    <th>Tanggal</th>
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
    </div>
</body>
</html>

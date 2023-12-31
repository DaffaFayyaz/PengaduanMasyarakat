<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\Validator;

class PengaduanController extends Controller
{
    public function getTanggapan($id)
    {
        $pengaduan = Pengaduan::find($id);
    
    if (!$pengaduan) {
        return response()->json([
            'status' => 404,
            'message' => 'Data not found',
        ], 404);
    }
    
    $tanggapan = Tanggapan::where('id_pengaduan', $id)->get();
    
    // Check if $tanggapan is empty
    if ($tanggapan->isEmpty()) {
        // Set a default message
        $tanggapanMessage = 'Belum di tanggapi Petugas';
    } else {
        $tanggapanMessage = $tanggapan;
    }
    
    $data = [
        'status' => 200,
        'pengaduan' => $pengaduan,
        'tanggapan' => $tanggapanMessage,
    ];
    
    return response()->json($data, 200);
    
    }
    
        public function getByNik($nik)
    {
        $pengaduan = Pengaduan::where('nik', $nik)->get();
    
        if (!$pengaduan) {
            return response()->json([
                'status' => 404,
                'message' => 'Data not found',
            ], 404);
        }
    
        $data = [
            'status' => 200,
            'pengaduan' => $pengaduan,
        ];
    
        return response()->json($data, 200);
    }
    
    public function sendImage($id)
    {
        // Assuming there is an 'id' column in the 'pengaduans' table
        $pengaduan = Pengaduan::find($id);
    
        if ($pengaduan && $pengaduan->foto) {
            // Get the file path from the database
            $fotoPath = $pengaduan->foto;
    
            // Construct the full file path
            $fullPath = public_path("/storage/$fotoPath");
    
            // Check if the file exists before sending it
            if (file_exists($fullPath)) {
                return response()->file($fullPath);
            } else {
                // Handle the case when the file does not exist
                abort(404, 'Image not found');
            }
        } else {
            // Handle the case when no pengaduan or foto is found
            abort(404, 'Pengaduan or Image not found');
        }
    }
    
    
    
    public function index()
    {
            $pengaduans = Pengaduan::all();
            $data = [
                'status' =>200,
                'pengaduan' => $pengaduans,
            ];
    
            return response()->json($data, 200);
    }

    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {

        $pengaduan->update(['status' => 'Diproses']);

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    public function store(Request $request)
    {
    $validator = Validator::make($request->all(), [
        'nik' => 'required',
        'nama' => 'required',
        'keluhan' => 'required',
        'saran' => 'required',
        'kategori' => 'required',
        'foto' => 'required|image|mimes:jpeg,png,jpg',
    ]);

    // Check if the validation fails
    if ($validator->fails()) {
        $data=[
            "status"=>422,
            "message"=>$validator->messages()
        ];
        return response()->json($data, 422);
    }

    $pengaduan = new Pengaduan;

    $pengaduan->nik = $request->nik;
    $pengaduan->nama = $request->nama;
    $pengaduan->keluhan = $request->keluhan;
    $pengaduan->saran = $request->saran;
    $pengaduan->kategori = $request->kategori;


    // Handle file upload
    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $fotoPath = $foto->store('pengaduan_photos', 'public'); // Store the image in the storage/foto directory
        $pengaduan->foto = $fotoPath;
    }

    $pengaduan->save();

    $data = [
        'status' => 200,
        'message' => 'Data uploaded successfully',
    ];
    return response()->json($data, 200);
    }
}

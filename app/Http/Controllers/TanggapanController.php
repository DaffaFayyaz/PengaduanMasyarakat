<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TanggapanController extends Controller
{
    public function index(){
        if(Auth::id())
        {
            $role=Auth()->user()->role;

            if($role=='petugas_sosial')
            {
                $tanggapans = Tanggapan::where('kategori', 'Sosial')->paginate(10);
                return view('tanggapanview', compact('tanggapans'));
            }

            else if($role== 'admin')
            {
                $tanggapans = Tanggapan::paginate(10);
                return view('tanggapanview', compact('tanggapans'));
            }
            else if($role== 'petugas_infrastruktur')
            {
                $tanggapans = Tanggapan::where('kategori', 'Infrastruktur')->paginate(10);
                return view('tanggapanview', compact('tanggapans'));
            }
            else if($role== 'petugas_lingkungan')
            {
                $tanggapans = Tanggapan::where('kategori', 'Lingkungan')->paginate(10);
                return view('tanggapanview', compact('tanggapans'));
            }
        }
    }

    public function exportPDF()
    {
        if (Auth::id()) {
            $role = Auth()->user()->role;
    
            if ($role == 'petugas_sosial') {
                $tanggapans = Tanggapan::where('kategori', 'Sosial')->get();
            } elseif ($role == 'admin') {
                $tanggapans = Tanggapan::all();
            } elseif ($role == 'petugas_infrastruktur') {
                $tanggapans = Tanggapan::where('kategori', 'Infrastruktur')->get();
            } elseif ($role == 'petugas_lingkungan') {
                $tanggapans = Tanggapan::where('kategori', 'Lingkungan')->get();
            }
    
            $pdf = Pdf::loadView('tanggapantable', compact('tanggapans'));
    
            // Customize the style for the "Tanggal" column
            $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            $pdf->setPaper('A4', 'landscape');
    
            return $pdf->download('TabelTanggapan.pdf');
        }
    }

    public function create(Pengaduan $pengaduan)
    {
        return view('tanggapan', compact('pengaduan'));
    }

    public function store(Request $request)
    {
        // Validate your form data

        Tanggapan::create([
            'pengaduan_id' => Pengaduan::find($request->id),
            'nik' => Pengaduan::find($request->pengaduan_id)->nik,
            'petugas' => auth()->user()->name,
            'keluhan' => Pengaduan::find($request->pengaduan_id)->keluhan,
            'pengadu' => Pengaduan::find($request->pengaduan_id)->nama,
            'kategori' => Pengaduan::find($request->pengaduan_id)->kategori,
            'tanggapan' => $request->tanggapan,
        ]);

        $pengaduan = Pengaduan::find($request->pengaduan_id);
        $pengaduan->status = 'selesai';
        $pengaduan->save();

        return redirect()->route('home')->with('success', 'Tanggapan added successfully.');
    }

    public function getByNik($nik)
    {
        $tanggapan = Tanggapan::where('nik', $nik)->get();
    
        if (!$tanggapan) {
            return response()->json([
                'status' => 404,
                'message' => 'Data not found',
            ], 404);
        }
    
        $data = [
            'status' => 200,
            'tanggapan' => $tanggapan,
        ];
    
        return response()->json($data, 200);
    }
}

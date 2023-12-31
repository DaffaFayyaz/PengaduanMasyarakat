<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if(Auth::id())
        {
            $role=Auth()->user()->role;

            if($role=='petugas_sosial')
            {
                $pengaduans = Pengaduan::where('kategori', 'Sosial')->paginate(10);
                return view('petugas.petugasSosial', compact('pengaduans'));
            }

            else if($role== 'admin')
            {
                $pengaduans = Pengaduan::paginate(10);
                return view('admin.adminHome', compact('pengaduans'));
            }
            else if($role== 'petugas_infrastruktur')
            {
                $pengaduans = Pengaduan::where('kategori', 'Infrastruktur')->paginate(10);
                return view('petugas.petugasInfrastruktur', compact('pengaduans'));
            }
            else if($role== 'petugas_lingkungan')
            {
                $pengaduans = Pengaduan::where('kategori', 'Lingkungan')->paginate(10);
                return view('petugas.petugasLingkungan', compact('pengaduans'));
            }
        }
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\AlumniExport;
use Maatwebsite\Excel\Facades\Excel;

class dashboardController extends Controller
{
    public function dashboard(){
        $alumni = DB::table('tb_alumni')->count('id_alumni');
        $jawaban = DB::table('tb_jawaban')->count('id_jawaban');
        $pengumuman = DB::table('tb_pengumuman')->count('id_pengumuman');
        $lowongan = DB::table('tb_lowongan')->count('id_lowongan');
    	return view("admin/dashboard", compact('alumni','jawaban','pengumuman','lowongan'));
    }


    public function export(){
        return Excel::download(new ALumniExport, 'Alumni.xlsx');
    }
}

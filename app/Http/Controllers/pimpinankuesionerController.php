<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_jenis_kuesioner;
use App\tb_kuesioner;
use App\tb_prodi;
use App\tb_master_kuesioner;
use App\tb_alumni;
use App\tb_detail_kuesioner;
use App\tb_opsi;

use Illuminate\Support\Facades\DB; 

class pimpinankuesionerController extends Controller
{
    
    public function show(){

        $detail = tb_detail_kuesioner::with('relasiDetailtoKuesioner','relasiDetailtoAlumni')->get();
        $prodi = tb_prodi::all();
        $kuesioner = tb_kuesioner::all();
        $alumni = tb_alumni::all();
        $master_kuesioner = tb_master_kuesioner::all();
        $opsi = tb_opsi::all();
        $status = ['DiTolak','Disetujui','Menunggu Konfirmasi'];
    
            return view('/pimpinan/kuesioner/kuesioner', compact ('alumni','detail','prodi','kuesioner','master_kuesioner','opsi','status'));
        }

    public function create(Request $request){
        $detail_kuesioner = new tb_kuesioner();
        $detail_kuesioner->type_kuesioner = $request->type_kuesioner;
        $detail_kuesioner->status = "Menunggu Konfirmasi";
        $detail_kuesioner->save();

        // tb_kuesioner::create([
        //     'type_kuesioner'=>$request->type_kuesioner,
               
        //     ]);
        return redirect('/pimpinan/kuesioner')->with('success','Data berhasil disimpan!');
    }

    public function delete($id){
        $delete = tb_kuesioner::find($id);
        $delete->delete();
        return redirect ('/pimpinan/kuesioner')->with('success','Data berhasil dihapus!'); 
    }

    public function detail($id)
    {
        $judul_kuesioner = tb_kuesioner::find($id)->type_kuesioner;
        $kuesioner = tb_jenis_kuesioner::all();
        $opsi =tb_opsi::all();
        //$detail = tb_detail_kuesioner::where('id_detail_kuesioner', $id)->first();
        //dd($post);

        $detail = tb_detail_kuesioner::where('id_kuesioner', $id)->get();

    //     $detail = DB::select('SELECT
    //     `tb_detail_kuesioner`.`pertanyaan`
    //     , `tb_detail_kuesioner`.`id_detail_kuesioner`, (`tb_detail_kuesioner`.`id_kuesioner`)
    //     , `tb_kuesioner`.`type_kuesioner`
    // FROM
    //     `db_tracer_study`.`tb_detail_kuesioner`
    //     INNER JOIN `db_tracer_study`.`tb_kuesioner` 
    //         ON (`tb_detail_kuesioner`.`id_kuesioner` = `tb_kuesioner`.`id_kuesioner`)
    // WHERE `tb_detail_kuesioner`.`id_kuesioner` =? AND `tb_detail_kuesioner`.`deleted_at` ="NULL"', array($id));

    $id_kuesioner = $id;

    //dd($detail);

        return view('/pimpinan/kuesioner/showkuesioner', compact('detail','kuesioner','opsi', 'id_kuesioner', 'judul_kuesioner'));
    }
    

    public function update(Request $request){
        $res = NULL;
        $updatedata = tb_kuesioner::find($request->id_kuesioner);
        $updatedata->type_kuesioner = $request->type_kuesioner;
        $updatedata->status = $request->status;
        
        //$updatedata->enum('status', array('DiTolak','Disetujui.','Menunggu Konfirmasi'))->nullable()->change();

        $updatedata->update();
       return redirect('/pimpinan/kuesioner')->with('success','Data berhasil disimpan!');
    }
}

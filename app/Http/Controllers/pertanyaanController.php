<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tb_kuesioner;

class pertanyaanController extends Controller
{
    public function show(){
        $pertanyaan = tb_kuesioner::all();

    
        // dd($alumni);
            return view('/kuesioner/masterkuesioner', compact ('pertanyaan'));
        }
    
        public function create(Request $request){
                tb_kuesioner::create([
                    'type_kuesioner'=>$request->type_kuesioner,
                    ]);
                return redirect('/admin/pertanyaan')->with('success','Data berhasil disimpan!');
    
        }
    
        public function delete($id){
            $deletedata = tb_kuesioner::find($id);
            $deletedata->delete();
            return redirect('/admin/pertanyaan')->with('success','Data berhasil dihapus!');
        }

        public function update(Request $request){
            $res = NULL;
            $updatedata = tb_kuesioner::find($request->id_kuesioner);
            $updatedata->type_kuesioner = $request->type_kuesioner;
            $updatedata->update();
            //dd($updatedata);
           return redirect('/admin/pertanyaan')->with('success','Data berhasil diupdate!');
        }
}

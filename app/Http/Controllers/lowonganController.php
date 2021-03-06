<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use AMBERSIVE\DocumentViewer\Abstracts\DocumentAbstract;
use App\tb_lowongan;

class lowonganController extends Controller
{
    public function show(){
        $lowongan = tb_lowongan::all();

        return view ('/lowongan/lowongan', compact('lowongan'));
    }

    public function create(){
        $lowongan = tb_lowongan::where('deleted_at', NULL)->get();
        return view('/lowongan/addlowongan', compact('lowongan'));
    }

    public function store(Request $request)
    {

        $lowongan = tb_lowongan::find($request->id_lowongan);

        $arrImage = [];


        // $post = new tb_lowongan();
        // $post->lowongan = $request->lowongan;
        // $post->tgl_post = $request->tgl_post;

        $post = new tb_lowongan();
        $post->nama_perusahaan = $request->nama_perusahaan;
        $post->jenis_pekerjaan = $request->jenis_pekerjaan;
        $post->tgl_post = $request->tgl_post;
        //$post->judul = Str::slug($request->judul);
        //$post->status = 'aktif';
        //$post->tgl_post = $request->tgl_post;


        if($request->file('lampiran')!=""){
            $file = $request->file('lampiran');
            $fileLocation = '/file/posts/';
            $filename = $file->getClientOriginalName();
            $path = $fileLocation."/".$filename;
            $post->lampiran = '/storage'.$path;
            $post->lampiran_name = $filename;
            Storage::disk('public')->put($path, file_get_contents($file));
        }

        if($request->file('thumbnail')!=""){
            $file = $request->file('thumbnail');
            $fileLocation = '/image/posts/';
            $filename = $file->getClientOriginalName();
            $path = $fileLocation."/".$filename;
            $post->thumbnail = '/storage'.$path;
            $post->thumbnail_name = $filename;
            Storage::disk('public')->put($path, file_get_contents($file));
        }



        $detail = $request->lowongan;
        libxml_use_internal_errors(true);
        $dom = new \domdocument(); 
        //$dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $count => $image) {
            $src = $image->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimeType = $groups['mime'];
                $path = '/image/posts/'.$lowongan->lowongan_lower.'/'.$post->judul.'/content/'. uniqid('', true) . '.' . $mimeType;
                Storage::disk('public')->put($path, file_get_contents($src));
                $image->removeAttribute('src');
                $link = asset('storage'.$path);
                $image->setAttribute('src', $link);
                array_push($arrImage, $path);
            }
        }

        $detail = $dom->savehtml();
        $post->lowongan = $detail;
        $post->save();

        foreach($arrImage as $item){
            $lowongan = new tb_lowongan();
            $lowongan->id_lowongan = $post->id;
            $lowongan->image = $item;
            $lowongan->save();
        }

        return redirect('/admin/lowongan')->with('success', 'Berhasil menambahkan Data');
    }


    public function delete($id)
    {
    	$post = tb_lowongan::find($id);
        $post->delete();
        return redirect('/admin/lowongan')->with('success', 'Berhasil menghapus Data');
    }

    // public function store(Request $request){
    //     $data =  new tb_lowongan;
    //     if($request->file ('file')){
    //         $file=$request->file('file');
    //         $filename=time().'.'.$file->getClientOriginalExtension();
    //         $request->file->move('storage/'. $filename);
    //         $data->file = $filename;  
    //     }
    //     $data->judul=$request->judul;
    //     //$data->lowongan=$request->lowongan;
    //     $data->save();
    //     return redirect('/admin/lowongan');


    // }





    public function detail($id)
    {
        $post = tb_lowongan::where('id_lowongan', $id)->first();
        return view('/lowongan/showlowongan', compact('post'));
    }


    public function edit($id){
        $post = tb_lowongan::find($id);
        return view('/lowongan/editlowongan', compact('post'));
    }

    public function update($id, Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'title_ina' => 'required|min:3',
        //     'content_ina' => 'required|min:8',
        //     'title_eng' => 'required|min:3',
        //     'content_eng' => 'required|min:8',
        //     'kategori' => 'required',
        //     'tanggal' => 'required'
        // ]);

        // $kategori = Kategori::find($request->kategori);

        // if($validator->fails()){
        //     return back()->withErrors($validator);
        // }

        $post = tb_lowongan::find($id);
        $arrImage = [];
        $idImage = [];

        $post->nama_perusahaan = $request->nama_perusahaan;
        $post->jenis_pekerjaan = $request->jenis_pekerjaan;
        $post->tgl_post = $request->tgl_post;
        //$post->title_slug = Str::slug($request->title_ina);
        //$post->status = 'aktif';
        //$post->tgl_post = $request->tgl_post;
        //$post->lowongan = $request->lowongan;


        if($request->file('lampiran')!=""){
            Storage::disk('public')->delete($post->lampiran);
            $file = $request->file('lampiran');
            $fileLocation = '/file/lowongan/';
            $filename = $file->getClientOriginalName();
            $path = $fileLocation."/".$filename;
            $post->lampiran = '/storage'.$path;
            $post->lampiran_name = $filename;
            Storage::disk('public')->put($path, file_get_contents($file));
        }

        if($request->file('thumbnail')!=""){
            Storage::disk('public')->delete($post->thumbnail);
            $file = $request->file('thumbnail');
            $fileLocation = '/image/lowongan/';
            $filename = $file->getClientOriginalName();
            $path = $fileLocation."/".$filename;
            $post->thumbnail = '/storage'.$path;
            $post->thumbnail_name = $filename;
            Storage::disk('public')->put($path, file_get_contents($file));
        }

        
        $detail = $request->lowongan;
        libxml_use_internal_errors(true);
        $dom = new \domdocument();
        //$dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        $postImage = tb_lowongan::where('id_lowongan','=', $id)->get();

        //variabel dummy
                $arrsrc = [];
                $arrfoto = [];
                $status = '';
        //variabel dummy

        foreach ($images as $count => $image) {
            $src = $image->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimeType = $groups['mime'];
                $path = '/image/lowongan/'.$post->lowongan_lower.'/'.$post->judul.'/content/'. uniqid('', true) . '.' . $mimeType;
                Storage::disk('public')->put($path, file_get_contents($src));
                $image->removeAttribute('src');
                $link = asset('storage'.$path);
                $image->setAttribute('src', $link);
                array_push($arrImage, $path);
            }
            if($postImage != null){
                foreach($postImage as $item){
                    $src = str_replace('/',' ',$src);
                    $item->image = str_replace(' ','%20',$item->image);
                    $item->image = str_replace('/', ' ',$item->image);
                    array_push($arrsrc, $src);
                    array_push($arrfoto, $item->image);
                    if(preg_match('/'.$item->image.'/',$src)){
                        array_push($arrsrc, 'true');
                        array_push($idImage, $item->id);
                    break;
                    }
                }   
            }
        }

        // $postImages = PostImage::whereNotIn('id', $idImage)->where('id_post',$id)->get();
        // PostImage::whereNotIn('id', $idImage)->where('id_post',$id)->delete();
        // foreach($postImages as $item){
        //     Storage::disk('public')->delete($item->image);
        // }

        $detail = $dom->savehtml();
        $post->lowongan = $detail;
        $post->update();

        // foreach($arrImage as $item){
        //     $pageImage = new PostImage();
        //     $pageImage->id_post = $post->id;
        //     $pageImage->image = $item;
        //     $pageImage->save();
        // }

        return redirect('/admin/lowongan')->with('statusInput', 'Post successfully updated from the record');
    }
}

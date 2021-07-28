<?php

namespace App\Http\Controllers;

use App\tb_pengumuman;
use App\tb_alumni;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramBotController extends Controller
{
    public function updatedActivity()
    {
        $activity = Telegram::getUpdates();
        dd($activity);
    }

    public function storeMessage($id, Request $request){
        
        //$test = tb_pengumuman::all();
        $alumni = tb_alumni::all();
        $pengumuman=tb_pengumuman::find($id);
        $text = $pengumuman->judul;
            // "Pengumuman\n"
            // . "<b>judul Pengumuman: </b>\n"
            // . "$text->judul;\n"
            // . "<b>Message: </b>\n"
            // . $text->perihal;
            foreach ($alumni as $alumni){
                // Telegram::sendMessage([
                //     'token' => env('TELEGRAM_BOT_TOKEN', ''),
                //     'parse_mode' => 'HTML',
                //     'chat_id' => $alumni->chat_id,
                //     'text' => $text
                // ]);
                $message = 'Pengumuman:'.$pengumuman->judul
                            . '\n'
                            .'Jenis Pengumuman:'.$pengumuman->jenis
                            .'Perihal Pengumuman:'.$pengumuman->perihal
                            .'Sifat Surat:'.$pengumuman->sifat_surat;
                //             .$pengumuman->lampiran;
                             //.$pengumuman->InputFile::createFromContents(file_get_contents($lampiran->getRealPath()), Str::random(10) . '.' . $lampiran->getClientOriginalExtension());
                             
               $url = "https://api.telegram.org/bot1624417891:AAFwIpCtR4rqQ5FtvvYuk_Q9G6DIM8KmHL0/sendMessage?chat_id=".$alumni->chat_id."&text=".$message;

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    $response = curl_exec ($ch);
                    $err = curl_error($ch);  //if you need
                    curl_close ($ch);
                    // return $response;
            }

        
        
            // dd($text);
        return redirect()->back()->with('statusInput','Data berhasil dikirim!');
    }

    public function sendPhoto()
    {
        return view('photo');
    }

    public function storePhoto(Request $request)
    {
        $request->validate([
            'file' => 'file|mimes:jpeg,png,gif'
        ]);

        $photo = $request->file('file');

        Telegram::sendPhoto([
            'token' => env('TELEGRAM_BOT_TOKEN', ''),
            'photo' => InputFile::createFromContents(file_get_contents($photo->getRealPath()), Str::random(10) . '.' . $photo->getClientOriginalExtension())
        ]);

        return redirect()->back();
    }
}
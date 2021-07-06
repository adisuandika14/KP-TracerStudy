<?php

namespace App\Http\Controllers;

use App\tb_pengumuman;
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

    // public function sendMessage()
    // {
    //     return view('telegram/message')->with('success','Data berhasil dikirim!');
    // }

    public function sendMessage()
    {
        return '584467570';
    }

    public function storeMessage(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required'
        ]);


        $text = "Fakultas Teknik\n"
            . "<b>judul Pengumuman: </b>\n"
            . "$request->judul\n"
            . "<b>Message: </b>\n"
            . $request->message;


        // $post = tb_pengumuman::where('id_pengumuman', $id)->first();

        // $post->notify(new telegram([
        //     'text' => "Judul Pengumuman " . $post->judul . "!",
        //     'text' => "Jenis Pengumuman " . $post->jenis . "!",
        //     'text' => "Perihal Pengumuman " . $post->perihal . "!",
        //     'text' => "Sifat Surat " . $post->judul . "!",

        // ]));

        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
            'parse_mode' => 'HTML',
            'text' => $text
        ]);

        return redirect()->back()->with('success','Data berhasil dikirim!');
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
            'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
            'photo' => InputFile::createFromContents(file_get_contents($photo->getRealPath()), Str::random(10) . '.' . $photo->getClientOriginalExtension())
        ]);

        return redirect()->back();
    }
}
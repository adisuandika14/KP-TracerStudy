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

    // public function sendMessage()
    // {
    //     return view('telegram/message')->with('success','Data berhasil dikirim!');
    // }

    public function sendMessage()
    {
        return '584467570';
    }

    public function storeMessage(Request $request){
        
        //$test = tb_pengumuman::all();
        $chat_id = tb_alumni::all();
        $text = tb_pengumuman::all();
            "Pengumuman\n"
            . "<b>judul Pengumuman: </b>\n"
            . "$text = $request->judul;\n"
            . "<b>Message: </b>\n"
            . $text->perihal;

        Telegram::sendMessage([
            'token' => env('TELEGRAM_BOT_TOKEN', ''),
            'parse_mode' => 'HTML',
            'chat_id' => $chat_id,
            'text' => $text
        ]);
        
            dd($text);
        //return redirect()->back()->with('success','Data berhasil dikirim!');
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
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class tb_notifikasi extends Model
{
    protected $table = 'tb_notifikasi';
    protected $primaryKey = 'id_notifikasi';
    protected $fillable = [
        'id_notifikasi','id_pengumuman','id_lowongan','id_prodi','notifikasi',
    ];

    public function relasiNotifikasitoPengumuman()
    {
        return $this->belongsTo('App\tb_pengumuman','id_pengumuman','id_pengumuman');
    }

    public function relasiNotifikasitoLowongan()
    {
        return $this->belongsTo('App\tb_lowongan','id_lowongan','id_lowongan');
    }

    public function relasiNotifikasitoProdi()
    {
        return $this->belongsTo('App\tb_prodi','id_prodi','id_prodi');
    }
}

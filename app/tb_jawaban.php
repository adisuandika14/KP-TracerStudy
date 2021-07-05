<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class tb_jawaban extends Model
{
    use SoftDeletes;
    protected $table = 'tb_jawaban';
    protected $primaryKey = 'id_jawaban';
    protected $fillable = [
        'id_jawaban','id_detail_kuesioner','id_alumni','jawaban','nama_alumni',
    ];

    public function relasijawabantoDetailkuesioner()
    {
        return $this->belongsTo('App\tb_detail_kuesioner','id_detail_kuesioner','id_detail_kuesioner');
    }

    public function relasiJawabantoAlumni()
    {
        return $this->belongsTo('App\tb_alumni','id_alumni','id_alumni');
    }
}

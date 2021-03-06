<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class tb_detail_kuesioner extends Model
{
    use SoftDeletes;
    protected $table = 'tb_detail_kuesioner';
    protected $primaryKey = 'id_detail_kuesioner';
    protected $fillable = [
        'id_detail_kuesioner','id_kuesioner','id_alumni','pertanyaan','jawaban_alumni',
    ];

    public function relasiDetailtoKuesioner()
    {
        return $this->belongsTo('App\tb_kuesioner','id_kuesioner','id_kuesioner');
    }

    public function relasiDetailtoAlumni()
    {
        return $this->belongsTo('App\tb_alumni','id_alumni','id_alumni');
    }
    public function relasiDetailtoOpsi()
    {
        return $this->belongsTo('App\tb_opsi','id_opsi','id_opsi');
    }

}

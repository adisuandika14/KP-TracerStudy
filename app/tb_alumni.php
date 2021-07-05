<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class tb_alumni extends Model
{
    protected $table = 'tb_alumni';
    protected $primaryKey = 'id_alumni';
    protected $fillable = [
        'id_alumni','id_kota','id_prodi','id_angkatan','id_gender','email_alumni','nama_alumni','tahun_lulus','tahun_wisuda','alamat_alumni','no_hp','id_line','id_telegram',
    ];

    public function relasiAlumniTokota()
    {
        return $this->belongsTo('App\tb_kota','id_kota','id_kota');
    }

    public function relasiAlumnitoProdi()
    {
        return $this->belongsTo('App\tb_prodi','id_prodi','id_prodi');
    }

    public function relasiDAlumnitoDetailKuesioner()
    {
        return $this->belongsTo('App\tb_detail_kuesioner','id_alumni','id_alumni');
    }

    public function relasiAlumnitoAngkatan()
    {
        return $this->belongsTo('App\tb_angkatan','id_angkatan','id_angkatan');
    }

    public function relasiAlumnitoGender()
    {
        return $this->belongsTo('App\tb_gender','id_gender','id_gender');
    }
    public function relasiAlumnitoJawaban()
    {
        return $this->belongsTo('App\tb_jawaban','id_jawaban','id_jawaban');
    }



    // function anggota_enum ($table, $field)
    // {
    //     $query = "SHOW COLUMN FROM".$table." LIKE '$field'";
    //     $row = $this->query("SHOW COLUMNS FROM ".$table."LIKE '$field'")->row()->type;
    //     $regex = "/'(.*?)'/";
    //     preg_match_all($regex, $row, $enum_array);
    //     $enum_fields = $enum_array[1];
    //     foreach ($enum_fields as $key=>value)
    //     {
    //         $enums[$value] = $value;
    //     }
    //     return $enums;
    // }



}

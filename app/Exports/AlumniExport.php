<?php

namespace App\Exports;

use App\tb_alumni;
use Maatwebsite\Excel\Concerns\FromCollection;

class AlumniExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return tb_alumni::all();
    }
}

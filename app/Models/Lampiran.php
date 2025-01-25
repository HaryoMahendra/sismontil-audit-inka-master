<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class Lampiran extends Model implements ContractsAuditable
{
    use Auditable;
    use HasFactory;

    protected $table = "lampiran";

    protected $guarded = [''];

    public function ofi()
    {
        return $this->belongsTo(Ofi::class, 'id', 'id_ofi');
    }
    public function ncr()
    {
        return $this->belongsTo(Ncr::class, 'id', 'id_ncr');
    }
}

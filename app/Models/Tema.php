<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class Tema extends Model implements ContractsAuditable
{
    use Auditable;
    use HasFactory;

    protected $table = "temas";

    protected $guarded = [''];

    public function ncr()
    {
        return $this->hasMany(Ncr::class);
    }
    public function ofi()
    {
        return $this->hasMany(Ofi::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class Departemen extends Model implements ContractsAuditable
{
    use HasFactory, Auditable; // Tambahkan trait Auditable
    protected $table = "departemen";
    protected $fillable = ['div_name', 'level'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable; // Menambahkan trait Auditable
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class Employee extends Model implements ContractsAuditable
{
    use HasFactory, Auditable; // Menambahkan trait Auditable

    protected $fillable = ['name', 'role_id', 'departement_id', 'nip', 'jabatan', 'username', 'password'];
}

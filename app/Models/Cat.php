<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipe_data_audit',
        'deskripsi_ofi',
        'tindakan_ofi',
        'temuan_ncr',
        'tindakan_ncr',
    ];
}

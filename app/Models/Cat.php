<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;

    protected $fillable = [
    'is_cat',
    'departemen',
    'penyelidikan',
    'perbaikan',
    'rencana',
    'verifikator',
    'tanggal',
];


}

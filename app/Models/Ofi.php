<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class Ofi extends Model implements ContractsAuditable
{
    use Auditable;
    use HasFactory;

    protected $table = "ofi";

    protected $guarded = [''];

    public function users()
    {
        return $this->belongsTo(User::class, 'objek_audit', 'id')->withTrashed();
    }

    public function tema()
    {
        return $this->belongsTo(Tema::class, 'tema_audit', 'id');
    }

    public function lampiran()
    {
        return $this->hasMany(Lampiran::class, 'id_ofi', 'id');
    }

    /*public function departemen()
    {
        return $this->belongsTo(Tema::class, 'objek_audit', 'id');
    }*/



    public function user_asal_dept()
    {
        return $this->belongsTo(User::class, 'asal_dept', 'id');
    }

    public function user_disposisi_diselesaikan_oleh()
    {
        return $this->belongsTo(User::class, 'disposisi_diselesaikan_oleh', 'id');
    }

    public function user_dept_ygmngrjkn()
    {
        return $this->belongsTo(User::class, 'dept_ygmngrjkn', 'id');
    }

    /* public function tlofi()
    {
        return $this->hasOne(TL::class, 'id_ofi', 'id_ofi');
    } */

    public static function generateCode()
    {
        $tahun = date('y');
        $period = sprintf("%02d", ceil(date('n') / 6));
        $lastCode = self::where('no_ofi', 'like', "{$tahun}/{$period}/%")->orderBy('no_ofi', 'desc')->first();
        if (!$lastCode) {
            $noUrut = 1;
        } else {
            $noUrut = (int) substr($lastCode->no_ofi, -3) + 1;
            if (substr($lastCode->no_ofi, 0, 2) != $tahun) {
                $noUrut = 1;
            }
        }
        $noUrut = str_pad($noUrut, 3, '0', STR_PAD_LEFT);
        return "{$tahun}/{$period}/{$noUrut}";
    }
}

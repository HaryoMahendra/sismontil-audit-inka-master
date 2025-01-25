<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class TLOfi extends Model implements ContractsAuditable
{
    use Auditable;
    use HasFactory;

    protected $table = "tlofi";

    public $primaryKey = 'id_formofitl';

    protected $fillable = [
        'id_ofi',
        'tl_usulanofi',
        'ttd_tlofi_oleh',
        'nama_pekerjatl',
        'tgl_tl',
        'uraian_verif',
        'hasil_verif',
        'ttd_tlofi_verif',
        'nama_verifikator',
        'tgl_verif',
        'eval_saran',
        'nama_evaluator',
        'skor',
        'rekom_tinjauan',
        'namasm_verifikator',
    ];

    public function ofi()
    {
        return $this->hasOne(Ncr::class, 'id_ofi', 'id_ofi');
    }
}

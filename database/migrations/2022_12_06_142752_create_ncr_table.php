<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ncr', function (Blueprint $table) {
            $table->id();
            $table->string('no_ncr')->nullable();
            $table->string('periode_audit')->nullable();
            $table->string('proses_audit')->nullable();
            $table->string('tema_audit')->nullable();
            $table->string('objek_audit', 50)->nullable();
            $table->string('name_objek_audit')->nullable();
            $table->string('status', 50)->nullable();
            $table->string('bab_audit', 100)->nullable();
            $table->string('dok_acuan', 100)->nullable();
            $table->string('uraian_ncr', 500)->nullable();
            $table->string('kategori', 10)->nullable();
            // $table->string('ttd_auditor')->nullable();
            $table->string('nama_auditor')->nullable();
            // $table->string('auditor_eksternal', 255)->nullable();
            $table->string('nip_penerbitan_auditor')->nullable();

            $table->date('tgl_terbitncr')->nullable();
            // $table->string('nama_auditor')->nullable();
            $table->date('tgl_deadline')->nullable();
            $table->string('id_auditor')->nullable();
            // $table->string('ttd_auditee')->nullable();
            $table->string('nama_diakui_m_sm')->nullable();
            $table->string('jabatan_diakui_m_sm')->nullable();
            $table->string('nip_m_sm')->nullable();

            // $table->string('ttd_auditee_gm_sm')->nullable();
            $table->string('nama_disetujui_sm_gm')->nullable();
            $table->string('jabatan_disetujui_sm_gm')->nullable();
            $table->string('nip_sm_gm')->nullable();
            $table->date('tgl_acc_gm')->nullable();
            $table->date('tgl_plan_action')->nullable();

            $table->string('akar_masalah', 500)->nullable();
            $table->string('uraian_perbaikan', 500)->nullable();
            $table->string('uraian_pencegahan', 500)->nullable();
            $table->date('tgl_action')->nullable();
            // $table->string('ttd_acc_gm2')->nullable();
            $table->string('nama_sm_verif')->nullable();
            $table->string('jabatan_disetujui_sm_gm2')->nullable();
            $table->string('nip_sm_gm2')->nullable();
            $table->date('tgl_acc_gm2')->nullable();
            $table->string('bukti')->nullable();

            $table->string('uraian_verif', 500)->nullable();
            $table->string('hasil_verif')->nullable();
            // $table->string('ttd_tl_verif_auditor')->nullable();
            $table->string('diverif_oleh_auditor')->nullable();
            $table->string('nip_tl_auditor')->nullable();

            $table->date('tgl_verif')->nullable();
            $table->string('verif_wm', 500)->nullable();
            // $table->string('hasil_verif_wm')->nullable();
            // $table->string('ttd_tl_verif_wm')->nullable();
            $table->string('diverif_oleh_wm')->nullable();
            $table->date('tgl_verif_wm')->nullable();
            $table->string('disetujui_oleh_admin')->nullable();
            $table->string('disetujui_oleh_auditee')->nullable();
            $table->string('disetujui_oleh_auditee2')->nullable();
            $table->string('disetujui_oleh_auditor')->nullable();
            $table->string('disetujui_oleh_wm')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ncr');
    }
};

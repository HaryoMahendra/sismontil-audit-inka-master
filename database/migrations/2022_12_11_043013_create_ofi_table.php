<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('ofi', function (Blueprint $table) {
            $table->id();
            $table->string('id_auditor')->nullable();
            $table->string('no_ofi')->nullable();
            $table->string('kepada')->nullable();
            $table->string('periode_audit')->nullable();
            $table->string('proses_audit', 10)->nullable();
            $table->string('tema_audit', 10)->nullable();
            $table->string('objek_audit', 50)->nullable();
            $table->string('name_objek_audit')->nullable();
            $table->date('tgl_terbitofi')->nullable();
            $table->date('tgl_deadline')->nullable();
            $table->string('dari_bagian_dept', 100)->nullable();
            $table->string('proyek', 50)->nullable();
            $table->string('usulan_peningkatan', 500)->nullable();
            $table->string('identitas', 200)->nullable();
            $table->string('no_identitas', 200)->nullable();
            $table->string('dept_ygmngrjkn', 100)->nullable();
            $table->string('uraian_permasalahan', 500)->nullable();
            $table->string('uraian_peningkatan', 500)->nullable();
            // $table->string('ttd_dept_pengusul')->nullable();
            $table->string('diusulkan_oleh')->nullable();
            // $table->string('auditor_eksternal', 255)->nullable();
            $table->date('tgl_diusulkan')->nullable();
            $table->string('submit_auditor')->nullable();
            $table->string('nip_auditor')->nullable();

            $table->string('nama_disetujui_oleh', 100)->nullable();
            $table->string('jabatan_disetujui_oleh', 100)->nullable();
            $table->date('tgl_disetujui_admin')->nullable();
            // $table->string('ttd_M_SM')->nullable();
            $table->string('nip_penerbitan_admin')->nullable();
            $table->string('verif_admin', 50)->default('open');

            $table->string('disposisi', 100)->nullable();
            $table->string('disetujui_oleh', 100)->nullable();
            $table->string('disetujui_oleh_jabatan', 100)->nullable();
            $table->date('tgl_disetujui_wm')->nullable();
            // $table->string('ttd_diselesaikan_oleh')->nullable();
            $table->string('diselesaikan_oleh', 100)->nullable();
            $table->string('nip_wm')->nullable();

            $table->string('status_dokumen', 50)->nullable();

            $table->string('tl_usulanofi', 500)->nullable();
            // $table->string('ttd_ditindaklanjuti_oleh')->nullable();
            $table->string('nama_tl_oleh', 100)->nullable();
            $table->string('jabatan_tl_oleh', 100)->nullable();
            $table->string('nip_auditee')->nullable();
            $table->date('tgl_tl')->nullable();
            $table->string('bukti')->nullable();
            $table->string('lampiran1')->nullable();
            $table->string('lampiran2')->nullable();
            $table->string('lampiran3')->nullable();
            $table->string('lampiran4')->nullable();
            $table->string('lampiran5')->nullable();
            $table->string('lampiran6')->nullable();
            $table->string('NamaLampiran1')->nullable();
            $table->string('NamaLampiran2', 200)->nullable();
            $table->string('NamaLampiran3', 200)->nullable();
            $table->string('NamaLampiran4', 200)->nullable();
            $table->string('NamaLampiran5', 200)->nullable();
            $table->string('NamaLampiran6', 200)->nullable();

            $table->string('submit_auditee', 50)->nullable();

            $table->string('status_tl_admin', 50)->nullable();
            $table->string('alasan', 500)->nullable();
            $table->string('submit_admin')->nullable();

            $table->string('uraian_verif', 500)->nullable();
            $table->string('hasil_verif', 500)->nullable();
            // $table->string('ttd_verifikasi')->nullable();
            $table->string('nama_verifikator', 100)->nullable();
            $table->date('tgl_verif')->nullable();
            $table->string('nip_tl_wm')->nullable();


            $table->timestamps();

            //$table->string('close_wm', 50)->nullable();


            // $table->string('asal_dept', 100)->nullable();
            //$table->string('usulan_ofi', 200)->nullable();
            // $table->string('disetujui_oleh_jabatan_nm')->nullable();
            //$table->string('disposisi_diselesaikan_oleh', 100)->nullable();
            // $table->string('eval_saran', 500)->nullable();
            // $table->string('nama_evaluator', 100)->nullable();
            // $table->string('skor', 5)->nullable();
            // $table->string('rekom_tinjauan', 500)->nullable();
            // $table->string('namasm_verifikator', 100)->nullable();
            //$table->string('verif_wm', 100)->nullable();
            // $table->string('jenis_temuan', 25)->nullable();
            // $table->string('dokumen', 5)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ofi');
    }
};

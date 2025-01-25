<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Ncr;
use App\Models\Ofi;
use App\Models\TLNcr;
use App\Models\TLOfi;
use App\Models\Role;
use Illuminate\Support\Facades\Crypt;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'role' => "Admin"
        ]);
        Role::create([
            'role' => "Auditor"
        ]);
        Role::create([
            'role' => "Auditee"
        ]);
        Role::create([
            'role' => "Wakil Manajemen"
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => "Admin1",
        //     'jabatan' => null,
        //     'role_id' => "1",
        //     'departement_id' => null,
        //     'username' => "Admin1",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // seeders auditeeeeee
        // \App\Models\User::factory()->create([
        //     'name' => "Khoirul Istikana",
        //     'jabatan' => "Staf PKWT (Gol I)",
        //     'role_id' => "3",
        //     'departement_id' => "INKA_DIV-KEU",
        //     'username' => "Khoirul Istikana",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => "Martha Adi Afrianto",
        //     'jabatan' => "Spesialis Pratama",
        //     'role_id' => "3",
        //     'departement_id' => "INKA_DIV-KEU",
        //     'username' => "Martha Adi Afrianto",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => "Guntarto Budi Rohmadi",
        //     'jabatan' => "Manager Operasional dan Infrastruktur Teknologi Informasi",
        //     'role_id' => "3",
        //     'departement_id' => "INKA_DIV-KEU",
        //     'username' => "Guntarto Budi Rohmadi",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => "Arif Gunantoko",
        //     'jabatan' => "Senior Manager Dukungan Bisnis",
        //     'role_id' => "3",
        //     'departement_id' => "INKA_DIV-KEU",
        //     'username' => "Arif Gunantoko",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => "Hariesya Randi",
        //     'jabatan' => "Manager Fabrikasi",
        //     'role_id' => "3",
        //     'departement_id' => "INKA_DIV-KEU",
        //     'username' => "Hariesya Randi",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => "Rizky Firdaus",
        //     'jabatan' => "Manager Finishing",
        //     'role_id' => "3",
        //     'departement_id' => "INKA_DIV-KEU",
        //     'username' => "Rizky Firdaus",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => "Ridwan Al Rossid Budyantoro",
        //     'jabatan' => "Manager Kepatuhan dan Tata kelola Perusahaan",
        //     'role_id' => "3",
        //     'departement_id' => "INKA_DIV-KEU",
        //     'username' => "Ridwan Al Rossid",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => "Nobel Salman Syauqi",
        //     'jabatan' => "Staf",
        //     'role_id' => "3",
        //     'departement_id' => "INKA_DIV-KEU",
        //     'username' => "Nobel Salman Syauqi",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => "Diarekta Adi Putri",
        //     'jabatan' => "Staf (Gol I) Div. Pemasaran",
        //     'role_id' => "3",
        //     'departement_id' => "INKA_DIV-KEU",
        //     'username' => "Diarekta Adi Putri",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => "Denna Maulana",
        //     'jabatan' => "Manager Technology Process Management and RAMS",
        //     'role_id' => "3",
        //     'departement_id' => "INKA_DIV-KEU",
        //     'username' => "Denna Maulana",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => "Miranti Pranasantya",
        //     'jabatan' => "Staf (GOL II) Bag. Technology Process Management and RAMS",
        //     'role_id' => "3",
        //     'departement_id' => "INKA_DIV-KEU",
        //     'username' => "Miranti Pranasantya",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => "Gandi Widhi Artha",
        //     'jabatan' => "Staf (GOL II) Dep. Subsidiary Investment Planning",
        //     'role_id' => "3",
        //     'departement_id' => "INKA_DIV-KEU",
        //     'username' => "Gandi Widhi Artha",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => "Isrouf Gerio Pangestu",
        //     'jabatan' => "Staf (Gol I) Div. Produksi",
        //     'role_id' => "3",
        //     'departement_id' => "INKA_DIV-KEU",
        //     'username' => "Isrouf Gerio Pangestu",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => "Badrun Fatkhul Rohman",
        //     'jabatan' => "Staf (Gol I) Div. Produksi",
        //     'role_id' => "3",
        //     'departement_id' => "INKA_DIV-KEU",
        //     'username' => "Badrun Fatkhul Rohman",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => "Stiaji Triade Priantoro",
        //     'jabatan' => "Spesialis Muda - Div. Satuan Pengawasan Intern",
        //     'role_id' => "3",
        //     'departement_id' => "INKA_DIV-KEU",
        //     'username' => "Stiaji Triade Priantoro",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => "Bagoes Imam Prakoso",
        //     'jabatan' => "Manager Perencanaan Pengadaan",
        //     'role_id' => "3",
        //     'departement_id' => "INKA_DIV-KEU",
        //     'username' => "Bagoes Imam Prakoso",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => "Didik Hendriatna",
        //     'jabatan' => "Spesialis Muda - Dep. Hubungan Masyarakat dan Kantor Perwakilan",
        //     'role_id' => "3",
        //     'departement_id' => "INKA_DIV-KEU",
        //     'username' => "Didik Hendriatna",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => "Dekanita Estrie Paksi",
        //     'jabatan' => "Staf (GOL II) Unit Perencanaan Proses Produksi",
        //     'role_id' => "3",
        //     'departement_id' => "INKA_DIV-KEU",
        //     'username' => "Dekanita Estrie Paksi",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => "Hasti Lucia Rini",
        //     'jabatan' => "Staf (GOL II) Bag. Quality Management",
        //     'role_id' => "3",
        //     'departement_id' => "INKA_DIV-KEU",
        //     'username' => "Hasti Lucia Rini",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => "Widhi Nugraha",
        //     'jabatan' => "Staf (GOL I) Bag. Quality Management",
        //     'role_id' => "3",
        //     'departement_id' => "INKA_DIV-KEU",
        //     'username' => "Widhi Nugraha",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => "Ana Habibah",
        //     'jabatan' => "Staf (GOL II) Bag. Safety, Health, and Environment",
        //     'role_id' => "3",
        //     'departement_id' => "INKA_DIV-KEU",
        //     'username' => "Ana Habibah",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => "Rachma Wilis",
        //     'jabatan' => "Staf PKWT (GOL I) Bag. Safety, Health, and Environment",
        //     'role_id' => "3",
        //     'departement_id' => "INKA_DIV-KEU",
        //     'username' => "Rachma Wilis",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => "Surono",
        //     'jabatan' => "Spesialis Muda - Dep. Tanggung Jawab Sosial dan Lingkungan",
        //     'role_id' => "3",
        //     'departement_id' => "INKA_DIV-KEU",
        //     'username' => "Surono",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]); 
               
        // \App\Models\User::factory()->create([
        //     'name' => "Auditor1",
        //     'role_id' => "2",
        //     'departement_id' => null,
        //     'username' => "Auditor1",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => "Auditee1",
        //     'role_id' => "3",
        //     'departement_id' => null,
        //     'username' => "Auditee1",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => "WakilManajemen1",
        //     'role_id' => "4",
        //     'departement_id' => null,
        //     'username' => "WakilManajemen1",
        //     'nip' => null,
        //     'password' => Hash::make('123'),
        // ]);

        // for ($i = 1; $i <= 3; $i++) {
        //     Ncr::create([
        //         'id_ncr' => $i,
        //         'no_ncr' => '123',
        //         'proses_audit' => 'Internal',
        //         'tema_audit' => 'ISO 9001',
        //         'objek_audit' => $i == 2 ? '4' : '3',
        //         'jenis_temuan' => 'Ketidaksesuaian',
        //         'dokumen' => '',
        //         'tgl_terbitncr' => '2022-11-12',
        //         'status' => $i == 2 ? 'Belum Ditindaklanjuti' : 'Sudah Ditindaklanjuti',
        //         'bukti' => '',
        //         'bab_audit' => '1',
        //         'dok_acuan' => '2',
        //         'uraian_ncr' => '3',
        //         'kategori' => 'Mayor',
        //         'nama_auditor' => '4',
        //         'tgl_deadline' => $i == 2 ? '2022-11-30' : '2022-11-14',
        //         'diakui_oleh' => '5',
        //         'disetujui_oleh' => '6',
        //         'tgl_accgm' => '2022-11-12',
        //         'tgl_planaction' => '2022-11-12',
        //     ]);

        //     TLNcr::create([
        //         'id_ncr' => $i,
        //         'akar_masalah' => '1',
        //         'uraian_perbaikan' => '2',
        //         'uraian_pencegahan' => '3',
        //         'tgl_action' => '2022-11-12',
        //         'tgl_accgm' => '2022-11-12',
        //         'uraian_verifikasi' => '4',
        //         'hasil_verif' => 'efektif',
        //         'verifikator' => '5',
        //         'tgl_verif' => '2022-11-12',
        //         'rekomendasi' => '6',
        //         'namasm_verif' => '7',
        //     ]);
        // }

        // for ($i = 1; $i <= 3; $i++) {
        //     Ofi::create([
        //         'id_ofi' => $i,
        //         'no_ofi' => '123',
        //         'proses_audit' => 'Eksternal',
        //         'tema_audit' => 'ISO 9001',
        //         'objek_audit' => $i != 2 ? '4' : '3',
        //         'jenis_temuan' => 'Ketidaksesuaian',
        //         'dokumen' => '',
        //         'tgl_terbitofi' => '2022-11-12',
        //         'status' => $i != 2 ? 'Belum Ditindaklanjuti' : 'Sudah Ditindaklanjuti',
        //         'bukti' => '',
        //         'asal_dept' => '1',
        //         'proyek' => '2',
        //         'dept_ygmngrjkn' => '4',
        //         'usulan_ofi' => '3',
        //         'uraian_permasalahan' => '5',
        //         'usulan_peningkatan' => '6',
        //         'dept_pengusul' => '7',
        //         'tgl_diusulkan' => '2022-11-12',
        //         'disetujui_oleh' => '8',
        //         'tgl_disetujui' => '2022-11-12',
        //         'disposisi' => 'OFI ditolak',
        //         'disposisi_diselesaikan_oleh' => '1',
        //         'tgl_deadline' => $i != 2 ? '2022-11-10' : '2022-11-14',
        //     ]);

        //     TLOfi::create([
        //         'id_ofi' => $i,
        //         'tl_usulanofi' => '1',
        //         'nama_pekerjatl' => '2',
        //         'tgl_tl' => '2022-11-12',
        //         'uraian_verif' => '3',
        //         'hasil_verif' => 'efektif',
        //         'nama_verifikator' => '5',
        //         'tgl_verif' => '2022-11-12',
        //         'eval_saran' => '6',
        //         'nama_evaluator' => '7',
        //         'skor' => '8',
        //         'rekom_tinjauan' => '9',
        //         'namasm_verifikator' => '10',
        //     ]);
        // }
    }
}

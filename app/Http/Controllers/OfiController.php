<?php

namespace App\Http\Controllers;

use App\Models\Ofi;
use App\Models\Tema;
//use App\Models\TLOfi;
use App\Models\User;
use App\Models\Lampiran;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Psy\CodeCleaner\FunctionContextPass;
use TypeError;

class OfiController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        
        $data = $this->getAPI();
        
        if ($user->role->role == 'Wakil Manajemen') {
            $ofi = Ofi::where('verif_admin', '!=', 'open')->get();
        } elseif ($user->role->role == 'Auditee') {
            $ofi = Ofi::where('disposisi', '=', 'OFI Diterima')->where('objek_audit', Auth::user()->departement_id)->get();
        } else if ($user->role->role == 'Auditor') {
            $ofi = Ofi::where('id_auditor', Auth::user()->id)->get();
        } else {
            $ofi = Ofi::all();
        }
        
        return view('ofi.index', ['ofi' => $ofi, 'user' => $user, 'departemen' => $data]);
    }
    
    public function api_status_ofi()
    {
        if (auth()->user()->role == 'Auditee') {
            $ofi = DB::select(DB::raw("SELECT * FROM (SELECT SUM(CASE WHEN status = 'Sudah Ditindaklanjuti' THEN 1 ELSE 0 END) AS jumlah_sudah, SUM(CASE WHEN status = 'Belum Ditindaklanjuti' THEN 1 ELSE 0 END) AS jumlah_belum, SUM(CASE WHEN status = 'Tindak Lanjut Belum Sesuai' THEN 1 ELSE 0 END) AS jumlah_tidak FROM ofi WHERE objek_audit = '" . auth()->user()->id . "') AS aa"));
        } else {
            $ofi = DB::select(DB::raw("SELECT * FROM (SELECT SUM(CASE WHEN status = 'Sudah Ditindaklanjuti' THEN 1 ELSE 0 END) AS jumlah_sudah, SUM(CASE WHEN status = 'Belum Ditindaklanjuti' THEN 1 ELSE 0 END) AS jumlah_belum, SUM(CASE WHEN status = 'Tindak Lanjut Belum Sesuai' THEN 1 ELSE 0 END) AS jumlah_tidak FROM ofi) AS aa"));
        }
        // $ofi = Ofi::selectRaw('COUNT(id_ofi) AS jumlah, status AS name')
        //     ->where('status', '=', 'Sudah Ditindaklanjuti')
        //     ->orWhere('status', '=', 'Belum Ditindaklanjuti')
        //     ->groupBy('status')
        //     ->get();

        return json_encode($ofi);
    }

    public function create()
    {
        // $tgl_deadline = Carbon::now()->addDays(60);
        $usersAuditee = User::where('role_id', '=', '3')->get();
        $usersTema = Tema::all();

        // $departemen = User::where('departement_id', '!=', null)->distinct('departement_id')->pluck('departement_id');

        $pegawai = $this->getAPIPEG();

        $exceptionKey = [
            'DIREKTORAT',
            'MULTI',
            'DEWAN',
            'REKA',
            'DIVISI',
            'STADLER',
            'TSG',
        ];

        $data = $this->removeKey($exceptionKey);

        return view('ofi.create', ['usersAuditee' => $usersAuditee, 'usersTema' => $usersTema, 'data' => $data, 'pegawai' => $pegawai]);
    }

    public function store(Request $request)
    { 
        $user = User::where('id', Auth::user()->id)->first();

        $data = $this->getAPI();

        $div_id_user = $request->objek_audit;
        $divcode_user = null;

        if ($request->proses_audit == 'Eksternal') {
            $validator = Validator::make($request->only(
                [
                    'kepada',
                    'periode_audit',
                    'proses_audit',
                    'tema_audit',
                    'objek_audit',
                    'dari_bagian_dept',
                    'proyek',
                    'usulan_peningkatan',
                    'identitas',
                    'dept_ygmngrjkn',
                    'uraian_permasalahan',
                    'uraian_peningkatan',
                    'diusulkan_oleh',
                    'auditor_eksternal',
                    'tgl_diusulkan',
                ]
            ), [
                'kepada' => 'required',
                'periode_audit' => 'required',
                'proses_audit' => 'required',
                'tema_audit' => 'required',
                'objek_audit' => 'required',
                'dari_bagian_dept' => 'required',
                'proyek' => 'required',
                'usulan_peningkatan' => 'required',
                'identitas' => 'required',
                'dept_ygmngrjkn' => 'required',
                'uraian_permasalahan' => 'required',
                'uraian_peningkatan' => 'required',
                'diusulkan_oleh' => 'required',
                'auditor_eksternal' => 'required',
                'tgl_diusulkan' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->only(
                [
                    'kepada',
                    'periode_audit',
                    'proses_audit',
                    'tema_audit',
                    'objek_audit',
                    'dari_bagian_dept',
                    'proyek',
                    'usulan_peningkatan',
                    'identitas',
                    'dept_ygmngrjkn',
                    'uraian_permasalahan',
                    'uraian_peningkatan',
                    'diusulkan_oleh',
                    'tgl_diusulkan',
                ]
            ), [
                'kepada' => 'required',
                'periode_audit' => 'required',
                'proses_audit' => 'required',
                'tema_audit' => 'required',
                'objek_audit' => 'required',
                'dari_bagian_dept' => 'required',
                'proyek' => 'required',
                'usulan_peningkatan' => 'required',
                'identitas' => 'required',
                'dept_ygmngrjkn' => 'required',
                'uraian_permasalahan' => 'required',
                'uraian_peningkatan' => 'required',
                'diusulkan_oleh' => 'required',
                'tgl_diusulkan' => 'required',
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Harap masukkan data dengan benar !');
        } else {
            $selected_data = collect($data)->firstWhere('div_code', $div_id_user);

            if ($selected_data) {
                $div_id_user = $selected_data['id'];
                if ($selected_data['level'] == 3) {
                    $parent_id = $selected_data['parent_id'];
                    // Cari parent data
                    $parent_data = collect($data)->firstWhere('id', $parent_id);
                    if ($parent_data) {
                        $divcode_user = $parent_data['div_code'];
                    }
                } elseif ($selected_data['level'] == 2) {
                    $divcode_user = $selected_data['div_code'];
                }
            }

            Ofi::create([
                // 'no_ofi' => $noOfi,
                'kepada' => $request->kepada,
                'periode_audit' => $request->periode_audit,
                'proses_audit' => $request->proses_audit,
                'tema_audit' => $request->tema_audit,
                'objek_audit' => $divcode_user,
                // 'tgl_terbitofi' => Carbon::now(),
                // 'tgl_deadline' => Carbon::now()->addDays(60),
                'dari_bagian_dept' => $request->dari_bagian_dept,
                'proyek' => $request->proyek,
                'usulan_peningkatan' => $request->usulan_peningkatan,
                'identitas' => $request->identitas,
                'no_identitas' => $request->no_identitas,
                'dept_ygmngrjkn' => $request->dept_ygmngrjkn,
                'uraian_permasalahan' => $request->uraian_permasalahan,
                'uraian_peningkatan' => $request->uraian_peningkatan,
                'diusulkan_oleh' => $request->diusulkan_oleh,
                'auditor_eksternal' => $request->auditor_eksternal,
                'tgl_diusulkan' => $request->tgl_diusulkan,
                'id_auditor' => $user->id,
                'status_dokumen' => 'open',
                'nip_auditor' => $request->nip_auditor,
                'name_objek_audit' => $request->name_objek_audit
            ]);
        return redirect()->route('data-ofi.index')->with('success', 'Data berhasil ditambahkan !');
        }
    }


    public function show($id, Request $request)
    {
        $ofi = Ofi::where('id', $id)->first();
        $temas = Tema::all();
        $lampiran = Lampiran::where('id_ofi', $ofi->id)->get();

        // $departemen = User::where('departement_id', '!=', null)->distinct('departement_id')->pluck('departement_id');

        $jabatan = User::where('jabatan', '!=', null)->get();

        // $data = $this->getAPI();

        $pegawai = $this->getAPIPEG();


        $exceptionKey = [
            'DIREKTORAT',
            'MULTI',
            'DEWAN',
            'REKA',
            'DIVISI',
            'STADLER',
            'TSG',
        ];

        $data = $this->removeKey($exceptionKey);

        return view('ofi.show', compact('ofi', 'temas', 'data', 'jabatan', 'pegawai', 'lampiran'));
    }

    public function update_auditor(Request $request, $id)
    {
        $data = $this->getAPI();

        $div_id_user = $request->objek_audit;
        $divcode_user = null;

        if ($request->proses_audit == 'Eksternal') {
            $validator = Validator::make($request->only(
                [
                    'kepada',
                    'periode_audit',
                    'proses_audit',
                    'tema_audit',
                    'objek_audit',
                    'dari_bagian_dept',
                    'proyek',
                    'usulan_peningkatan',
                    'identitas',
                    'dept_ygmngrjkn',
                    'uraian_permasalahan',
                    'uraian_peningkatan',
                    'diusulkan_oleh',
                    'auditor_eksternal',
                    'tgl_diusulkan',
                ]
            ), [
                'kepada' => 'required',
                'periode_audit' => 'required',
                'proses_audit' => 'required',
                'tema_audit' => 'required',
                'objek_audit' => 'required',
                'dari_bagian_dept' => 'required',
                'proyek' => 'required',
                'usulan_peningkatan' => 'required',
                'identitas' => 'required',
                'dept_ygmngrjkn' => 'required',
                'uraian_permasalahan' => 'required',
                'uraian_peningkatan' => 'required',
                'diusulkan_oleh' => 'required',
                'auditor_eksternal' => 'required',
                'tgl_diusulkan' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->only(
                [
                    'kepada',
                    'periode_audit',
                    'proses_audit',
                    'tema_audit',
                    'objek_audit',
                    'dari_bagian_dept',
                    'proyek',
                    'usulan_peningkatan',
                    'identitas',
                    'dept_ygmngrjkn',
                    'uraian_permasalahan',
                    'uraian_peningkatan',
                    'diusulkan_oleh',
                    'tgl_diusulkan',
                ]
            ), [
                'kepada' => 'required',
                'periode_audit' => 'required',
                'proses_audit' => 'required',
                'tema_audit' => 'required',
                'objek_audit' => 'required',
                'dari_bagian_dept' => 'required',
                'proyek' => 'required',
                'usulan_peningkatan' => 'required',
                'identitas' => 'required',
                'dept_ygmngrjkn' => 'required',
                'uraian_permasalahan' => 'required',
                'uraian_peningkatan' => 'required',
                'diusulkan_oleh' => 'required',
                'tgl_diusulkan' => 'required',
            ]);
        }

        $ofi = Ofi::where('id', $id)->first();

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Harap masukkan data dengan benar !');
        } else {

            $selected_data = collect($data)->firstWhere('div_code', $div_id_user);

            if ($selected_data) {
                $div_id_user = $selected_data['id'];
                if ($selected_data['level'] == 3) {
                    $parent_id = $selected_data['parent_id'];

                    $parent_data = collect($data)->firstWhere('id', $parent_id);
                    if ($parent_data) {
                        $divcode_user = $parent_data['div_code'];
                    }
                } elseif ($selected_data['level'] == 2) {
                    $divcode_user = $selected_data['div_code'];
                }
            }

                $ofi->update([
                    'kepada' => $request->kepada,
                    'periode_audit' => $request->periode_audit,
                    'proses_audit' => $request->proses_audit,
                    'tema_audit' => $request->tema_audit,
                    'objek_audit' => $divcode_user,
                    'dari_bagian_dept' => $request->dari_bagian_dept,
                    'proyek' => $request->proyek,
                    'usulan_peningkatan' => $request->usulan_peningkatan,
                    'identitas' => $request->identitas,
                    'no_identitas' => $request->no_identitas,
                    'dept_ygmngrjkn' => $request->dept_ygmngrjkn,
                    'uraian_permasalahan' => $request->uraian_permasalahan,
                    'uraian_peningkatan' => $request->uraian_peningkatan,
                    // 'ttd_dept_pengusul' => $imageName,
                    'diusulkan_oleh' => $request->diusulkan_oleh,
                    'auditor_eksternal' => $request->auditor_eksternal,
                    'tgl_diusulkan' => $request->tgl_diusulkan,
                    'nip_auditor' => $request->nip_auditor,
                    'name_objek_audit' => $request->name_objek_audit
                ]);
                return redirect()->back()->with('success', 'Data audit berhasil disimpan!');
        }
    }

    public function update_penerbitan_admin(Request $request, $id)
    {
        $validator = Validator::make($request->only(
            [
                'nama_disetujui_oleh',
                'jabatan_disetujui_oleh',
            ]
        ), [
            'nama_disetujui_oleh' => 'required',
            'jabatan_disetujui_oleh' => 'required',
        ]);

        $ofi = Ofi::where('id', $id)->first();

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Harap masukkan data dengan benar !');
        } else {
                $ofi->update([
                    'nama_disetujui_oleh' => $request->nama_disetujui_oleh,
                    'jabatan_disetujui_oleh' => $request->jabatan_disetujui_oleh,
                    'nip_penerbitan_admin' => $request->nip_penerbitan_admin,
                ]);
                return redirect()->back()->with('success', 'Data audit berhasil disimpan!');
        }
    }

    public function update_penerbitan_wm(Request $request, $id)
    {
        // Validasi input
        if ($request->disposisi == 'OFI Ditolak') {
            $validator = Validator::make($request->only(
                [
                    'disposisi',
                ]
            ), [
                'disposisi' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->only(
                [
                    'disposisi',
                    'diselesaikan_oleh',
                ]
            ), [
                'disposisi' => 'required',
                'diselesaikan_oleh' => 'required',
            ]);
        }

        $ofi = Ofi::where('id', $id)->first();
        $user = User::where('role_id', '4')->first();

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Harap masukkan data dengan benar !');
        } else {
            if ($request->disposisi == 'OFI Ditolak') {
                $ofi->update([
                    'disposisi' => $request->disposisi,
                    'status_dokumen' => 'cancel',
                    'diselesaikan_oleh' => null,
                    'tgl_disetujui_wm' => null,
                    'disetujui_oleh' => null,
                    'disetujui_oleh_jabatan' => null,
                    'nip_wm' => null

                ]);
                return redirect()->route('data-ofi.index')->with('success', 'Data audit berhasil ditolak!');
            } else {
                $ofi->update([
                    'disposisi' => $request->disposisi,
                    'diselesaikan_oleh' => $request->diselesaikan_oleh,
                    'status_dokumen' => 'open',
                    'disetujui_oleh' => $user->name,
                    'disetujui_oleh_jabatan' => $user->jabatan,
                    'tgl_disetujui_wm' => Carbon::now(),
                    'nip_wm' => $user->nip 
                ]);
                return redirect()->route('data-ofi.index')->with('success', 'Data audit berhasil disetujui!');
            }
        }
    }

    public function update_auditee(Request $request, $id)
{
    $ofi = Ofi::where('id', $id)->first();
    $lampiran = Lampiran::where('id_ofi', $ofi->id)->get();
    
    $validator = Validator::make($request->only([
        'tl_usulanofi',
        'nama_tl_oleh',
        'jabatan_tl_oleh',
    ]), [
        'tl_usulanofi' => 'required',
        'nama_tl_oleh' => 'required',
        'jabatan_tl_oleh' => 'required',
    ]);

    $fileName = "";
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Harap masukkan data dengan benar !');
    }

    if ($request->has('deleted_lampiran')) {
        Lampiran::whereIn('id', $request->input('deleted_lampiran'))->delete();
    }
    
    if ($request->hasFile('lampiran')) {
        foreach ($request->file('lampiran') as $file) {
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/pdf', $fileName);
            $lampiran->nama_lampiran = $fileName;
            
            Lampiran::create([
                'nama_lampiran' => $fileName,
                'path' => 'public/pdf' . $fileName,
                'id_ofi' => $ofi->id,
            ]);
        }
    }
    
    // Update OFI
    $ofi->update([
        'tl_usulanofi' => $request->tl_usulanofi,
        'nama_tl_oleh' => $request->nama_tl_oleh,
        'nip_auditee' => $request->nip_auditee,
        'jabatan_tl_oleh' => $request->jabatan_tl_oleh,
        'nama_lampiran' => $fileName,
    ]);

    return redirect()->back()->with('success', 'Data audit berhasil disimpan!');
}


    public function update_tl_admin(Request $request, $id)
    {
        // Validasi input
        if ($request->status_tl_admin == 'Tolak') {
            $validator = Validator::make($request->only(
                [
                    'status_tl_admin',
                    'alasan',
                ]
            ), [
                'status_tl_admin' => 'required',
                'alasan' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->only(
                [
                    'status_tl_admin',
                ]
            ), [
                'status_tl_admin' => 'required',
            ]);
        }

        $ofi = Ofi::where('id', $id)->first();

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Harap masukkan data dengan benar !');
        } else {
            if ($request->status_tl_admin == 'Tolak') {
                $ofi->update([
                    'status_tl_admin' => $request->status_tl_admin,
                    'alasan' => $request->alasan,
                    'submit_auditee' => null,
                ]);
                return redirect()->route('data-ofi.index')->with('success', 'Data audit berhasil ditolak!');
            } else {
                $ofi->update([
                    'status_tl_admin' => $request->status_tl_admin,
                ]);
                return redirect()->route('data-ofi.index')->with('success', 'Data audit berhasil disetujui!');
            }
        }
    }

    public function update_tl_wm(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->only(
            [
                'uraian_verif',
                'hasil_verif',
            ]
        ), [
            'uraian_verif' => 'required',
            'hasil_verif' => 'required',
        ]);

        $ofi = Ofi::where('id', $id)->first();

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Harap masukkan data dengan benar !');
        } else {
                $ofi->update([
                    'uraian_verif' => $request->uraian_verif,
                    'hasil_verif' => $request->hasil_verif,
                ]);
                return redirect()->back()->with('success', 'Data audit berhasil disimpan!');
        }
    }

    public function destroy($id)
    {
        try {
            Ofi::where('id', $id)->delete();
            // TLNcr::where('id_ncr', $id)->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus data !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menghapus data !');
        }
    }

    public function release(Request $request, $ofi)
    {
        $ofi = Ofi::find($ofi);

        $year = date('y');
        $themeId = $ofi->tema->id;
        $theme = $ofi->tema->nama_tema;
        $process = $ofi->proses_audit;
        $period = $ofi->periode_audit;
        $lastOfi = Ofi::where('tema_audit', $themeId)
            ->where('proses_audit', $process)
            ->where('periode_audit', $period)
            ->whereRaw('YEAR(created_at) = ?', [date('Y')])
            ->orderBy('no_ofi', 'desc')
            ->first();

        if ($lastOfi && substr($lastOfi->no_ofi, -2) == $year && $lastOfi->periode_audit == $period && $lastOfi->proses_audit == $process && $lastOfi->tema_audit == $themeId) {
            $noUrut = str_pad((int) substr($lastOfi->no_ofi, 0, 3) + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $noUrut = '001';
        }

        $noOfi = $noUrut . '/' . substr($process, 0, 3) . '/' . $theme . '/' . 'OFI' . '/' . $period . '/' . $year;

        $ofi->update([
            'verif_admin' => 'release',
            'status_dokumen' => 'open',
            'no_ofi' => $noOfi,
            'tgl_terbitofi' => Carbon::now(),
            'tgl_deadline' => Carbon::now()->addDays(60),
            'tgl_disetujui_admin' => Carbon::now(),
        ]);

        return redirect()->route('data-ofi.index')->with('success', 'Data OFI berhasil dirilis');
    }

    // public function open($id)
    // {
    //     $ofi = Ofi::where('id', $id)->first();;
    //     $user = User::where('id', Auth::user()->id)->first();

    //     if ($ofi->disposisi == 'OFI Diterima') {
    //         $ofi->update([
    //             'status_dokumen' => 'open',
    //             'nip_wm' => $user->nip,
    //             'disetujui_oleh' => $user->name,
    //             'disetujui_oleh_jabatan' => $user->jabatan,
    //             'tgl_disetujui_wm' => Carbon::now(),
    //         ]);
    //     }

    //     return redirect()->route('data-ofi.index')->with('success', 'Dokumen Open');
    // }

    // public function cancel($id)
    // {
    //     $ofi = Ofi::where('id', $id)->first();
    //     $ofi->status_dokumen = 'cancel';
    //     $ofi->update(['status_dokumen' => 'cancel']);

    //     if ($ofi->status_dokumen == 'cancel') {
    //         $ofi->update(['tgl_disetujui_wm' => null]);
    //     }

    //     return redirect()->route('data-ofi.index')->with('success', 'Dokumen Cancel');
    // }

    public function close_wm($id)
    {
        $ofi = Ofi::where('id', $id)->first();;
        $user = User::where('role_id', '4')->first();

            $ofi->update([
                'status_dokumen' => 'close',
                'nama_verifikator' => $user->name,
                'nip_tl_wm' => $user->nip,
                'tgl_verif' => Carbon::now(),
            ]);

        return redirect()->route('data-ofi.index')->with('success', 'Dokumen Close');
    }

    public function submit_admin($id)
    {
        $ofi = Ofi::where('id', $id)->first();
        
        $ofi->update([
            'submit_admin' => 'submit',
        ]);

        return redirect()->route('data-ofi.index')->with('success', 'Dokumen Submit');
    }

    public function submit_auditor($id)
    {
        $ofi = Ofi::where('id', $id)->first();

        $ofi->update([
            'submit_auditor' => 'submit',
        ]);

        return redirect()->route('data-ofi.index')->with('success', 'Dokumen Submit');
    }

    public function submit(Request $request, $id) {
        
        $ofi = Ofi::where('id', $id)->first();

        $ofi->update([
            'submit_auditee' => 'submit',
            'tgl_tl' => Carbon::now(),
        ]);
            return redirect()->route('data-ofi.index')->with('success', 'Data OFI berhasil disubmit');
        }
    
    // public function getAPI()
    // {
    //     $apiUrl = env('API_URL_DEPT');
    //     $apiToken = config('services.api_token');

    //     $response = Http::withheaders([
    //         'Authorization' => 'Bearer' . $apiToken['token'],
    //     ])->get($apiUrl);

    //     $data = null;

    //     if (array_key_exists('status', $response->json())) {
    //         // if ($response->json()['status'] == 'Token is Expired') {
    //         $newToken = Http::post('https://ems.inka.co.id/api/login?nip=super_admin&password=rahasia');
    //         // dd(putenv('API_TOKEN=' . $newToken['token']));

    //         Config::set('services.api_token.token', $newToken['token']);

    //         // Optionally, you can save the configuration to the config file
    //         $configPath = config_path('services.php');
    //         file_put_contents($configPath, '<?php return ' . var_export(config('services'), true) . ';');

    //         $newRespon = Http::withheaders([
    //             'Authorization' => 'Bearer' . config('services.api_token')['token'],
    //         ])->get($apiUrl);

    //         $data = $newRespon;
    //         // }
    //     } else {
    //         $data = $response;
    //     }
    //     return $data->json()['data'];
    // }
    public function getAPI()
    {
        return \App\Models\Departemen::all();
    }

    // public function getAPIPEG()
    // {
    //     $apiUrl = env('API_URL_PEG');
    //     $apiToken = config('services.api_token');

    //     $response = Http::withheaders([
    //         'Authorization' => 'Bearer' . $apiToken['token'],
    //     ])->get($apiUrl);

    //     $data = null;

    //     if (array_key_exists('status', $response->json())) {
    //         // if ($response->json()['status'] == 'Token is Expired') {
    //         $newToken = Http::post('https://ems.inka.co.id/api/login?nip=super_admin&password=rahasia');
    //         // dd(putenv('API_TOKEN=' . $newToken['token']));

    //         Config::set('services.api_token.token', $newToken['token']);

    //         // Optionally, you can save the configuration to the config file
    //         $configPath = config_path('services.php');
    //         file_put_contents($configPath, '<?php return ' . var_export(config('services'), true) . ';');

    //         $newRespon = Http::withheaders([
    //             'Authorization' => 'Bearer' . config('services.api_token')['token'],
    //         ])->get($apiUrl);

    //         $data = $newRespon->json()['data'];
    //         // }
    //     } else {
    //         $data = $response->json()['data'];
    //     }

    //     $filteredData = array_map(function ($data) {
    //         return [
    //             'nip' => $data['nip'],
    //             'name' => $data['name'],
    //             'label' => $data['label']['label'] ?? null,
    //         ];
    //     }, $data);
        
    //     return $filteredData;
    // }
    public function getAPIPEG()
    {
        return \App\Models\User::all();
    }

    // public function removeKey($exceptionKey)
    // {
    //     $deptApi = $this->getAPI();
    //     $departemen = [];

    //     foreach ($deptApi as $dept) {

    //         if ($dept['level'] == 3 || $dept['level'] == 2) {
    //             $exceptionFound = false;

    //             foreach ($exceptionKey as $key) {
    //                 if (strpos($dept['div_name'], $key) !== false) {
    //                     $exceptionFound = true;
    //                     break;
    //                 }
    //             }

    //             if (!$exceptionFound) {
    //                 $departemen[] = $dept;
    //             }
    //         }
    //     }

    //     return $departemen;
    // }
    public function removeKey($exceptionKey)
{
    $departemen = $this->getAPI();
    $filteredDepartemen = [];
    foreach ($departemen as $dept) {
        $exceptionFound = false;
        foreach ($exceptionKey as $key) {
            if (strpos($dept->nama_departemen, $key) !== false) {
                $exceptionFound = true;
                break; 
            }
        }
        if (!$exceptionFound) {
            $filteredDepartemen[] = $dept;
        }
    }
    return $filteredDepartemen;
}


    public function print(Ofi $ofi)
    {
        $data = $this->getAPI();
        $lampiran = Lampiran::where('id_ofi', $ofi->id)->get();

        $qr1 = $ofi->nip_auditor . " - " . $ofi->diusulkan_oleh;
        $qr2 = $ofi->nip_penerbitan_admin . " - " . $ofi->nama_disetujui_oleh;
        $qr3 = $ofi->nip_wm . " - " . $ofi->disetujui_oleh;
        $qr4 = $ofi->nip_auditee . " - " . $ofi->nama_tl_oleh;
        $qr5 = $ofi->nip_tl_wm. "-" .$ofi->nama_verifikator;

        $noOfi = $ofi->no_ofi;
        $theme = $ofi->tema->nama_tema;
        $noOfiWithoutTheme = str_replace($theme . '/', '', $noOfi);

        $dompdf = Pdf::loadView('ofi.print', [
            'ofi' => $ofi,
            'departemen' => $data,
            'lampiran' => $lampiran,
            'qr1' => $qr1,
            'qr2' => $qr2,
            'qr3' => $qr3,
            'qr4' => $qr4,
            'qr5' => $qr5,
            
        ]);
        $dompdf->add_info('Title', 'Cetak OFI');
        $dompdf->setPaper('A3');
        return $dompdf->stream($noOfiWithoutTheme . '_' . $ofi->name_objek_audit . '.pdf');
    }

    public function excel()
    {
        $data = $this->getAPI();
        if (auth()->user()->role->role == 'Auditee') {
            $ofi = Ofi::where('objek_audit', '=', auth()->user()->departement_id)->get();
        } elseif (auth()->user()->role->role == 'Auditor'){
            $ofi = Ofi::where('id_auditor', Auth::user()->id)->get();
        }else {
            $ofi = Ofi::all();
        }

        return view('ofi.excel', ['ofi' => $ofi, 'departemen' => $data]);
    }
}

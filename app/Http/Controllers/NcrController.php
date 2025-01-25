<?php

namespace App\Http\Controllers;

use App\Models\Ncr;
use App\Models\Tema;
use App\Models\User;
use App\Models\Lampiran;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Psy\CodeCleaner\FunctionContextPass;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use TypeError;

class NcrController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // $exceptionKey = [
        //     'DIREKTORAT',
        //     'MULTI',
        //     'DEWAN',
        //     'REKA',
        //     'DIVISI',
        //     'STADLER',
        //     'TSG',
        // ];

        // $data = $this->removeKey($exceptionKey);
        $data = $this->getAPI();

        if ($user->role->role == 'Auditee') {
            $ncr = Ncr::where('disetujui_oleh_admin', '=', 'approve')->where('objek_audit', Auth::user()->departement_id)->get();
        } else if ($user->role->role == 'Wakil Manajemen') {
            $ncr = Ncr::where('disetujui_oleh_auditor', '!=', null)->get();
        } else if ($user->role->role == 'Auditor') {
            $ncr = Ncr::where('id_auditor', Auth::user()->id)->get();
        } else {
            $ncr = Ncr::all();
        }
        return view('ncr.index', ['ncr' => $ncr, 'user' => $user, 'departemen' => $data]);
    }

    public function api_status_ncr()
    {
        if (auth()->user()->role == 'Auditee') {
            $ncr = DB::select(DB::raw("SELECT * FROM (SELECT SUM(CASE WHEN status = 'Sudah Ditindaklanjuti' THEN 1 ELSE 0 END) AS jumlah_sudah, SUM(CASE WHEN status = 'Belum Ditindaklanjuti' THEN 1 ELSE 0 END) AS jumlah_belum, SUM(CASE WHEN status = 'Tindak Lanjut Belum Sesuai' THEN 1 ELSE 0 END) AS jumlah_tidak FROM ncr WHERE objek_audit = '" . auth()->user()->id . "') AS aa"));
        } else {
            $ncr = DB::select(DB::raw("SELECT * FROM (SELECT SUM(CASE WHEN status = 'Sudah Ditindaklanjuti' THEN 1 ELSE 0 END) AS jumlah_sudah, SUM(CASE WHEN status = 'Belum Ditindaklanjuti' THEN 1 ELSE 0 END) AS jumlah_belum, SUM(CASE WHEN status = 'Tindak Lanjut Belum Sesuai' THEN 1 ELSE 0 END) AS jumlah_tidak FROM ncr) AS aa"));
        }
        return json_encode($ncr);
    }

    public function create()
    {
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

        return view('ncr.create', ['data' => $data, 'usersAuditee' => $usersAuditee, 'usersTema' => $usersTema, 'pegawai' => $pegawai]);
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
                    'periode_audit',
                    'proses_audit',
                    'tema_audit',
                    'objek_audit',
                    'bab_audit',
                    'dok_acuan',
                    'uraian_ncr',
                    'kategori',
                    'nama_auditor',
                    'auditor_eksternal',
                ]
            ), [
                'periode_audit' => 'required',
                'proses_audit' => 'required',
                'tema_audit' => 'required',
                'objek_audit' => 'required',
                'bab_audit' => 'required',
                'dok_acuan' => 'required',
                'uraian_ncr' => 'required',
                'kategori' => 'required',
                'nama_auditor' => 'required',
                'auditor_eksternal' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->only(
                [
                    'periode_audit',
                    'proses_audit',
                    'tema_audit',
                    'objek_audit',
                    'bab_audit',
                    'dok_acuan',
                    'uraian_ncr',
                    'kategori',
                    'nama_auditor',
                ]
            ), [
                'periode_audit' => 'required',
                'proses_audit' => 'required',
                'tema_audit' => 'required',
                'objek_audit' => 'required',
                'bab_audit' => 'required',
                'dok_acuan' => 'required',
                'uraian_ncr' => 'required',
                'kategori' => 'required',
                'nama_auditor' => 'required',
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

            Ncr::create([
                'periode_audit' => $request->periode_audit,
                'proses_audit' => $request->proses_audit,
                'tema_audit' => $request->tema_audit,
                'objek_audit' => $divcode_user,
                'bab_audit' => $request->bab_audit,
                'dok_acuan' => $request->dok_acuan,
                'uraian_ncr' => $request->uraian_ncr,
                'kategori' => $request->kategori,
                'nama_auditor' => $request->nama_auditor,
                'auditor_eksternal' => $request->auditor_eksternal,
                'status' => 'Open',
                'id_auditor' => $user->id,
                'nip_penerbitan_auditor' => $request->nip_penerbitan_auditor,
                'name_objek_audit' => $request->name_objek_audit
            ]);
            // }
            return redirect()->route('data-ncr.index')->with('success', 'Data berhasil ditambahkan !');
        }
    }

    public function show($id)
    {
        $ncr = Ncr::where('id', $id)->first();
        $temas = Tema::all();
        $lampiran = Lampiran::where('id_ncr', $ncr->id)->get();

        // $departemen = User::where('departement_id', '!=', null)->distinct('departement_id')->pluck('departement_id');

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

        return view('ncr.show', compact('ncr', 'temas', 'data', 'pegawai', 'lampiran'));
    }

    public function edit($id)
    {
        $data = Ncr::where('id_ncr', $id)->first();

        $usersAuditee = User::where('role', '=', 'Auditee')->get();
        $usersTema = Tema::all();
        return view('ncr.auditor.edit', compact('data', 'usersAuditee', 'usersTema'));
    }

    public function update(Request $request, $ncr)
    {
        $data = $this->getAPI();

        $div_id_user = $request->objek_audit;
        $divcode_user = null;

        if ($request->proses_audit == 'Eksternal') {
            $validator = Validator::make($request->only(
                [
                    'periode_audit',
                    'proses_audit',
                    'tema_audit',
                    'objek_audit',
                    'bab_audit',
                    'dok_acuan',
                    'uraian_ncr',
                    'kategori',
                    'nama_auditor',
                    'auditor_eksternal',
                ]
            ), [
                'periode_audit' => 'required',
                'proses_audit' => 'required',
                'tema_audit' => 'required',
                'objek_audit' => 'required',
                'bab_audit' => 'required',
                'dok_acuan' => 'required',
                'uraian_ncr' => 'required',
                'kategori' => 'required',
                'nama_auditor' => 'required',
                'auditor_eksternal' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->only(
                [
                    'periode_audit',
                    'proses_audit',
                    'tema_audit',
                    'objek_audit',
                    'bab_audit',
                    'dok_acuan',
                    'uraian_ncr',
                    'kategori',
                    'nama_auditor',
                ]
            ), [
                'periode_audit' => 'required',
                'proses_audit' => 'required',
                'tema_audit' => 'required',
                'objek_audit' => 'required',
                'bab_audit' => 'required',
                'dok_acuan' => 'required',
                'uraian_ncr' => 'required',
                'kategori' => 'required',
                'nama_auditor' => 'required',
            ]);
        }

        $ncr = Ncr::where('id', $ncr)->first();

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

            $ncr->update([
                'periode_audit' => $request->periode_audit,
                'proses_audit' => $request->proses_audit,
                'tema_audit' => $request->tema_audit,
                'objek_audit' => $divcode_user,
                'bab_audit' => $request->bab_audit,
                'dok_acuan' => $request->dok_acuan,
                'uraian_ncr' => $request->uraian_ncr,
                'kategori' => $request->kategori,
                'nama_auditor' => $request->nama_auditor,
                'auditor_eksternal' => $request->auditor_eksternal,
                'nip_penerbitan_auditor' => $request->nip_penerbitan_auditor,
                'name_objek_audit' => $request->name_objek_audit
            ]);
            return redirect()->back()->with('success', 'Data audit berhasil diperbarui!');
        }
    }

    public function updateNcrAuditee(Request $request, $ncr)
    {
        $validator = Validator::make($request->only(
            [
                'nama_diakui_m_sm',
                'jabatan_diakui_m_sm',
                'nama_disetujui_sm_gm',
                'jabatan_disetujui_sm_gm',
            ]
        ), [
            'nama_diakui_m_sm' => 'required',
            'jabatan_diakui_m_sm' => 'required',
            'nama_disetujui_sm_gm' => 'required',
            'jabatan_disetujui_sm_gm' => 'required',
        ]);

        $ncr = Ncr::where('id', $ncr)->first();

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Harap masukkan data dengan benar !');
        } else {
            $ncr->update([
                'nama_diakui_m_sm' => $request->nama_diakui_m_sm,
                'jabatan_diakui_m_sm' => $request->jabatan_diakui_m_sm,
                'nama_disetujui_sm_gm' => $request->nama_disetujui_sm_gm,
                'jabatan_disetujui_sm_gm' => $request->jabatan_disetujui_sm_gm,
                'tgl_acc_gm' => Carbon::now(),
                'tgl_plan_action' => $ncr->tgl_deadline,
                'nip_m_sm' => $request->nip_m_sm,
                'nip_sm_gm' => $request->nip_sm_gm,

            ]);
            return redirect()->back()->with('success', 'Data audit berhasil disimpan!');
        }
    }

    public function updateNcrAuditee2(Request $request, $id)
    {
        $validator = Validator::make($request->only(
                [
                    'akar_masalah',
                    'uraian_perbaikan',
                    'uraian_pencegahan',
                    'nama_sm_verif',
                    'jabatan_disetujui_sm_gm2',
                ]
            ),
            [
                'akar_masalah' => 'required',
                'uraian_perbaikan' => 'required',
                'uraian_pencegahan' => 'required',
                'nama_sm_verif' => 'required',
                'jabatan_disetujui_sm_gm2' => 'required',
            ]
        );

        $ncr = Ncr::where('id', $id)->first();
        $lampiran = Lampiran::where('id_ncr', $ncr->id)->get();

        $fileName = "";
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Harap masukkan data dengan benar !');
            }

            // Menghapus lampiran yang dihapus dari request
            if ($request->has('deleted_lampiran')) {
                Lampiran::whereIn('id', $request->input('deleted_lampiran'))->delete();
            }
            
            // Mengunggah file baru dan menyimpannya
            if ($request->hasFile('lampiran')) {
                foreach ($request->file('lampiran') as $file) {
                    $fileName = $file->getClientOriginalName();
                    $file->storeAs('public/pdf', $fileName);
                    $lampiran->nama_lampiran = $fileName;
                    
                    // Simpan informasi lampiran ke dalam tabel 'lampirans'
                    Lampiran::create([
                        'nama_lampiran' => $fileName,
                        'path' => 'public/pdf' . $fileName,
                        'id_ncr' => $ncr->id,
                    ]);
                }
            }

            $ncr->update([
                'akar_masalah' => $request->akar_masalah,
                'uraian_perbaikan' => $request->uraian_perbaikan,
                'uraian_pencegahan' => $request->uraian_pencegahan,
                'nama_sm_verif' => $request->nama_sm_verif,
                'jabatan_disetujui_sm_gm2' => $request->jabatan_disetujui_sm_gm2,
                'tgl_acc_gm2' => Carbon::now(),
                'nama_lampiran' => $fileName,
                // 'disetujui_oleh_auditee2' => $request->approveAuditee2,
                // 'ttd_auditee_gm_sm' => $user->ttd,
                'tgl_action' => Carbon::now(),
                'nip_sm_gm2' => $request->nip_sm_gm2,
            ]);
            return redirect()->back()->with('success', 'Data audit berhasil disimpan!');
        }

    public function updateNcrAuditor2(Request $request, $ncr)
    {
        $validator = Validator::make(
            $request->only(
                [
                    'uraian_verif',
                    'hasil_verif',
                    'diverif_oleh_auditor',
                ]
            ),
            [
                'uraian_verif' => 'required',
                'hasil_verif' => 'required',
                'diverif_oleh_auditor' => 'required',
            ]
        );

        $ncr = Ncr::where('id', $ncr)->first();

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Harap masukkan data dengan benar !');
        } else {
            $ncr->update([
                'uraian_verif' => $request->uraian_verif,
                'hasil_verif' => $request->hasil_verif,
                'diverif_oleh_auditor' => $request->diverif_oleh_auditor,
                'tgl_verif' => Carbon::now(),
                'nip_tl_auditor' => $request->nip_tl_auditor,
            ]);
            return redirect()->back()->with('success', 'Data verifikasi berhasil disimpan!');
        }
    }

    public function updateNcrWM(Request $request, $ncr)
    {
        $validator = Validator::make(
            $request->only(
                [
                    'verif_wm',
                ]
            ),
            [
                'verif_wm' => 'required',
            ]
        );

        $ncr = Ncr::where('id', $ncr)->first();

        $user = User::where('role_id', '4')->first();

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Harap masukkan data dengan benar !');
        } else {
            $ncr->update([
                'verif_wm' => $request->verif_wm,
                'diverif_oleh_wm' => $user->name,
                'tgl_verif_wm' => Carbon::now(),
            ]);
            return redirect()->back()->with('success', 'Data audit berhasil disimpan!');
        }
    }

    public function index_form_ncr(Ncr $ncr)
    {
        $usersAuditee = User::where('role_id', '=', '3')->get();

        // $year = date('y');
        // $theme = $ncr->users_tema->name;
        // $process = $ncr->proses_audit;
        // $lastNcr = Ncr::where('tema_audit', $theme)
        //     ->where('proses_audit', $process)
        //     // ->where('year', $year)
        //     ->orderBy('no_ncr', 'desc')
        //     ->first();

        // if ($lastNcr && substr($lastNcr->no_ncr, 0, 2) == $year) {
        //     $noUrut = str_pad((int)substr($lastNcr->no_ncr, -3) + 1, 3, '0', STR_PAD_LEFT);
        // } else {
        //     $noUrut = '001';
        // }

        // $noNcr = $year . '/' . $process . '/' . $theme . '/' . $noUrut;
        // // $noNcr = $noUrut . '/' . substr($process, 0, 3) . '/' . $theme . '/' .'NCR'.' / '. $year;
        // $ncr->no_ncr = $noNcr;

        // $year = date('y');
        // $theme = $ncr->users_tema->name;
        // $process = $ncr->proses_audit;
        // $lastNcr = Ncr::where('tema_audit', $theme)
        //     ->where('proses_audit', $process)
        //     ->orderBy('no_ncr', 'desc')->first();

        // if ($lastNcr && substr($lastNcr->no_ncr, -2) == $year && $lastNcr->tema_audit == $theme && $lastNcr->proses_audit == $process) {
        //     $noUrut = str_pad((int)substr($lastNcr->no_ncr, 0, 3) + 1, 3, '0', STR_PAD_LEFT);
        // } else {
        //     $noUrut = '001';
        // }

        // $noNcr = $noUrut . '/' . substr($process, 0, 3) . '/' . $theme . '/' . 'NCR' . '/' . $year;
        // $ncr->no_ncr = $noNcr;

        // $year = date('y');
        // $theme = $ncr->tema_audit;
        // $process = $ncr->proses_audit;
        // $lastNcr = Ncr::where('tema_audit', $theme)
        //     ->where('proses_audit', $process)
        //     ->whereRaw('YEAR(created_at) = ?', [date('Y')])
        //     ->orderBy('no_ncr', 'desc')
        //     ->first();

        // if ($lastNcr && substr($lastNcr->no_ncr, -2) == $year && $lastNcr->proses_audit == $process && $lastNcr->tema_audit == $theme) {
        //     $noUrut = str_pad((int)substr($lastNcr->no_ncr, 0, 3) + 1, 3, '0', STR_PAD_LEFT);
        // } else {
        //     $noUrut = '001';
        // }

        // $noNcr = $noUrut . '/' . substr($process, 0, 3) . '/' . $theme . '/' . 'NCR' . '/' . $year;
        // $ncr->no_ncr = $noNcr;

        // $year = date('y');
        // $theme = $ncr->tema_audit;
        // $themename = DB::table('users')->where('id', $theme)->value('name');
        // $process = strtoupper($ncr->proses_audit);
        // $lastNcr = Ncr::where('tema_audit', $theme)
        //     ->where('proses_audit', $process)
        //     ->whereRaw('YEAR(created_at) = ?', [date('Y')])
        //     ->orderBy('no_ncr', 'desc')
        //     ->first();

        // if ($lastNcr && substr($lastNcr->no_ncr, -2) == $year && $lastNcr->proses_audit == $process && $lastNcr->tema_audit == $theme) {
        //     $noUrut = str_pad((int)substr($lastNcr->no_ncr, 0, 3) + 1, 3, '0', STR_PAD_LEFT);
        // } else {
        //     $noUrut = '001';
        // }

        // $noNcr = $noUrut . '/' . substr($process, 0, 3) . '/' . $themename . '/' . 'NCR' . '/' . $year;
        // $ncr->no_ncr = $noNcr;

        $year = date('y');
        $themeId = $ncr->tema_audit;
        $theme = DB::table('users')->where('id', $themeId)->value('username');
        $process = $ncr->proses_audit;
        $period = $ncr->periode_audit;
        $lastNcr = Ncr::where('tema_audit', $themeId)
            ->where('proses_audit', $process)
            ->where('periode_audit', $period)
            ->whereRaw('YEAR(created_at) = ?', [date('Y')])
            ->orderBy('no_ncr', 'desc')
            ->first();

        if ($lastNcr && substr($lastNcr->no_ncr, -2) == $year && $lastNcr->periode_audit == $period && $lastNcr->proses_audit == $process && $lastNcr->tema_audit == $themeId) {
            $noUrut = str_pad((int) substr($lastNcr->no_ncr, 0, 3) + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $noUrut = '001';
        }

        $noNcr = $noUrut . '/' . substr($process, 0, 3) . '/' . $theme . '/' . 'NCR' . '/' . $period . '/' . $year;
        $ncr->no_ncr = $noNcr;

        return view('ncr.formncr.edit', ['ncr' => $ncr, 'usersAuditee' => $usersAuditee]);
    }

    public function store_form_ncr(Request $request, Ncr $ncr)
    {
        $dataSent = $request->except('_token', 'bukti', 'ttd_auditor', 'ttd_auditee', 'ttd_auditee_gm_sm');

        $validator = Validator::make($request->all(), [
            'tgl_terbitncr' => 'nullable|after_or_equal:today',
            'tgl_accgm' => 'nullable|after_or_equal:today',
            'tgl_planaction' => 'nullable|after_or_equal:today',
            'bukti' => 'mimes:pdf',
            'ttd_auditor' => 'mimes:jpeg,jpg,png',
            'ttd_auditee' => 'mimes:jpeg,jpg,png',
            'ttd_auditee_gm_sm' => 'mimes:jpeg,jpg,png',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->with('error', 'Harap masukkan data dengan benar !');
        } else {
            if ($request->file('bukti')) {
                $dataSent['bukti'] = $request->file('bukti')->store('bukti-ncr', 'public');
            }

            if ($request->file('ttd_auditor')) {
                $dataSent['ttd_auditor'] = $request->file('ttd_auditor')->store('ttd_auditor', 'public');
            }

            if ($request->file('ttd_auditee')) {
                $dataSent['ttd_auditee'] = $request->file('ttd_auditee')->store('ttd_auditee', 'public');
            }

            if ($request->file('ttd_auditee_gm_sm')) {
                $dataSent['ttd_auditee_gm_sm'] = $request->file('ttd_auditee_gm_sm')->store('ttd_auditee_gm_sm', 'public');
            }

            Ncr::where('id', '=', $ncr->id)->update($dataSent);

            return redirect('data-ncr');
        }
    }

    public function index_edit(Ncr $ncr)
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();
        return view('ncr.edit', ['ncr' => $ncr, 'usersAuditee' => $usersAuditee]);
    }

    public function store_edit(Request $request, Ncr $ncr)
    {
        $dataSent = $request->except('_token', 'bukti', 'ttd_auditor', 'ttd_auditee', 'ttd_auditee_gm_sm');

        $validator = Validator::make($request->all(), [
            'tgl_terbitncr' => 'nullable|after_or_equal:today',
            'tgl_accgm' => 'nullable|after_or_equal:today',
            'tgl_planaction' => 'nullable|after_or_equal:today',
            'bukti' => 'mimes:pdf',
            'ttd_auditor' => 'mimes:jpeg,jpg,png',
            'ttd_auditee' => 'mimes:jpeg,jpg,png',
            'ttd_auditee_gm_sm' => 'mimes:jpeg,jpg,png',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->with('error', 'Harap masukkan data dengan benar !');
        } else {
            if ($request->file('bukti')) {
                $dataSent['bukti'] = $request->file('bukti')->store('bukti-ncr', 'public');
            }

            if ($request->file('ttd_auditor')) {
                $folderName = 'ttd_auditor';

                $dataSent['ttd_auditor'] = $request->file('ttd_auditor')->store('ttd_auditoradsf', 'public');
            }

            if ($request->file('ttd_auditee')) {
                $dataSent['ttd_auditee'] = $request->file('ttd_auditee')->store('ttd_auditee', 'public');
            }

            if ($request->file('ttd_auditee_gm_sm')) {
                $dataSent['ttd_auditee_gm_sm'] = $request->file('ttd_auditee_gm_sm')->store('ttd_auditee_gm_sm', 'public');
            }

            Ncr::where('id', '=', $ncr->id)->update($dataSent);

            return redirect('data-ncr');
        }
    }

    public function destroy($id)
    {
        try {
            Ncr::where('id', $id)->delete();
            // TLNcr::where('id_ncr', $id)->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus data !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menghapus data !');
        }
    }

    public function index_tlncr(Ncr $ncr, $ref_page = '')
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();

        return view('ncr.tlncr.edit', ['ncr' => $ncr, 'usersAuditee' => $usersAuditee, 'ref_page' => $ref_page]);
    }

    public function store_tlncr(Request $request, Ncr $ncr, $ref_page = '')
    {
        $validator = Validator::make($request->all(), [
            'tgl_terbitncr' => 'nullable|after_or_equal:today',
            'tgl_accgm' => 'nullable|after_or_equal:today',
            'tgl_planaction' => 'nullable|after_or_equal:today',
            'tgl_action' => 'nullable|after_or_equal:today',
            'tgl_accgm2' => 'nullable|after_or_equal:today',
            'tgl_verif' => 'nullable|after_or_equal:today',
            'tgl_verif_adm2' => 'nullable|after_or_equal:today',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->with('error', 'Harap masukkan data dengan benar !');
            $validator = Validator::make($request->all(), [
                'tgl_terbitncr' => 'nullable|after_or_equal:today',
                'tgl_accgm1' => 'nullable|after_or_equal:today',
                'tgl_planaction' => 'nullable|after_or_equal:today',
                'tgl_action' => 'nullable|after_or_equal:today',
                'tgl_accgm2' => 'nullable|after_or_equal:today',
                'tgl_verif' => 'nullable|after_or_equal:today',
                'tgl_verif_adm2' => 'nullable|after_or_equal:today',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->with('error', 'Harap masukkan data dengan benar !');
            }

            if (auth()->user()->role_id->role->role == 'Admin' || auth()->user()->role_id->role->role == 'Auditee') {
                $validatedDataNcr = $request->validate([
                    'diakui_oleh' => '',
                    'diakui_oleh_jabatan' => '',
                    'diakui_oleh_jabatan_nm' => '',
                    'disetujui_oleh1' => '',
                    'disetujui_oleh1_jabatan' => '',
                    'disetujui_oleh1_jabatan_nm' => '',
                    'tgl_accgm' => '',
                    'tgl_planaction' => '',
                    'status' => '',
                    'bukti' => 'mimes:pdf',
                    'ttd_auditor' => 'mimes:jpeg,jpg,png',
                    'ttd_auditee' => 'mimes:jpeg,jpg,png',
                    'ttd_auditee_gm_sm' => 'mimes:jpeg,jpg,png',
                ]);

                if ($request->file('bukti')) {
                    $validatedDataNcr['bukti'] = $request->file('bukti')->store('bukti-ncr', 'public');
                }

                if ($request->file('ttd_auditor')) {
                    $validatedDataNcr['ttd_auditor'] = $request->file('ttd_auditor')->store('ttd_auditor', 'public');
                }

                if ($request->file('ttd_auditee')) {
                    $validatedDataNcr['ttd_auditee'] = $request->file('ttd_auditee')->store('ttd_auditee', 'public');
                }

                if ($request->file('ttd_auditee_gm_sm')) {
                    $validatedDataNcr['ttd_auditee_gm_sm'] = $request->file('ttd_auditee_gm_sm')->store('ttd_auditee_gm_sm', 'public');
                }

                if (auth()->user()->role_id->role->role == 'Admin') {
                    $validatedDataNcr['no_ncr'] = $request->no_ncr;
                    // $validatedDataNcr['periode_audit'] = $request->periode_audit;
                    $validatedDataNcr['proses_audit'] = $request->proses_audit;
                    $validatedDataNcr['tema_audit'] = $request->tema_audit;
                    $validatedDataNcr['jenis_temuan'] = $request->jenis_temuan;
                    $validatedDataNcr['tgl_terbitncr'] = $request->tgl_terbitncr;
                    $validatedDataNcr['status'] = $request->status;

                    $validatedDataNcr['bab_audit'] = $request->bab_audit;
                    $validatedDataNcr['dok_acuan'] = $request->dok_acuan;
                    $validatedDataNcr['uraian_ncr'] = $request->uraian_ncr;
                    $validatedDataNcr['kategori'] = $request->kategori;
                    $validatedDataNcr['nama_auditor'] = $request->nama_auditor;
                    $validatedDataNcr['tgl_deadline'] = $request->tgl_deadline;
                }

                $validatedDataTLNcr = $request->validate([
                    'akar_masalah' => '',
                    'uraian_perbaikan' => '',
                    'uraian_pencegahan' => '',
                    'tgl_action' => '',
                    'disetujui_oleh2' => '',
                    'disetujui_oleh2_jabatan' => '',
                    'disetujui_oleh2_jabatan_nm' => '',
                    'tgl_accgm2' => '',
                    'ttd_tl_gm' => 'mimes:jpeg,jpg,png',
                    'ttd_tl_verif_auditor' => 'mimes:jpeg,jpg,png',
                    'ttd_tl_verif_adm' => 'mimes:jpeg,jpg,png',
                ]);

                if ($request->file('ttd_tl_gm')) {
                    $validatedDataTLNcr['ttd_tl_gm'] = $request->file('ttd_tl_gm')->store('ttd_tl_gm', 'public');
                }

                if ($request->file('ttd_tl_verif_auditor')) {
                    $validatedDataTLNcr['ttd_tl_verif_auditor'] = $request->file('ttd_tl_verif_auditor')->store('ttd_tl_verif_auditor', 'public');
                }

                if ($request->file('ttd_tl_verif_adm')) {
                    $validatedDataTLNcr['ttd_tl_verif_adm'] = $request->file('ttd_tl_verif_adm')->store('ttd_tl_verif_adm', 'public');
                }

                $validatedDataTLNcr['id'] = $ncr->id;

                if (auth()->user()->role_id->role->role == 'Admin') {
                    $validatedDataTLNcr['uraian_verifikasi'] = $request->uraian_verifikasi;
                    $validatedDataTLNcr['hasil_verif'] = $request->hasil_verif;
                    $validatedDataTLNcr['verifikator'] = $request->verifikator;
                    $validatedDataTLNcr['tgl_verif'] = $request->tgl_verif;
                    $validatedDataTLNcr['rekomendasi'] = $request->rekomendasi;
                    $validatedDataTLNcr['namasm_verif'] = $request->namasm_verif;
                    $validatedDataTLNcr['uraian_catatan_tkp'] = $request->uraian_catatan_tkp;
                }

                Ncr::where('id', '=', $ncr->id)->update($validatedDataNcr);
            }

            if (auth()->user()->role_id->role->role == 'Auditor') {
                $validatedDataTLNcr = $request->validate([
                    'ttd_tl_verif_auditor' => 'mimes:jpeg,jpg,png',
                ]);

                if ($request->file('ttd_tl_verif_auditor')) {
                    $validatedDataTLNcr['ttd_tl_verif_auditor'] = $request->file('ttd_tl_verif_auditor')->store('ttd_tl_verif_auditor', 'public');
                }

                $validatedDataTLNcr['uraian_verifikasi'] = $request->uraian_verifikasi;
                $validatedDataTLNcr['hasil_verif'] = $request->hasil_verif;
                $validatedDataTLNcr['verifikator'] = $request->verifikator;
                $validatedDataTLNcr['tgl_verif'] = $request->tgl_verif;
                $validatedDataTLNcr['id'] = $ncr->id;

                Ncr::where('id', '=', $ncr->id)->update([
                    'status' => $request->status,
                ]);
            }

            if (auth()->user()->role_id->role->role == 'Wakil Manajemen') {
                $validatedDataTLNcr = $request->validate([
                    'ttd_tl_verif_adm' => 'mimes:jpeg,jpg,png',
                ]);

                if ($request->file('ttd_tl_verif_adm')) {
                    $validatedDataTLNcr['ttd_tl_verif_adm'] = $request->file('ttd_tl_verif_adm')->store('ttd_tl_verif_adm', 'public');
                }

                $validatedDataTLNcr['rekomendasi'] = $request->rekomendasi;
                $validatedDataTLNcr['namasm_verif'] = $request->namasm_verif;
                $validatedDataTLNcr['uraian_catatan_tkp'] = $request->uraian_catatan_tkp;
                $validatedDataTLNcr['tgl_verif_adm2'] = $request->tgl_verif_adm2;

                $validatedDataTLNcr['id'] = $ncr->id;

                Ncr::where('id', '=', $ncr->id)->update([
                    'status' => $request->status,
                ]);
            }

            return redirect(!empty($ref_page) ? $ref_page : 'data-ncr');
        }
    }

    public function view_tlncr(Ncr $ncr, $ref_page = '')
    {
        $usersAuditee = User::where('role', '=', 'Auditee')->get();

        return view('ncr.tlncr.view', ['ncr' => $ncr, 'usersAuditee' => $usersAuditee, 'ref_page' => $ref_page]);
    }

    public function print(Ncr $ncr)
    {
        $qr1 = $ncr->nip_penerbitan_auditor . "-" . $ncr->nama_auditor;
        $qr2 = $ncr->nip_m_sm . "-" . $ncr->nama_diakui_m_sm;
        $qr3 = $ncr->nip_sm_gm . "-" . $ncr->nama_disetujui_sm_gm;
        $qr4 = $ncr->nip_sm_gm2 . "-" . $ncr->nama_sm_verif;
        $qr5 = $ncr->diverif_oleh_wm;
        $qr6 = $ncr->nip_tl_auditor . "-" . $ncr->diverif_oleh_auditor;

        $exceptionKey = [
            'DIREKTORAT',
            'MULTI',
            'DEWAN',
            'REKA',
            'DIVISI'
        ];

        $noNcr = $ncr->no_ncr;
        $theme = $ncr->tema->nama_tema;
        $noNcrWithoutTheme = str_replace($theme . '/', '', $noNcr);

        $data = $this->removeKey($exceptionKey);
        $lampiran = Lampiran::where('id_ncr', $ncr->id)->get();

        $dompdf = Pdf::loadView('ncr.print', [
            'ncr' => $ncr,
            'departemen' => $data,
            'lampiran' => $lampiran,
            'qr1' => $qr1,
            'qr2' => $qr2,
            'qr3' => $qr3,
            'qr4' => $qr4,
            'qr5' => $qr5,
            'qr6' => $qr6
        ]);

        $dompdf->add_info('Title', 'Cetak NCR');
        $dompdf->setPaper('A3');
        return $dompdf->stream($noNcrWithoutTheme . '_' . $ncr->name_objek_audit . '.pdf');
    }

    public function excel()
    {
        $data = $this->getAPI();
        if (auth()->user()->role->role == 'Auditee') {
            $ncr = Ncr::where('objek_audit', '=', auth()->user()->departement_id)->get();
        } elseif (auth()->user()->role->role == 'Auditor') {
            $ncr = Ncr::where('id_auditor', Auth::user()->id)->get();
        } else {
            $ncr = Ncr::all();
        }

        return view('ncr.excel', ['ncr' => $ncr, 'departemen' => $data]);
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
    public function approveAdmin(Request $request, $ncr)
    {
        $ncr = Ncr::where('id', $ncr)->first();

        $year = date('y');
        $themeId = $ncr->tema->id;
        $theme = $ncr->tema->nama_tema;
        $process = $ncr->proses_audit;
        $period = $ncr->periode_audit;
        $lastNcr = Ncr::where('tema_audit', $themeId)
            ->where('proses_audit', $process)
            ->where('periode_audit', $period)
            ->whereRaw('YEAR(created_at) = ?', [date('Y')])
            ->orderBy('no_ncr', 'desc')
            ->first();

        if ($lastNcr && substr($lastNcr->no_ncr, -2) == $year && $lastNcr->periode_audit == $period && $lastNcr->proses_audit == $process && $lastNcr->tema_audit == $themeId) {
            $noUrut = str_pad((int) substr($lastNcr->no_ncr, 0, 3) + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $noUrut = '001';
        }

        $noNcr = $noUrut . '/' . substr($process, 0, 3) . '/' . $theme . '/' . 'NCR' . '/' . $period . '/' . $year;

        $ncr->update([
            'no_ncr' => $noNcr,
            'disetujui_oleh_admin' => $request->approveAdmin,
            'tgl_terbitncr' => Carbon::now(),
            'tgl_deadline' => Carbon::now()->addDays(30),
        ]);

        return redirect()->back()->with('success', 'Data NCR berhasil dirilis!');
    }

    // public function approveAuditee(Request $request, $ncr)
    // {
    //     $ncr = Ncr::where('id', $ncr)->first();
    //     $user = User::where('id', Auth::user()->id)->first();

    //     $ncr->update([
    //         'disetujui_oleh_auditee' => $request->approveAuditee,
    //         'ttd_auditee' => $user->ttd,
    //         'tgl_plan_action' => $ncr->tgl_deadline,
    //     ]);

    //     return redirect()->back()->with('success', 'Form NCR berhasil diterbitkan!');
    // }

    // public function approveAuditee2(Request $request, $ncr)
    // {
    //     $ncr = Ncr::where('id', $ncr)->first();
    //     $user = User::where('id', Auth::user()->id)->first();

    //     $ncr->update([
    //         'disetujui_oleh_auditee2' => $request->approveAuditee2,
    //         'nama_disetujui_sm_gm' => $user->name,
    //         'jabatan_disetujui_sm_gm' => $user->jabatan,
    //         'ttd_auditee_gm_sm' => $user->ttd,
    //         'tgl_acc_gm' => Carbon::now(),
    //         'tgl_action' => Carbon::now(),
    //     ]);

    //     return redirect()->back()->with('success', 'Form NCR berhasil disubmit!');
    // }

    public function approveAuditor2(Request $request, $ncr)
    {
        $ncr = Ncr::where('id', $ncr)->first();
        $user = User::where('id', Auth::user()->id)->first();
        $ncr->update([
            'disetujui_oleh_auditor' => $request->approveAuditor2,
        ]);

        return redirect()->back()->with('success', 'Form NCR berhasil diapprove!');
    }

    public function approveWM(Request $request, $ncr)
    {
        $ncr = Ncr::where('id', $ncr)->first();
        $user = User::where('id', Auth::user()->id)->first();

        $ncr->update([
            'disetujui_oleh_wm' => $request->approvewm,
            'status' => 'Closed',
        ]);

        return redirect()->back()->with('success', 'Data NCR berhasil diclosed!');
    }
}

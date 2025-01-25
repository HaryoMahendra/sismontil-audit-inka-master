<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Ncr;
use App\Models\Ofi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role->role == 'Auditee') {
            $dataOpen = Ncr::where('status', 'Open')->where('disetujui_oleh_admin', 'approve')->where('objek_audit', Auth::user()->departement_id)->get()->count();
            $dataClose = Ncr::where('status', 'Closed')->where('objek_audit', Auth::user()->departement_id)->get()->count();

            $CloseEfektif = Ncr::where('hasil_verif', 'efektif')->where('objek_audit', Auth::user()->departement_id)->get()->count();
            $CloseTdkEfektif = Ncr::where('hasil_verif', 'tdk_efektif')->where('objek_audit', Auth::user()->departement_id)->get()->count();

            $dataOpen1 = Ofi::where('status_dokumen', 'open')->where('objek_audit', Auth::user()->departement_id)->get()->count();
            $dataClose1 = Ofi::where('status_dokumen', 'close')->where('objek_audit', Auth::user()->departement_id)->get()->count();
            $dataCancel1 = Ofi::where('status_dokumen', 'cancel')->where('objek_audit', Auth::user()->departement_id)->get()->count();

            $CloseEfektif1 = Ofi::where('hasil_verif', 'efektif')->where('objek_audit', Auth::user()->departement_id)->get()->count();
            $CloseTidakEfektif1 = Ofi::where('hasil_verif', 'tidak_efektif')->where('objek_audit', Auth::user()->departement_id)->get()->count();
        } elseif ($user->role->role == 'Auditor') {
            $dataOpen = Ncr::where('status', 'Open')->where('disetujui_oleh_admin', 'approve')->where('id_auditor', Auth::user()->id)->get()->count();
            $dataClose = Ncr::where('status', 'Closed')->where('id_auditor', Auth::user()->id)->get()->count();

            $CloseEfektif = Ncr::where('hasil_verif', 'efektif')->where('id_auditor', Auth::user()->id)->get()->count();
            $CloseTdkEfektif = Ncr::where('hasil_verif', 'tdk_efektif')->where('id_auditor', Auth::user()->id)->get()->count();

            $dataOpen1 = Ofi::where('status_dokumen', 'open')->where('id_auditor', Auth::user()->id)->get()->count();
            $dataClose1 = Ofi::where('status_dokumen', 'close')->where('id_auditor', Auth::user()->id)->get()->count();
            $dataCancel1 = Ofi::where('status_dokumen', 'cancel')->where('id_auditor', Auth::user()->id)->get()->count();

            $CloseEfektif1 = Ofi::where('hasil_verif', 'efektif')->where('id_auditor', Auth::user()->id)->get()->count();
            $CloseTidakEfektif1 = Ofi::where('hasil_verif', 'tidak_efektif')->where('id_auditor', Auth::user()->id)->get()->count();
        } else if ($user->role->role == 'Wakil Manajemen'){
            $dataOpen = Ncr::where('status', 'Open')->where('disetujui_oleh_auditor', 'approve')->count();
            $dataClose = Ncr::where('status', 'Closed')->get()->count();

            $CloseEfektif = Ncr::where('hasil_verif', 'efektif')->get()->count();
            $CloseTdkEfektif = Ncr::where('hasil_verif', 'tdk_efektif')->get()->count();

            $dataOpen1 = Ofi::where('status_dokumen', 'open')->get()->count();
            $dataClose1 = Ofi::where('status_dokumen', 'close')->get()->count();
            $dataCancel1 = Ofi::where('status_dokumen', 'cancel')->get()->count();

            $CloseEfektif1 = Ofi::where('hasil_verif', 'efektif')->get()->count();
            $CloseTidakEfektif1 = Ofi::where('hasil_verif', 'tidak_efektif')->get()->count();
        } else {
            $dataOpen = Ncr::where('status', 'Open')->get()->count();
            $dataClose = Ncr::where('status', 'Closed')->get()->count();

            $CloseEfektif = Ncr::where('hasil_verif', 'efektif')->get()->count();
            $CloseTdkEfektif = Ncr::where('hasil_verif', 'tdk_efektif')->get()->count();

            $dataOpen1 = Ofi::where('status_dokumen', 'open')->get()->count();
            $dataClose1 = Ofi::where('status_dokumen', 'close')->get()->count();
            $dataCancel1 = Ofi::where('status_dokumen', 'cancel')->get()->count();

            $CloseEfektif1 = Ofi::where('hasil_verif', 'efektif')->get()->count();
            $CloseTidakEfektif1 = Ofi::where('hasil_verif', 'tidak_efektif')->get()->count();
        }

        return view('dashboard', [
            'dataOpen' => $dataOpen,
            'dataClose' => $dataClose,
            'closeEfektif' => $CloseEfektif,
            'closeTdkEfektif' => $CloseTdkEfektif,
            'dataOpen1' => $dataOpen1,
            'dataCancel1' => $dataCancel1,
            'dataClose1' => $dataClose1,
            'closeEfektif1' => $CloseEfektif1,
            'closeTidakEfektif1' => $CloseTidakEfektif1,

        ]);
    }
}

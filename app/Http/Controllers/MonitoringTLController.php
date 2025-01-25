<?php

namespace App\Http\Controllers;

use App\Models\Nc;
use App\Models\Ncr;
use App\Models\Ofi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Illuminate\Http\Response;
use stdClass;

class MonitoringTLController extends Controller
{
    // public function index()
    // {
    //     $user = auth()->user();
    //     $data = $this->getAPI();

    //     if (auth()->user()->role->role == 'Auditee') {
    //         $ncr = Ncr::where('objek_audit', Auth::user()->departement_id)->where('disetujui_oleh_admin', '=', 'approve')->get();
    //         $ofi = Ofi::where('objek_audit', Auth::user()->departement_id)->where('disposisi', '!=', null)->get();
    //     } elseif (auth()->user()->role->role == 'Auditor') {
    //         $ncr = Ncr::where('id_auditor', Auth::user()->id)->where('disetujui_oleh_admin', '=', 'approve')->get();
    //         $ofi = Ofi::where('id_auditor', Auth::user()->id)->where('disposisi', '!=', null)->get();
    //     } else {
    //         $ncr = Ncr::where('disetujui_oleh_admin', '=', 'approve')->get();
    //         $ofi = Ofi::where('disposisi', '!=', null)->get();
    //     }

    //     return view('monitoring-tl.index', ['monitoringncr' => $ncr, 'monitoringofi' => $ofi, 'departemen' => $data, 'user' => $user]);
    // }
    public function index()
{
    $user = auth()->user();
    $data = $this->getAPI();  // Ambil data dari database lokal, bukan API

    if (auth()->user()->role->role == 'Auditee') {
        // Ambil data dari database lokal (misalnya tabel Ncr, Ofi, dsb)
        $ncr = Ncr::where('objek_audit', Auth::user()->departement_id)
                  ->where('disetujui_oleh_admin', '=', 'approve')
                  ->get();
        $ofi = Ofi::where('objek_audit', Auth::user()->departement_id)
                  ->where('disposisi', '!=', null)
                  ->get();
    } elseif (auth()->user()->role->role == 'Auditor') {
        $ncr = Ncr::where('id_auditor', Auth::user()->id)
                  ->where('disetujui_oleh_admin', '=', 'approve')
                  ->get();
        $ofi = Ofi::where('id_auditor', Auth::user()->id)
                  ->where('disposisi', '!=', null)
                  ->get();
    } else {
        $ncr = Ncr::where('disetujui_oleh_admin', '=', 'approve')->get();
        $ofi = Ofi::where('disposisi', '!=', null)->get();
    }

    return view('monitoring-tl.index', [
        'monitoringncr' => $ncr, 
        'monitoringofi' => $ofi, 
        'departemen' => $data, 
        'user' => $user
    ]);
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
            $data = DB::table('departemen')->get();  
            return $data;  
        }


    public function removeKey($exceptionKey)
    {
        $deptApi = $this->getAPI();
        $departemen = [];

        foreach ($deptApi as $dept) {

            if ($dept['level'] == 3) {
            $exceptionFound = false;

                foreach ($exceptionKey as $key) {
                    if (strpos($dept['div_name'], $key) !== false) {
                        $exceptionFound = true;
                        break;
                    }
                }

                if (!$exceptionFound) {
                    $departemen[] = $dept;
                }
            }
        }

        return $departemen;
    }

    // public function excel()
    // {
    //     $data = $this->getAPI();

    //     if (auth()->user()->role->role == 'Auditee') {
    //         $ncr = Ncr::where('objek_audit', Auth::user()->departement_id)->where('disetujui_oleh_admin', '=', 'approve')->get();
    //         $ofi = Ofi::where('objek_audit', Auth::user()->departement_id)->get();
    //         $monitoring = array_merge($ncr->toArray(), $ofi->toArray());
    //     } elseif (auth()->user()->role->role == 'Auditor') {
    //         $ncr = Ncr::where('id_auditor', Auth::user()->id)->where('disetujui_oleh_admin', '=', 'approve')->get();
    //         $ofi = Ofi::where('id_auditor', Auth::user()->id)->get();
    //         $monitoring = array_merge($ncr->toArray(), $ofi->toArray());
    //     } else {
    //         // $ncr = Ncr::where('disetujui_oleh_admin', '=', 'approve')->get();
    //         // $ofi = Ofi::get();
    //         $ncr = NCR::select('no_ncr', 'proses_audit','tema_audit', 'name_objek_audit', 'tgl_deadline', 'tgl_action', 'status');
    //         $ofi = OFI::select('no_ofi', 'proses_audit', 'tema_audit', 'name_objek_audit', 'tgl_deadline', 'tgl_tl', 'status_dokumen');
    //         $monitoring = $ncr->union($ofi)->get();
    //     }
    //     return view('monitoring-tl.excel', ['monitoring' => $monitoring, 'departemen' => $data]);
    // }

    public function excel()
    {
        // Membuat objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $ofi = Ofi::all();
        $ncr = Ncr::all();
        
        // Mengisi data untuk lembar kerja pertama
        $header1 = ['No', 'No. Ofi', 'Tgl. Terbit OFI', 'Klausul', 'Tema', 'Periode', 'Proses', 'Auditor', 'Departemen yang mengerjakan', 'Uraian Permasalahan', 'Usulan Peningkatan', 'Tindak Lanjut Usulan Peningkatan', 'Tgl. Tindak Lanjut Auditee', 'Uraian Verifikasi', 'Tgl. Verifikasi', 'Tgl. Deadline OFI', 'Status Dokumen'];
        $sheet1 = $spreadsheet->getActiveSheet()->fromArray($header1, null, 'A1');
        $sheet1->setTitle('OFI');
        // $sheet1 = $spreadsheet->getActiveSheet()->fromArray($header1, null, 'A1');
        
        $sheet1->getStyle('A1:O1')->getFont()->setBold(true);
        $sheet1->getStyle('A1:O1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet1->getStyle('A1:O1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet1->getStyle('A1:O1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');
        $sheet1->getStyle('A1:O1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        $row1 = 2;
        foreach ($ofi as $data_ofi) {
            $sheet1->setCellValue('A' . $row1, $row1 - 1); // Nomor
            $sheet1->setCellValue('B' . $row1, $data_ofi->no_ofi);
            $sheet1->setCellValue('C' . $row1, $data_ofi->tgl_terbitofi);
            $sheet1->setCellValue('D' . $row1, $data_ofi->no_identitas);
            $sheet1->setCellValue('E' . $row1, $data_ofi->tema->nama_tema);
            $sheet1->setCellValue('F' . $row1, $data_ofi->periode_audit);
            $sheet1->setCellValue('G' . $row1, $data_ofi->proses_audit);
            $sheet1->setCellValue('H' . $row1, $data_ofi->diusulkan_oleh);
            $sheet1->setCellValue('I' . $row1, $data_ofi->name_objek_audit);
            $sheet1->setCellValue('J' . $row1, $data_ofi->uraian_permasalahan);
            $sheet1->setCellValue('K' . $row1, $data_ofi->uraian_peningkatan);
            $sheet1->setCellValue('L' . $row1, $data_ofi->tl_usulanofi);
            $sheet1->setCellValue('M' . $row1, $data_ofi->tgl_tl);
            $sheet1->setCellValue('N' . $row1, $data_ofi->uraian_verif);
            $sheet1->setCellValue('O' . $row1, $data_ofi->tgl_verif);
            $sheet1->setCellValue('P' . $row1, $data_ofi->tgl_deadline);
            $sheet1->setCellValue('Q' . $row1, $data_ofi->status_dokumen);
            if ($data_ofi->status_dokumen == 'close') {
                $sheet1->setCellValue('Q' . $row1, $data_ofi->status_dokumen . ' ' . $data_ofi->hasil_verif);
            }
            $row1++;
        }

        // Mengisi data untuk lembar kerja kedua
        $header2 = ['No', 'No. NCR', 'Tgl. Terbit NCR', 'Dokumen Acuan', 'Tema Audit', 'Periode', 'Proses', 'Departemen yang diaudit', 'Nama Auditor', 'Uraian Ketidaksesuaian', 'Akar penyebab permasalahan', 'Uraian Perbaikan', 'Uraian Pencegahan untuk menjamin tidak terulang', 'Uraian Verifikasi', 'Tanggal Verifikasi Wakil Manajemen', 'Tgl. Deadline NCR', 'Status'];
        $sheet2 = $spreadsheet->createSheet()->fromArray($header2, null, 'A1');
        $sheet2->setTitle('NCR');
        // $sheet2 = $spreadsheet->getActiveSheet()->fromArray($header2, null, 'A1');

        $sheet2->getStyle('A1:O1')->getFont()->setBold(true);
        $sheet2->getStyle('A1:O1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet2->getStyle('A1:O1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet2->getStyle('A1:O1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('DDDDDD');
        $sheet2->getStyle('A1:O1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        $row2 = 2;
        foreach ($ncr as $data_ncr) {
            $sheet2->setCellValue('A' . $row2, $row2 - 1); // Nomor
            $sheet2->setCellValue('B' . $row2, $data_ncr->no_ncr);
            $sheet2->setCellValue('C' . $row2, $data_ncr->tgl_terbitncr);
            $sheet2->setCellValue('D' . $row2, $data_ncr->dok_acuan);
            $sheet2->setCellValue('E' . $row2, $data_ncr->tema->nama_tema);
            $sheet2->setCellValue('F' . $row2, $data_ncr->periode_audit);
            $sheet2->setCellValue('G' . $row2, $data_ncr->proses_audit);
            $sheet2->setCellValue('I' . $row2, $data_ncr->name_objek_audit);
            $sheet2->setCellValue('H' . $row2, $data_ncr->nama_auditor);
            $sheet2->setCellValue('J' . $row2, $data_ncr->uraian_ncr);
            $sheet2->setCellValue('K' . $row2, $data_ncr->akar_masalah);
            $sheet2->setCellValue('L' . $row2, $data_ncr->uraian_perbaikan);
            $sheet2->setCellValue('M' . $row2, $data_ncr->uraian_pencegahan);
            $sheet2->setCellValue('N' . $row2, $data_ncr->uraian_verif);
            $sheet2->setCellValue('O' . $row2, $data_ncr->tgl_verif_wm);
            $sheet2->setCellValue('P' . $row2, $data_ncr->tgl_deadline);
            $sheet2->setCellValue('Q' . $row2, $data_ncr->status);
            if ($data_ncr->status == 'Closed') {
                $sheet2->setCellValue('Q' . $row2, $data_ncr->status . ' ' . $data_ncr->hasil_verif);
            }
            $row2++;
        }

        $writer = new Xls($spreadsheet);

        $currentDateTime = Carbon::now()->format('Ymd');

        $filename = 'Cetak_Monitoring_OFI_dan_NCR_' . $currentDateTime . '.xls';
        $writer->save($filename);

        return response()->download($filename)->deleteFileAfterSend(true);
    }
}

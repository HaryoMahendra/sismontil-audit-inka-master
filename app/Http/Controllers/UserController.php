<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', '<>', 'tema')->get();

        $data = $this->getAPI();
        return view('users.index', ['users' => $users, 'title' => 'Pengguna', 'departemen' => $data]);
    }

    public function create()
    {
        $roles = Role::all();
        $pegawai = Employee::all();

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

        return view('users.add', ['title' => 'Pengguna', 'roles' => $roles, 'departemen' => $data, 'pegawai' => $pegawai]);
    }

    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'name' => 'required',
    //         'role_id' => 'required',
    //         'departement_id' => 'required_if:role_id,3',
    //         'username' => 'required',
    //         'nip' => 'required_if:role_id,2',          
    //         'ttd' => 'mimes:jpeg,jpg,png',
    //         'password' => 'required',
    //     ]);

    //     $image = $request->file('ttd');
    //     $imageNames = time() . '.' . $image->getClientOriginalExtension();
    //     $image->storeAs('public/ttd', $imageNames);

    //     if ($validatedData) {

    //         $user = new User();
    //         $user->name = $request->name;
    //         $user->role_id = $request->role_id;
    //         $user->departement_id = $request->departement_id;
    //         $user->nip = $request->nip;
    //         $user->jabatan = $request->jabatan;
    //         $user->ttd = $request->imageNames;
    //         $user->username = $request->username;
    //         $user->password = Hash::make($request->password);
    //         $user->save();
    //         return redirect()->route('user.index',)->with('success', 'Data berhasil ditambahkan!');
    //     } else {
    //         return back()->withErrors($validatedData)->withInput()->with('error', 'Harap masukkan data dengan benar !');
    //     }
    // }

    public function store(Request $request)
    {
        $user = new User();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'role_id' => 'required',
            'departement_id' => 'required_if:role_id,3',
            'nip' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {

            User::create([
                'name' => $request->name,
                'role_id' => $request->role_id,
                'departement_id' => $request->departement_id,
                'nip' => $request->nip,
                'jabatan' => $request->jabatan,
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);
        }
        return redirect()->route('user.index',)->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $exceptionKey = [
            'DIREKTORAT',
            'MULTI',
            'DEWAN',
            'REKA',
            'DIVISI',
            'STADLER',
            'TSG',
        ];
        $user = User::where('id', $id)->first();

        $data = $this->removeKey($exceptionKey);
        $pegawai = $this->getAPIPEG();
        $roles = Role::all();

        return view('users.edit', ['user' => $user, 'departemen' => $data, 'title' => 'Pengguna', 'roles' => $roles, 'pegawai' => $pegawai]);
    }

    public function update(Request $request, $id)
    {

        // if (empty($request->departement_id)) {
        //     $validatedData['departement_id'] = '';
        // }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'role_id' => 'required',
            'departement_id' => 'required_if:role_id,3',
            'nip' => "required_if:role_id,2",
            'username' => "required|unique:users,username,$id",
            // 'password' => 'required',
        ]);

        $user = User::findOrFail($id);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {

            $user->update([
                'name' => $request->name,
                'role_id' => $request->role_id,
                'departement_id' => $request->departement_id,
                'nip' => $request->nip,
                'jabatan' => $request->jabatan,
                'username' => $request->username,
                // 'password' => Hash::make($user->password),
            ]);
        }

        return redirect()->route('user.index')->with('success', 'Data berhasil diedit!');
    }

    public function destroy($id)
    {
        try {
            User::where('id', $id)->delete();
            // TLNcr::where('id_ncr', $id)->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus data !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Gagal menghapus data !');
        }
        return redirect()->back()->with('swal_msg', 'Hapus Data Berhasil');
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
        return \App\Models\Employee::select('nip', 'name', 'label')->get()->toArray();
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
        return \App\Models\Departemen::all()->toArray();
    }

    // public function removeKey($exceptionKey)
    // {
    //     $deptApi = $this->getAPI();
    //     $departemen = [];

    //     foreach ($deptApi as $dept) {

    //         if ($dept['level'] == 2 || $dept['level'] == 3) {
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

        $filteredDepartemen = array_filter($departemen, function ($dept) use ($exceptionKey) {
            $exceptionFound = false;

            foreach ($exceptionKey as $key) {
                if (strpos($dept['div_name'], $key) !== false) {
                    $exceptionFound = true;
                    break;
                }
            }

            return !$exceptionFound;
        });

        return array_values($filteredDepartemen); // Reset indeks array
    }
}

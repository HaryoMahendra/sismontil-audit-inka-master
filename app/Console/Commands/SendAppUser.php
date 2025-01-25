<?php

namespace App\Console\Commands;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class SendAppUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-app-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $api_url = config('app.log_url');
        $token = config('app.log_key');
        $client = new Client([
            'headers' => ['Content-Type' => 'application/json', 'Authorization' => 'Bearer ' . $token,],
            'verify'  => false
        ]);
        $users = User::all();
        foreach ($users as $key => $value) {
            $divisi = explode('-', $value->departement_id);
            $this->info($value->name);
            $response = $client->post($api_url . '/api/log/post-user-app', [
                'form_params' => [
                    'nama_aplikasi' => config('app.name'),
                    'nama' => $value->name,
                    'username' => $value->nip ?? $value->username,
                    'divisi' => count($divisi) > 1 ? $divisi[1] : "-",
                    'deleted_at' => $value->deleted_at,
                ]
            ]);
            $status = $response->getBody()->getContents();
            $this->info(json_encode($status));
        }
    }
}

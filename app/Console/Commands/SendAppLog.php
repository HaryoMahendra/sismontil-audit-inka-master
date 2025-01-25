<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use OwenIt\Auditing\Models\Audit;

class SendAppLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-app-log {--date= : The date to process (default: yesterday)}';

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
        $name = config('app.name');
        $url = config('app.url');
        $client = new Client([
            'headers' => ['Content-Type' => 'application/json', 'Authorization' => 'Bearer ' . $token,],
            'verify'  => false
        ]);
        $dateInput = $this->option('date');
        $date = $dateInput ? Carbon::parse($dateInput) : Carbon::yesterday();
        $data = Audit::join('users', 'users.id', 'audits.user_id')
            ->select('audits.*', 'users.nip', 'users.username', 'users.departement_id')
            ->whereDate("audits.created_at", $date)->whereNull('send_log')->get();
        foreach ($data as $key => $value) {
            $transaction = null;
            switch ($value->event) {
                case 'view':
                    $transaction = 'VIEW';
                    break;
                case 'login':
                    $transaction = 'AUTH';
                    break;
                case 'logout':
                    $transaction = 'AUTH';
                    break;
                default:
                    $transaction = 'TRANSACTION';
                    break;
            }
            if ($value->auditable_type == 'App\User' && ($value->event !== 'view'))
                $transaction = 'AUTH';
            try {
                $response = $client->post($api_url . '/api/log/post-log-app', [
                    'form_params' => [
                        'app_name' => $name,
                        'app_url' => $url,
                        'transaction_type' => $transaction,
                        'username' => $value->nip ?? $value->username,
                        'division' => $value->division_id ? trim($value->division_id) : "-",
                        'object_type' => json_encode($value),
                        'event_at' => $value->created_at->toDateTimeString(),
                    ]
                ]);
                $status = $response->getStatusCode();
                if ($status === 201) {
                    $value->send_log = Carbon::now();
                    $value->save();
                    $this->info("Send Log Success : " . Carbon::now()->toDateTimeString());
                } else {
                    $this->info("Send Log Failed : " . Carbon::now()->toDateTimeString());
                    Log::error('Post Log App Error: ' . $status);
                    continue;
                }
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                Log::error('Post Log App Client Error (HTTP 4xx): ' . $e->getMessage());
                $this->info("Client Error: Skipping log for {$value->nip}");
                continue;
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                Log::error('Post Log App Request Exception: ' . $e->getMessage());
                $this->info("Request Exception: Skipping log for {$value->nip}");
                continue;
            } catch (\Exception $e) {
                Log::error('Post Log App General Exception: ' . $e->getMessage());
                $this->info("General Exception: Skipping log for {$value->nip}");
                continue;
            }
        }
    }
}

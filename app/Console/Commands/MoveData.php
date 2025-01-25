<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MoveData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

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
        $data = DB::table('ofi')->select('id', 'lampiran1', 'lampiran2', 'lampiran3', 'lampiran4', 'lampiran5', 'lampiran6')->get();

    foreach ($data as $row) {
        $lampirans = [
            $row->lampiran1,
            $row->lampiran2,
            $row->lampiran3,
            $row->lampiran4,
            $row->lampiran5,
            $row->lampiran6,
        ];

        foreach ($lampirans as $lampiran) {
            if ($lampiran) {
                DB::table('lampiran')->insert([
                    'id_ofi' => $row->id,
                    'nama_lampiran' => $lampiran,
                ]);
            }
        }
    }

    $this->info('Data berhasil dipindahkan!');
    }
}

<?php

namespace App\Jobs;

use App\Models\State;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Exception;

class SeedStatesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {

            $client = app(Client::class);
            $payload = $client->get('https://servicodados.ibge.gov.br/api/v1/localidades/estados');
            $states = json_decode($payload->getBody()->getContents());

            foreach ($states as $state) {
                State::firstOrCreate([
                    'name' => $state->nome,
                    'uf' => $state->sigla
                ]);
            }

        } catch (\Exception $e){
            Log::info('Error to load and save states');
            Log::info($e->getMessage());
        }
    }
}

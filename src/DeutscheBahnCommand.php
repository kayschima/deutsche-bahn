<?php

namespace Kayschima\DeutscheBahn;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class DeutscheBahnCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deutsche-bahn:railway-station';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the id of a certain railway station of Deutsche Bahn';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param  \App\Support\DripEmailer  $drip
     * @return mixed
     */
    public function handle()
    {
        $station = $this->ask('What is the name of the DB rail station?');
        
        $response = Http::withToken(config('deutsche-bahn.api-token'))
        ->get('https://api.deutschebahn.com/fahrplan-plus/v1/location/'. Str::lower($station))
        ->json();

        foreach ($response as $station) {
            $this->info($station['id'] . ' : ' . $station['name']);
        }
    }
}

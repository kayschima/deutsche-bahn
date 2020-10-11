<?php

namespace Kayschima\DeutscheBahn;

use DateTime;
use Illuminate\Support\Facades\Http;

class DeutscheBahn
{
    public function getArrivals(string $station_id, DateTime $datetime = null)
    {
        $response = Http::withToken(config('deutsche-bahn.api-token'))
        ->get(
            'https://api.deutschebahn.com/fahrplan-plus/v1/arrivalBoard/'. $station_id,
            [
            'date' => $datetime ? $datetime->format('Y-m-d\TH:i') : ''
            ]
        )
        ->json();

        return collect($response);
    }
}

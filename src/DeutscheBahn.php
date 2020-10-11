<?php

namespace Kayschima\DeutscheBahn;

use DateTime;
use Illuminate\Support\Facades\Http;

/**
 * Class DeutscheBahn
 *
 * @package Kayschima\DeutscheBahn
 */
class DeutscheBahn
{
    /**
     * @param  string  $station_id
     * @param  DateTime|null  $datetime
     * @param  bool  $details
     *
     * @return array|mixed
     */
    public function getArrivals(string $station_id, DateTime $datetime = null, bool $details = false)
    {
        $response = Http::withToken(config('deutsche-bahn.api-token'))
                        ->get(
                            'https://api.deutschebahn.com/fahrplan-plus/v1/arrivalBoard/'.$station_id,
                            [
                                'date' => $datetime ? $datetime->format('Y-m-d\TH:i') : ''
                            ]
                        );

        $returnArray = [];

        if ( $response->successful()) {
            $returnArray = $response->json();

            if ($details) {
                foreach ($returnArray as $key => $item) {
                    $returnArray[$key]['details'] = $this->addDetails($item['detailsId']);
                }
            }
        }
        return $returnArray;
    }

    /**
     * @param  string  $station_id
     * @param  DateTime|null  $datetime
     * @param  bool  $details
     *
     * @return array|mixed
     */
    public function getDepartures(string $station_id, DateTime $datetime = null, bool $details = false)
    {
        $response = Http::withToken(config('deutsche-bahn.api-token'))
                        ->get(
                            'https://api.deutschebahn.com/fahrplan-plus/v1/departureBoard/'.$station_id,
                            [
                                'date' => $datetime ? $datetime->format('Y-m-d\TH:i') : ''
                            ]
                        );

        $returnArray = [];

        if ( $response->successful()) {
            $returnArray = $response->json();

            if ($details) {
                foreach ($returnArray as $key => $item) {
                    $returnArray[$key]['details'] = $this->addDetails($item['detailsId']);
                }
            }
        }
        return $returnArray;
    }

    /**
     * @param  string  $details_id
     *
     * @return array|mixed
     */
    private function addDetails(string $details_id)
    {
        $response = Http::withToken(config('deutsche-bahn.api-token'))
                        ->get('https://api.deutschebahn.com/fahrplan-plus/v1/journeyDetails/'. rawurlencode($details_id));

        if ( ! $response->successful()) {
            return [];
        } else {
            return $response->json();
        }
    }
}

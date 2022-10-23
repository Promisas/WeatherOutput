<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Attendance;
use App\Models\WeatherType;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Collection;

class WeatherTypeService
{
    public function printOutput($city): array
    {
        $list = [
            'City' => $this->findCity($city),
            'recommendations' => []
        ];

        foreach ($this->weatherDateSearch($city) as $weatherDateList) {
            $list['recommendations'][] = [
                'weather_forecast' => $weatherDate = key($weatherDateList),
                'date' => $weatherDateList[$weatherDate],
                'products' => $this->searchProducts($weatherDate)
            ];
        }

        return $list;
    }

    public function findCity(string $city): string
    {
        $url = Http::get('https://api.meteo.lt/v1/places/' . $city . '/forecasts/long-term')->json();
        $city = $url['place']['name'];

        return $city;
    }

    public function weatherDateSearch(string $city): array
    {
        $forecast = Http::get('https://api.meteo.lt/v1/places/' . $city . '/forecasts/long-term')->json();
        $dateCount = [];

        foreach ($forecast['forecastTimestamps'] as $timestamp) {
            $date = Carbon::parse($timestamp['forecastTimeUtc'])->format('Y-m-d');
            $threeDays = Carbon::today()->addDays(3)->format('Y-m-d');

            if ($date >= $threeDays) {
                $date = collect($dateCount)->map(function ($date) {
                    return array_search(max($date), $date, true);
                });

                break;
            }

            if (empty($dateCount[$date][$timestamp['conditionCode']])) {
                $dateCount[$date][$timestamp['conditionCode']] = 1;

                continue;
            }

            $dateCount[$date][$timestamp['conditionCode']]++;
        }

        foreach ($date as $date => $weatherType) {
            $weatherDateList[] = [$weatherType => $date];
        }

        return $weatherDateList;
    }

    public function searchProducts(string $weatherDate): Collection
    {
        $weatherType = WeatherType::where('weather_type', $weatherDate)->first();
        return Product::where('type_id', $weatherType->id)
            ->inRandomOrder()
            ->limit(2)->get();
    }
}

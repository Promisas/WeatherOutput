<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\WeatherType;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Collection;

class WeatherTypeService
{
    public function printOutput(string $city): array
    {
        $list = [
            'City' => $this->findCity($city),
            'recommendations' => []
        ];

        foreach ($this->weatherDateSearch($city) as $date => $type) {
            $list['recommendations'][] = [
                'weather_forecast' => $type,
                'date' => $date,
                'products' => $this->searchProducts($type)
            ];
        }

        return $list;
    }

    public function findCity(string $city): string
    {
        $response = Http::get('https://api.meteo.lt/v1/places/' . $city . '/forecasts/long-term')->json();

        return $response['place']['name'];
    }

    public function weatherDateSearch(string $city): array
    {
        $forecast = Http::get('https://api.meteo.lt/v1/places/' . $city . '/forecasts/long-term')->json();
        $dateCount = [];

        foreach ($forecast['forecastTimestamps'] as $timestamp) {
            $date = Carbon::parse($timestamp['forecastTimeUtc'])->format('Y-m-d');
            $threeDays = Carbon::today()->addDays(3)->format('Y-m-d');

            if ($date >= $threeDays) {
                break;
            }

            if (empty($dateCount[$date][$timestamp['conditionCode']])) {
                $dateCount[$date][$timestamp['conditionCode']] = 1;

                continue;
            }

            $dateCount[$date][$timestamp['conditionCode']]++;
        }

        return $this->getDateArray($dateCount);
    }

    public function searchProducts(string $weatherType): Collection
    {
        $type = WeatherType::firstWhere('weather_type', $weatherType);

        return Product::where('type_id', $type->id)
            ->inRandomOrder()
            ->limit(2)
            ->get();
    }

    private function getDateArray(array $dateCount): array
    {
        return collect($dateCount)->map(function ($date) {
            return array_search(max($date), $date, true);
        })->toArray();
    }
}

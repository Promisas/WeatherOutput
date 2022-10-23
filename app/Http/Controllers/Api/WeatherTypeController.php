<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;


use Exception;
use App\Models\Product;
use App\Models\WeatherType;
use App\Services\WeatherTypeService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;

class WeatherTypeController extends Controller
{
    protected WeatherTypeService $service;

    public function __construct(WeatherTypeService $service)
    {
        $this->service  = $service;
    }

    public function index()
    {
        return view('index');
    }

    public function searchInput(string $city = null)
    {
        if (empty($city)) {
            return response()->json(['error' => 'City not found'], 404);
        }

        try {
            if (!Cache::has('key')) {
                $cacheOutput = $this->service->printOutput($city);
                Cache::put('key', $cacheOutput, now()->addMinutes(5));

                return $cacheOutput;
            }

            return Cache::get('key');
        } catch (Exception $error) {
            $message = $error->getMessage(); // store to db

            return response()->json(['error' => 'City not found'], 404);
        }
    }
}

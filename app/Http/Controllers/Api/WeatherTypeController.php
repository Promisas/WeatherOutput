<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Log;
use Exception;
use App\Services\WeatherTypeService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;

class WeatherTypeController extends Controller
{
    public function __construct(protected WeatherTypeService $service) {}

    public function index()
    {
        return view('index');
    }

    public function searchInput(string $city = null): array
    {
        if (empty($city)) {
            return Response::json(['error' => 'City not found'], 404);
        }

        try {
            return $this->service->printOutput($city);
//            if (!Cache::has('key')) {
//                $cacheOutput = $this->service->printOutput($city);
//                Cache::put('key', $cacheOutput, now()->addMinutes(5));
//
//                return $cacheOutput;
//            }
//
//            return Cache::get('key');
        } catch (Exception $error) {
            Log::create(['message' => $error->getMessage()]);

            return Response::json(['error' => 'City not found'], 404);
        }
    }
}

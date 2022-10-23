<?php

use App\Models\WeatherType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeatherTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_types', function (Blueprint $table) {
            $table->id();
            $table->string('weather_type');
        });

        $weatherTypes = ['clear', 'isolated-clouds', 'scattered-clouds', 'overcast', 'light-rain', 'moderate-rain', 'heavy-rain', 'sleet', 'light-snow', 'moderate-snow', 'heavy-snow', 'fog'];

        foreach ($weatherTypes as $weatherType) {
            WeatherType::create([
                'weather_type' => $weatherType
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather_types');
    }
}

@extends('layouts.app')

@section('content')

<form id="WeatherForm">
 @csrf
   <div>
       <label for="city">Enter your City:</label>
    <div>
        <input type="text" name="city" placeholder="Vilnius">
     </div>    
    <div>
       <button id="submit-button" type="submit" class="btn btn-bg">Find</button>
    </div>
    </form>

    <div>
        <p>Source of data is from LHMT</p>
        <p>More info <a target="_blank" href="https://api.meteo.lt/">Api.meteo.lt</a></p>
    </div>
@endsection
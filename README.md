## v0.1

    -Composer update so I can run the server locally with /php artisan serve;
    -Created Product model/factory/migration;
    -Created WeatherType model/migration/Controller;
    -Deleted some unnecessary files;
    -Added information to Product and WeatherType tables;

## v0.2

    -Factory updated to make dummy products;
    -Product/WeatherType Model: added protection and exceptions;
    -Added function and route "index";
    -Added UI;

## v0.3

    -Added API and test route;
    -Added function findCity to find the right city from the weatherForecast url;

## v0.4

    -Added function weatherDateSearch to find 3 upcoming days and their most occurring weather types;

## v0.5

    -Added sub-functions to weatherDateSearch to filter out top 1 occuring weather type and flip output to weatherType => date;

## v0.6

    -Added function searchProducts to find 2 random products from DB by weather type;

## v0.7

    -Added function function printOutput to print out the city, weather types, dates and product recommendations;

## v0.8

    -Added function searchInput to pass through given input and catch errors;

## v0.9

    -Added 5min cache for input request;
    -Added ajax script so the request goes through api route;

## v1.0

    -Fixing erros and misspells;
    -Adding installation instructions;

## Local installation

# Create database

    1. In cmd enter: mysql -uroot -p
    2. Enter your mysql password
    3. CREATE DATABASE TEST; // "TEST" your database name
    4. Change .env.example to .env
    5. In .env change DB_DATABASE=TEST // "TEST" your database name

# Migrations and DB seeding
    
    1. Run composer update
    2. Run php artisan migrate
    3. Run php artisan db:seed
    4. Run php artisan serve
    5. If key error run php artisan key:generate

# Cache and Route problems

    1. Restart cache run php artisan cache:clear
    2. Restart route cache run php artisan route:cache

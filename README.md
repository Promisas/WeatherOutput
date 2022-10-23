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

# Local installation

## Create database (use if database is not created after migration)

    1. In cmd enter: mysql -uroot -p
    2. Enter your mysql password
    3. CREATE DATABASE TEST; // "TEST" is your database name
    4. Change .env.example to .env
    5. In .env change DB_DATABASE=TEST // "TEST" is your database name

## Project setup
    
    Run these commands from route folder in order:
    1. composer install
    2. npm install
    3. copy .env.example .env
    4. php artisan key:generate
    5. php artisan migrate
    6. php artisan db:seed
    7. php artisan serve

### (INFO) Cache and Route problems

    1. To clear application cache: php artisan cache:clear
    2. To clear route cache: php artisan route:cache

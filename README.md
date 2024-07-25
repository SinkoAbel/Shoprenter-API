<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Shoprenter Secret API

## Tecnology
- Laravel 11
- PHPUnit

## Used packages
- ext-libxml
- ext-simplexml
- darkaonline/l5-swagger
- spatie/array-to-xml

## Used tools & environment 
- OS: Windows 10
- XAMPP
- PHP 8.2.12
- Postman
- OpenAPI / Swagger documentation

## How to init project
- git clone repo
- cd repo
- composer install
- npm install
- copy .env.example and name it as .env
- inside .env configure db settings
- php artisan migrate
- php artisan serve

## Endpoints
| Method | Endpoint            | Auth | Description            |
|--------|---------------------|------|------------------------|
| GET    | /api/secret/{hash}  | No   | Get a secret           |
| POST   | /api/secret         | No   | Create a secret        |
| GET    | /api/documentation  | No   | Endpoint documentation |

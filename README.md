<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About

Laravel project setup with login authantication using blade and stripe payment integration

Laravel is accessible, powerful, and provides tools required for large, robust applications.

# Project Setup

## Installation

Follow these steps to set up and run the project.

### 1. Install Dependencies

First, install the necessary dependencies by running the following command:

```bash
composer install
npm install
```

### 2. Setup Environment Variables

Copy the .env.example file to a new file named .env and add your API endpoint:

```bash
cp .env.example .env
```

setup database and stripe details


### 3. Setup database


After changes in .env for database run below command

```bash
php artisan migrate
php artisan db:seed
```

### 4. Run the Development Server


To start the development server, use the following command:

```bash
php artisan serve
```

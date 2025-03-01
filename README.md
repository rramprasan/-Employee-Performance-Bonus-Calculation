Employee Bonus Management System

Introduction

This is an Employee Bonus Management System built using Laravel 12. The system allows administrators to manage employees, calculate bonuses, and generate reports.

Features

User Authentication (Admin & Employee roles)

Employee Management (CRUD operations)

Bonus Calculation

Bonus Reports

Role-based Access Control

Tech Stack

Backend: Laravel 12

Database: MySQL

Frontend: Blade Templates

Installation Guide

Prerequisites

Make sure you have the following installed:

PHP 8.1+

Composer

MySQL

Laravel 12

Step 1: Clone the Repository

    git clone https://github.com/-Employee-Performance-Bonus-Calculation
    cd employee-bonus-management

Step 2: Install Dependencies

    composer install
    npm install
    npm run dev

Step 3: Create Environment File

    cp .env.example .env

Update the .env file with your database details.

Step 4: Create Database

Create a new database manually:

Database Name: employee

Collation: utf8mb4_unicode_ci

Then, run migrations:

    php artisan migrate --seed

Step 5: Generate Application Key

    php artisan key:generate

Step 6: Run the Server

    php artisan serve

API Routes

Authentication Routes

Login: POST /api/login

Logout: POST /api/logout


Bonus Routes

Calculate Bonus: POST /api/calculate-bonus

Get Bonus Report: GET /api/getEmployeesReport

Admin Login Credentials

Email: admin@admin.com
Password: admin123

License

This project is open-sourced software licensed under the MIT license.


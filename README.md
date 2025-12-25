# Web-Security-Project
# Laravel E-Commerce 

This project is a secure e-commerce web application built using Laravel as part of the Web Security course.

## Features
- Secure user authentication and authorization
- Role-based access control (Admin / User)
- Protected routes and middleware
- Secure database interactions (MySQL)
- Input validation and CSRF protection
- Laravel encryption and hashing

## Technologies
- Laravel 10
- PHP 8.2
- MySQL
- XAMPP

## Setup Instructions
```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve

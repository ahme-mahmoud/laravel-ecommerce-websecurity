# 🔐 WebSec – Web & Security Course Project
## Secure Laravel E-Commerce Application 

---

## 📌 Overview
Welcome to **WebSec**, a secure web application 
as part of the **Web & Security course** at **ElSewedy University of Technology (SUT)**.

This project focuses on building a **secure Laravel-based e-commerce system**
while applying **web security principles** and **secure coding practices**.

---

## 🎯 Project Objectives
- Apply web security concepts in a real-world application
- Build a secure web system from scratch
- Implement authentication and authorization
- Prevent common web vulnerabilities
- Demonstrate full individual ownership of the project

---

## 🧠 Project Scope (Individual Work)
This project was fully designed and implemented by **one developer**, including:

- System architecture and backend design
- Laravel backend development
- Authentication and authorization logic
- Security middleware and route protection
- Database design and migrations
- Secure coding and input validation

---

## 🛡️ Security Focus Areas
- Authentication & Session Management
- Role-Based Access Control (RBAC)
- CSRF Protection
- SQL Injection Prevention
- Secure Password Hashing
- Input Validation & Sanitization
- Protected Routes & Middleware

---

## 🚀 Key Features

### 👥 User Management
- Secure user registration and login
- Password hashing using Laravel (bcrypt)
- Secure session handling and logout

---

### 🧑‍💼 Role-Based Access Control
- Admin and User roles
- Middleware-enforced authorization
- Protected admin-only routes

---

### 🛡️ Web Security Implementations
- CSRF tokens for all forms
- Server-side input validation
- Encrypted sensitive data
- Secure database interaction using Eloquent ORM

---

## 🗄️ Database Layer
- MySQL relational database
- Laravel migrations
- ORM-based queries (no raw SQL)
- Secure storage of user data

---

## 🛠️ Technologies Used
- **Laravel 10**
- **PHP 8.2**
- **MySQL**
- **XAMPP**
- **Node.js & npm** – For managing frontend dependencies and builds
- **Laravel Eloquent ORM**

---

## 📂 Repository Structure
```text
WebSec230105687/
│── README.md
│── WebSec/
│   ├── app/
│   ├── routes/
│   ├── resources/
│   ├── database/
│   ├── .env.example
│   └── composer.json
```

---

## 🚀 Getting Started

---

### 🔹 Prerequisites
Before you begin, ensure you have the following installed:

- Laravel
- PHP 8.2+
- Node.js & npm
- MySQL
- Composer
- XAMPP (Windows) or any local server

---

### 🔹 Installation (Windows)

---

#### Clone the repository
```bash
git clone https://github.com/ahme-mahmoud/WebSec230105687
cd WebSec230105687/WebSecproject
```

---

#### Install backend dependencies
```bash
composer install
```

---

#### Install frontend dependencies
```bash
npm install
```

---

#### Set up environment
```bash
copy .env.example .env
php artisan key:generate
```

---

#### Run database migrations
```bash
php artisan migrate
```

---

#### Build frontend assets
```bash
npm run dev
```

---

#### Run the application
```bash
php artisan serve
```

---

### 🔹 Installation (Linux / macOS)

---

#### Clone the repository
```bash
git clone https://github.com/ahme-mahmoud/WebSec230105687
cd WebSec230103309/WebSecproject
```

---

#### Install backend dependencies
```bash
composer install
```

---

#### Install frontend dependencies
```bash
npm install
```

---

#### Set up environment
```bash
cp .env.example .env
php artisan key:generate
```

---

#### Run database migrations
```bash
php artisan migrate
```

---

#### Build frontend assets
```bash
npm run dev
```

---

#### Run the application
```bash
php artisan serve
```

---

## 🌍 Frontend Build Notes

---

- **Node.js & npm** are used to manage frontend dependencies
- Frontend assets are compiled using **Vite**

---

### Development mode
```bash
npm run dev
```

---

### Production build
```bash
npm run build
```

---

## 📚 Academic Context

---

- **Course:** Web & Security
- **Focus:** Secure Web Application Development
- **Institution:** ElSewedy University of Technology (SUT)

---

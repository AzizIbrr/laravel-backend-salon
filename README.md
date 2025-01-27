# Laravel Filament Application

This is a Laravel application integrated with Filament, a powerful admin panel for Laravel.

## Prerequisites

Before you begin, ensure you have met the following requirements:
- PHP >= 8.0
- Composer
- Node.js and npm
- A web server (e.g., Apache, Nginx)
- A database server (e.g., MySQL, PostgreSQL)

## Getting Started

Follow these steps to clone and set up the application:

### 1. Clone the Repository

```bash
git clone https://github.com/AzizIbrr/laravel-backend-salon.git
cd laravel-backend-salon
```

### 2. Install Dependencies
Install PHP dependencies using Composer:

```bash
composer install
```

### 3. Set Up Environment Variables
Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

Generate an application key:

```bash
php artisan key:generate
```

### 4. Run Migrations and Seeders
Run the database migrations and seeders:

```bash
php artisan migrate --seed
```

Run the storage link
```bash
php artisan storage:link
```

### 5. Serve the Application
Start the local development server:

```bash
php artisan serve
```

The application will be available at http://localhost:8000.

# Laravel Project Setup

## Prerequisites

* PHP >= 8.2
* Composer
* Docker Desktop (for Laravel Sail)

## Installation

1. **Clone the repository**
```bash
git clone https://github.com/alejandrorh97/instructoria
cd <project-folder>
```


2. **Install dependencies**
```bash
composer install
```


3. **Environment configuration**
```bash
cp .env.example .env
php artisan key:generate
```


4. **Database migration**
```bash
php artisan migrate
```

---

## Execution with Laravel Sail (Docker)

If you prefer using Docker, follow these steps:

1. **Start Sail**
```bash
./vendor/bin/sail up -d
```


2. **Run migrations via Sail**
```bash
./vendor/bin/sail artisan migrate
```


3. **Access the application**
The app will be available at: `http://localhost:8080`
---

## Local Development (Without Docker)

1. **Serve the application**
```bash
php artisan serve
```
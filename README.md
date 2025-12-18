<!-- GitAds-Verify: 8S4LA562WE3MXC5HR1P4GRF7273TG9RM -->

# KBC Futsal Lumen API

[![GitHub tag (latest SemVer)](https://img.shields.io/github/v/tag/abewartech/kbc-futsal-lumen?label=version)](https://github.com/abewartech/kbc-futsal-lumen/tags)
[![License](https://img.shields.io/github/license/abewartech/kbc-futsal-lumen)](LICENSE)
[![Build Status](https://img.shields.io/github/actions/workflow/status/abewartech/kbc-futsal-lumen/ci.yml?branch=main&amp;label=build)](https://github.com/abewartech/kbc-futsal-lumen/actions)
[![PHP](https://img.shields.io/badge/PHP-%5E7.3%20%7C%7C%20%5E8.0-777BB4?logo=php&amp;logoColor=white)](https://www.php.net/)
[![Lumen](https://img.shields.io/badge/Lumen-microframework-ff2d20?logo=laravel&amp;logoColor=white)](https://lumen.laravel.com/)

KBC Futsal Lumen API is a RESTful backend service built with the Lumen PHP micro‑framework to manage futsal bookings, matches, and related operations.  
It provides a lightweight, high‑performance foundation for mobile or web clients that need fast, JSON-based APIs.  
The project follows common Laravel/Lumen conventions, making it easy to extend, maintain, and deploy.

---

## Table of Contents

- [Features](#features)
- [Screenshots](#screenshots)
- [Installation](#installation)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [Technologies](#technologies)
- [Contributing](#contributing)
- [License](#license)

---

## Features

- ⚽ Manage futsal grounds, time slots, teams, and bookings.
- 🔐 Token-based authentication (Laravel/Lumen ecosystem friendly).
- 📦 RESTful JSON API responses suitable for web and mobile clients.
- 🗄️ Database migrations and seeders for reproducible environments.
- ✅ Automated tests using PHPUnit.
- 🚀 Optimized for speed and low resource usage via the Lumen micro‑framework.

---

## Screenshots

> Note: Make sure the following screenshots exist under the `screenshots/` directory or update the paths accordingly.

| ![Screenshot 1](screenshots/screen1.png) | ![Screenshot 2](screenshots/screen2.png) | ![Screenshot 3](screenshots/screen3.png) |
|:---:|:---:|:---:|
| *Caption 1* | *Caption 2* | *Caption 3* |

---

## Installation

### Prerequisites

- PHP 7.3+ or 8.x
- Composer
- A database (e.g. MySQL/MariaDB)
- Git

### Steps

1. **Clone the repository**

   ```bash
   git clone https://github.com/abewartech/kbc-futsal-lumen.git
   cd kbc-futsal-lumen
   ```

2. **Install PHP dependencies**

   ```bash
   composer install
   ```

3. **Copy environment file**

   ```bash
   cp .env.example .env
   ```

4. **Configure environment**

   Edit `.env` and set your database and application configuration:

   ```env
   APP_NAME=KBC Futsal API
   APP_ENV=local
   APP_DEBUG=true
   APP_URL=http://localhost

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=kbc_futsal
   DB_USERNAME=root
   DB_PASSWORD=secret
   ```

5. **Generate application key (if used)**

   Some installations of Lumen use `APP_KEY` for encryption. If applicable in this project, run:

   ```bash
   php artisan key:generate
   ```

6. **Run database migrations (and seeders if available)**

   ```bash
   php artisan migrate
   php artisan db:seed   # optional, if seeders are defined
   ```

---

## Usage

### Start the development server

You can use the built‑in PHP server or `artisan` (if configured):

```bash
php -S localhost:8000 -t public
# or, if "serve" is available
php artisan serve
```

The API will be available at:

```text
http://localhost:8000
```

### Example: Fetch available futsal slots

```bash
curl http://localhost:8000/api/slots
```

Example JSON response:

```json
[
  {
    "id": 1,
    "ground": "Main Court",
    "starts_at": "2025-01-15T18:00:00Z",
    "ends_at": "2025-01-15T19:00:00Z",
    "is_available": true
  }
]
```

### Example: Create a booking (authenticated)

```bash
curl -X POST http://localhost:8000/api/bookings \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN" \
  -d '{
    "slot_id": 1,
    "team_name": "Genie FC"
  }'
```

---

## Project Structure

A high‑level overview of the most important directories/files:

```text
.
├── app/                # Application core (models, controllers, services)
├── bootstrap/          # Framework bootstrap and performance cache
├── database/           # Migrations, seeders, and factories
├── public/             # Public web root (index.php)
├── resources/          # Views, language files, other resources
├── routes/             # API and web route definitions
├── storage/            # Logs, cache, compiled views, etc.
├── tests/              # Automated tests (PHPUnit)
├── .env.example        # Example environment configuration
├── composer.json       # Project dependencies and scripts
└── README.md           # Project documentation (this file)
```

Refer to the `routes/` and `app/` directories for the main API endpoints and application logic.

---

## Technologies

Core technologies and tools used in this project:

- ![PHP](https://img.shields.io/badge/PHP-777BB4?logo=php&amp;logoColor=white)  
- ![Lumen](https://img.shields.io/badge/Lumen-ff2d20?logo=laravel&amp;logoColor=white)  
- ![Composer](https://img.shields.io/badge/Composer-885630?logo=composer&amp;logoColor=white)  
- ![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&amp;logoColor=white)  
- ![PHPUnit](https://img.shields.io/badge/PHPUnit-2C974B?logo=php&amp;logoColor=white)

---

## Contributing

Contributions are welcome and appreciated.

1. Fork the repository.
2. Create a new feature branch:
   ```bash
   git checkout -b feature/your-feature-name
   ```
3. Make your changes, including tests where appropriate.
4. Run the test suite:
   ```bash
   phpunit
   ```
5. Commit with a clear message and push your branch.
6. Open a Pull Request describing your changes.

Please follow existing coding standards and conventions used in the project.

---

## License

This project is open‑sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## GitAds Sponsored

[![Sponsored by GitAds](https://gitads.dev/v1/ad-serve?source=abewartech/kbc-futsal-lumen@github)](https://gitads.dev/v1/ad-track?source=abewartech/kbc-futsal-lumen@github)



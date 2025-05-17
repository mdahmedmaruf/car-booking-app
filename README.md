# Car Booking App

## About Laravel

Laravel is a modern PHP framework designed for building robust web applications with elegant syntax. It offers features like MVC architecture, powerful routing, Eloquent ORM for database interactions, built-in authentication scaffolding, and an expressive, developer-friendly ecosystem.

## Features

* **Admin Dashboard**

    * Manage Cars (CRUD)
    * Manage Rentals (CRUD & status updates)
    * Manage Customers (CRUD)
    * Overview statistics (total cars, available cars, rentals, earnings, pending rentals)
    * Email notifications on new bookings

* **Frontend (Customer)**

    * Browse available cars with filters (brand, type, price)
    * Car detail pages with booking form
    * Manage personal bookings (view, cancel)
    * Authentication (signup, login, logout)

* **Role-Based Access**

    * Admin and Customer roles with separate dashboards and capabilities

## Requirements

* PHP 8.1 or higher
* Composer
* Node.js & NPM
* MySQL or compatible database
* Laravel 12

## Installation

1. **Clone the repository**

   ```bash
   git clone https://github.com/mdahmedmaruf/car-booking-app.git
   cd car-booking-app
   ```

2. **Install PHP dependencies**

   ```bash
   composer install
   ```

3. **Install front-end dependencies**

   ```bash
   npm install
   ```

4. **Copy environment file & generate app key**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure** `.env`

    * Set database credentials (`DB_*`)
    * Set mail settings (`MAIL_*`)

6. **Run migrations and seeders**

   ```bash
   php artisan migrate --seed
   ```

   This will create the tables and seed:

    * One **admin** user: `admin@carbooking.com` / `admin123`
    * Five dummy **customer** users via factory

7. **Link storage and build assets**

   ```bash
   php artisan storage:link
   npm run dev
   ```

8. **Serve the application**

   ```bash
   php artisan serve
   ```

   Visit `http://127.0.0.1:8000` in your browser.

## Usage

* **Admin Dashboard**: `http://127.0.0.1:8000/admin/dashboard`

    * Login with `admin@carbooking.com` / `admin123`

* **Browse Cars**: `http://127.0.0.1:8000/cars`

* **Customer Dashboard**: `http://127.0.0.1:8000/dashboard`

## Routes Overview

* **Public**

    * `/` Home
    * `/about` About Us
    * `/contact` Contact
    * `/cars` Car listing
    * `/cars/{car}` Car details

* **Auth**

    * `/login`, `/register`, `/logout`, password & email verification via Laravel Breeze

* **Customer** (authenticated)

    * `/dashboard` Customer bookings & admin overview
    * `/rentals` (POST) Create booking
    * `/my-bookings` List bookings
    * `/rentals/{rental}` (DELETE) Cancel booking

* **Admin** (authenticated + admin)

    * `/admin/dashboard`
    * Resource routes under `/admin/cars`, `/admin/rentals`, `/admin/customers`

## Customization

* Modify views under `resources/views/admin` and `resources/views/frontend`.
* Update email templates in `resources/views/emails`.
* Adjust filters in `CarController@Frontend` for additional criteria.

## Testing

> *(Add testing instructions if you write tests)*

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/...`)
3. Commit your changes (`git commit -m "..."`)
4. Push to the branch (`git push origin feature/...`)
5. Open a Pull Request

## License

This project is open-sourced under the MIT license.

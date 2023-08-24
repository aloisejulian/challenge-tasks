# Laravel Project with Docker

This repository contains a Laravel project configured to run in a Dockerized environment.

## Prerequisites

Before you proceed, make sure you have the following components installed on your system:

- Docker: [Installation Instructions](https://docs.docker.com/get-docker/)
- Docker Compose: [Installation Instructions](https://docs.docker.com/compose/install/)

## Configuration

1. Clone this repository to your local machine:

   ```bash
   git clone git@github.com:aloisejulian/challenge-tasks.git
   ```

2. Navigate to the project directory:

   ```bash
   cd <your-project-folder>
   ```

3. Copy the `.env.example` file to `.env`:

   ```bash
   cp .env.example .env
   ```

4. Open the `.env` file and configure the environment variables, including those related to the database.

5. In the project's root directory, create a `php.ini` file if you want to customize the PHP configuration. You can use `php.ini.example` as a starting point.

6. Modify the `docker-compose.yml` file to change the  port on which the Laravel application will run, now is on the 90. For example, to change the port to 8080:

   ```yaml
   services:
     app:
       ports:
         - "8080:80"
   ```
   
**Modifying NGINX Configuration**

You can modify the NGINX configuration by editing the nginx/conf.d/app.conf file. This file controls the behavior of NGINX for your Laravel application.## Running

## **To run the project using Docker, follow these steps:**

1. Build the Docker containers:

   ```bash
   docker-compose build
   ```

2. Start the containers in the background:

   ```bash
   docker-compose up
   ```

3. Access the Laravel application in your browser at `http://localhost:90`. 


4. Running Migrations and Seeders
   1. Run migrations to create the necessary database tables:

   ```bash
   docker-compose exec app php artisan migrate
   ```
   2. Seed the database with initial data using the provided seeders:
   ```bash
   You can run all seeders at once:
   
   docker-compose exec app php artisan db:seed
   
   Or run individual seeds:
   
   docker-compose exec app php artisan db:seed --class=ProductsTableSeeder
   docker-compose exec app php artisan db:seed --class=UsersTableSeeder
   docker-compose exec app php artisan db:seed --class=OrdersTableSeeder
   ```
      

   
## Available Endpoints

- **Retrieve Users and Their Most Expensive Order::**
  ```
  http://localhost:90/api/v1/users-with-most-expensive-order
  ```

- **Retrieve Users Who Have Purchased All Products:**
  ```
  http://localhost:90/api/v1/users-who-purchased-all-products
  ```

- **Retrieve the User with the Highest Total Sales:**
  ```
  http://localhost:90/api/v1/user-with-highest-total-sales
  ```

## Modifying Configurations

If you make changes to the `Dockerfile` or `docker-compose.yml`, make sure to rebuild the containers before running the project again:

```bash
docker-compose build
docker-compose up -d
```

## Stopping and Removing

To stop the Docker containers, run:

```bash
docker-compose down
```

If you want to completely remove the Docker environment, including volumes and networks, you can run:

```bash
docker-compose down -v
```










<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

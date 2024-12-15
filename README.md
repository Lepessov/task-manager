#Task Manager REST API
This project provides a REST API for managing a task list with prioritization functionality based on importance and deadlines. Built with Laravel 10+, MySQL/PostgreSQL, and Swagger for API documentation.

##Features
CRUD operations for tasks
Prioritization endpoint that returns tasks ordered by priority (calculated using importance and deadline)
Database schema is created with migrations
Form Request Validation for input validation
API Resource to format responses
Basic error handling
API documentation with Swagger
Test for prioritization logic
Tech Stack
Laravel 10+
MySQL/PostgreSQL
Swagger for API documentation
PHP 8.2 with Docker
Nginx for serving the application
Installation
Prerequisites
Before you start, ensure you have the following installed:

## Docker and Docker Compose
Git
Check the Docker versions:

bash
``` Copy code
docker --version
docker-compose --version
```
Steps to Set Up the Project
Clone the repository:

bash
Copy code
```
git clone https://github.com/your-username/task-manager-api.git
cd task-manager-api
```
Start the Docker containers:

Run the following command to build and start the application, database, and Nginx containers:

bash
Copy code
```
docker-compose up -d --build
```

Copy .env.example to .env:

bash
Copy code
```
cp .env.example .env
```

Run the database migrations:

To create the necessary tables, run:

bash
Copy code
```
docker-compose exec php-fpm php artisan migrate
```
Seed the database (optional):

To seed the database with sample tasks, run:

bash
Copy code
```
docker-compose exec php-fpm  php artisan db:seed
```

```
docker-compose exec php-fpm composer require "darkaonline/l5-swagger
docker-compose exec php-fpm php artisan l5-swagger:generate
```
Access the API!

The Swagger documentation for the API is available at:
http://localhost:8080/api/documentation

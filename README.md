Task Manager REST API
This project provides a REST API for managing a task list with prioritization functionality based on importance and deadlines. Built with Laravel 10+, MySQL/PostgreSQL, and Swagger for API documentation.

Features
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

Docker and Docker Compose
Git
Check the Docker versions:

bash
Copy code
docker --version
docker-compose --version
If Docker is not installed, follow the Docker installation guide.

Steps to Set Up the Project
Clone the repository:

bash
Copy code
git clone https://github.com/your-username/task-manager-api.git
cd task-manager-api
Start the Docker containers:

Run the following command to build and start the application, database, and Nginx containers:

bash
Copy code
docker-compose up -d --build
-d will run the containers in the background.
--build will force Docker to rebuild the images.
Install Composer dependencies:

Run the following command to install Laravel dependencies:

bash
Copy code
docker-compose run --rm composer install
Set up the environment file:

Copy .env.example to .env:

bash
Copy code
cp .env.example .env
Ensure the database credentials in .env match the settings in your docker-compose.yml:

env
Copy code
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=root
Run the database migrations:

To create the necessary tables, run:

bash
Copy code
docker-compose exec app php artisan migrate
Seed the database (optional):

To seed the database with sample tasks, run:

bash
Copy code
docker-compose exec app php artisan db:seed
Access the API:

The API is accessible at http://localhost:8080.

You can now use Postman or any API client to interact with the API.

API Endpoints
Tasks API
GET /api/tasks
Fetch the list of tasks. Optionally filter by status.

Query parameters:

status: Filter by status (e.g., TODO, IN_PROGRESS, COMPLETED).
Example request:

bash
Copy code
GET http://localhost:8080/api/tasks?status=TODO
Response:

json
Copy code
{
    "data": [
        {
            "id": 1,
            "title": "Task 1",
            "description": "Description of Task 1",
            "status": "TODO",
            "importance": 4,
            "deadline": "2024-12-01 12:00:00",
            "created_at": "2024-11-01 12:00:00",
            "updated_at": "2024-11-01 12:00:00"
        }
    ]
}
POST /api/tasks
Create a new task.

Request body:

json
Copy code
{
    "title": "Task Title",
    "description": "Task Description",
    "status": "TODO",
    "importance": 3,
    "deadline": "2024-12-01 12:00:00"
}
Response:

json
Copy code
{
    "id": 1,
    "title": "Task Title",
    "description": "Task Description",
    "status": "TODO",
    "importance": 3,
    "deadline": "2024-12-01 12:00:00",
    "created_at": "2024-11-01 12:00:00",
    "updated_at": "2024-11-01 12:00:00"
}
GET /api/tasks/{id}
Get a task by its ID.

Example request:

bash
Copy code
GET http://localhost:8080/api/tasks/1
Response:

json
Copy code
{
    "id": 1,
    "title": "Task Title",
    "description": "Task Description",
    "status": "TODO",
    "importance": 3,
    "deadline": "2024-12-01 12:00:00",
    "created_at": "2024-11-01 12:00:00",
    "updated_at": "2024-11-01 12:00:00"
}
PUT /api/tasks/{id}
Update an existing task.

Request body:

json
Copy code
{
    "title": "Updated Task Title",
    "description": "Updated Task Description",
    "status": "IN_PROGRESS",
    "importance": 4,
    "deadline": "2024-12-01 12:00:00"
}
Response:

json
Copy code
{
    "id": 1,
    "title": "Updated Task Title",
    "description": "Updated Task Description",
    "status": "IN_PROGRESS",
    "importance": 4,
    "deadline": "2024-12-01 12:00:00",
    "created_at": "2024-11-01 12:00:00",
    "updated_at": "2024-11-01 12:30:00"
}
DELETE /api/tasks/{id}
Delete a task by its ID.

Example request:

bash
Copy code
DELETE http://localhost:8080/api/tasks/1
Response:

json
Copy code
{
    "message": "Task deleted successfully"
}
GET /api/tasks/priority
Get tasks ordered by priority. Priority is calculated using the formula: priority = importance * (1 / daysUntilDeadline).

Response:

json
Copy code
{
    "data": [
        {
            "id": 1,
            "title": "Urgent Task",
            "description": "Description of urgent task",
            "status": "TODO",
            "importance": 5,
            "deadline": "2024-12-01 12:00:00",
            "is_overdue": false,
            "priority_score": 0.85,
            "created_at": "2024-11-01 12:00:00",
            "updated_at": "2024-11-01 12:00:00"
        }
    ]
}
Testing
To run the tests for the application, execute the following command:

bash
Copy code
docker-compose exec app php artisan test
Documentation
The Swagger documentation for the API is available at:
http://localhost:8080/api/documentation

You can import the Postman collection from the file provided in the project directory to test the API endpoints.

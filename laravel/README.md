# Employee Management System

## Task Description

You are tasked with building an employee management system using Laravel, PHP, and MySQL. The system should allow for the following functionality:
- Register new employees with their basic information (name, email, phone number, job title, department, and salary)
- View a list of all employees with their basic information
- Update employee information
- Delete an employee from the system
- Search for an employee by name or job title
- Generate a report that lists all employees and their salaries, ordered by department and then by salary in descending order

## Prerequisite
- PHP 8.1
- Laravel 10.10
- Mysql for database

## Installation

### Step 1.
- Begin by cloning this repository to your machine
```
git clone `repo url` 
```

- Install dependencies
```
composer install
```

- Create environmental file and variables
```
cp .env.example .env
```

- Generate app key
```
php artisan key:generate
```

### Step 2
- Next, create a new database and reference its name and username/password in the project's .env file.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=root
DB_PASSWORD=your_password
```

- Run migration
```
php artisan migrate or php artisan migrate:fresh
```

### Step 3
- before start, you need to run table seeders
```
php artisan db:seed
```

### Step 4
- To start the server, run the command below
```
php artisan serve
```

## Application Route
```
http://127.0.0.1:8000
```

## Task Expectations

provided APIs for any consumer(ex: web app, mobile app,...)
- User can register new employees with their basic information (name, email, phone number, job title, department, and salary).
- User can login with ( email, password).
- User can get a list of all employees with their basic information.
- User can update any employee profile.
- User can delete any employee profile.
- User can search for any employee by name or job title.
- User can Generate a report that lists all employees and their salaries, ordered by department and then by salary in descending order.
- Postman collection to test Apis

## Author
- ibrahim khalaf

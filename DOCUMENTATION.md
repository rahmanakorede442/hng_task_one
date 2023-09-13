# Overview

We provide you with a simple and easy to use api for performing basic **CRUD ( Create, Read, Update and Delete)** operations on **Person** resource. By simply providing the `user_id`and by specifying the corresponding `HTTP` verbs, you can update, fetch and delete a record. You can create new records also using the `POST`verb without adding the `user_id` to the url. Detailed information about each **endpoints** can be find below.

## Table of Contents

- [Getting Started]()
    - [Prerequisites]()
    - [Installation](https://github.com/rahmanakorede442/hng_task_two/blob/master/README.md)
- [Endpoints]()
    - [1. Create a Person]()
    - [2. Get All Persons]()
    - [3. Get a Person by ID]()
    - [4. Update a Person]()
    - [5. Delete a Person]()
- [Request and Response Examples]()
- [Error Handling]()
- [Authentication and Authorization]()
- [Validation]()
    

## Getting Started

### Prerequisites

Before using the Person API, ensure you have the following prerequisites:

1. **PHP**: Laravel requires PHP 7.4 or higher. You can check your PHP version by running `php -v`.
2. **Composer**: Composer is a PHP package manager used for Laravel's dependency management. You can download it from [getcomposer.org]().
3. **Web Server**: You can use Apache, Nginx, or Laravel's built-in development server (for local development).
4. **Database**: Laravel supports multiple database systems, including MySQL, PostgreSQL, SQLite, and SQL Server. Ensure you have one of these databases installed and configured.
5. **Git**: Git is a version control system used for managing the project's source code.
    

### Installation

Follow these steps to set up and run the Person API: [Detailed Steps](https://github.com/rahmanakorede442/hng_task_two/blob/master/README.md)

1. Clone the project from the remote repository
```bash
git clone
```
2. Change directory to the cloned project
```bash
cd hng_task_two
```
3. Install all dependencies managed by composer
```bash
composer install
```
4. Copy the .env file from the existing .env.example
```bash
cp .env.example .env
```
5. Generate unique key for the Laravel application
```bash
php artisan key:generate
```
6. migrate the migration files to the local/remote database
```bash
php artisan migrate
```
7. start the server
```bash
php artisan serve
```
_The API will be accessible at `http://localhost:8000._

---
## Endpoints

The API provides the following endpoints for managing the person resource:

### 1\. Create a Person

- **Endpoint**: `POST /api/persons`
- **Headers**: `Content-Type: application/json Accept: application/json`
- **Request Body**: JSON object with person information, such as `name` .
- **Response**: JSON object of the created person with an auto-generated `id`.
    

### 2\. Get All Persons

- **Endpoint**: `GET /api/`
- **Headers**: `Content-Type: application/json Accept: application/json`
- **Response**: JSON array of all persons in the database.
    

### 3\. Get a Person by ID

- **Endpoint**: `GET /api/{user_id}`
- **Headers**: `Content-Type: application/json Accept: application/json`
- **Response**: JSON object of the person with the specified `id` or customized error message **(404)** if person not found.
    

### 4\. Update a Person

- **Endpoint**: `PUT /api/{user_id}`
- **Headers**: `Content-Type: application/json Accept: application/json`
- **Request Body**: JSON object with updated person information, such as `name`.
- **Response**: JSON object of the updated person or customized error message **(404)** if person not found.
    

### 5\. Delete a Person

- **Endpoint**: `DELETE /api/{user_id}`
- **Headers**: `Content-Type: application/json Accept: application/json`
- **Response**: JSON object of success message confirming the deletion.
    

## Request and Response Examples

Here are some examples of how to use the API:

### 1\. Create a Person

- `POST /api/persons   Content-Type: application/json`

```javascript
{  
    "name": "Dominic Toretto",
}
```
- Responses: 

>Status code: 200

```javascript
{  
    "id":1,
    "name": "Dominic Toretto"
}
```

### 2\. Get All Persons

- `GET /api/persons`
- Responses:

>Status code: 200

```javascript
[
    {  
        "name" : "Akorede Lamidi",
    },
    {  
        "name" : "Ifekunle",
    },   // More persons...
] 
```
    

### 3\. Get a Person by ID

- `GET /api/persons/1`
- Responses:

>Status code: 200

```javascript
{  
    "id" : 1,
    "name" : "Akorede Lamidi"
}
```

>Status code: 404

```javascript
{  
    "error" : "Record not found!"
}
```
### 4\. Update a Person

- `PUT /api/persons/1  Content-Type: application/json`      
- Request body:

```javascript
{
    "name" : "Akorede Gabriel"
}
```

>Response: 200

```javascript
{  
    "message" : " Record updated!",
}
```

>Response: 404
    
 ```javascript
{  
    "error" : " Record not found!",
}
```
### 5\. Delete a Person

- `DELETE /api/1`

>Response: 200

```javascript
{
    "message": "Person with ID 1 has been deleted."
}
```

---

## Validation

The API includes basic validation rules for request data. Ensure your requests follow the specified data format and constraints to avoid validation errors. For example in the request body, the name field can only accept a `string` data type.


## Limitations of the API

While the provided Person API serves as a basic CRUD example, it has certain limitations that may need to be addressed depending on your project requirements:

1. **Authentication and Authorization**: The API lacks authentication and authorization mechanisms. It assumes that all users have access to all endpoints. In a real-world scenario, you would need to implement proper authentication and authorization to restrict access based on user roles and permissions.
2. **Validation**: Although the API includes basic validation rules, it may not cover all potential input scenarios. Custom validation rules for specific data constraints may be required.
3. **Error Handling**: While the API provides error messages and HTTP status codes, the error messages may not always provide detailed information for debugging. Enhanced error handling and logging may be needed for production use.

## Contact Information

For inquiry promotion or support, contact RahmanAkorede at rahmanakorede442@gmail.com or +2347012803737
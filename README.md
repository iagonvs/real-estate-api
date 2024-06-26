
# Project Setup Instructions

Follow these steps to get the project up and running on your local development environment.

## Step 1: Clone the Repository

First, clone the project repository to your local machine:

```bash
git clone https://github.com/iagonvs/real-estate-api.git
cd real-estate-api
```

## Step 2: Set Up Environment Variables

Copy the `.env.example` file to create a `.env` file with your environment variables:

```bash
cp .env.example .env
```

## Step 3: Build and Run with Docker

Use Docker Compose to build and start the project containers:

```bash
docker-compose up -d --build
```

## Step 4: Install Dependencies

Install the project's PHP dependencies with Composer:

```bash
docker-compose exec app composer install
```

## Step 5: Database Migrations and Seeders

After the containers are up, run the database migrations and seeders to set up the database schema and populate it with initial data:

```bash
docker-compose exec app php artisan migrate --seed
```

## Step 6: Run automated tests

```bash
docker-compose exec app php artisan test
```

## Step 7: Import insomnia file

Inside project there is a Insomnia file with all endpoints. You can import in your local workspace.

```bash
Insomnia_2024-03-23.json
```

## Step 8: Documentation of routes

![img.png](img.png)

In the project there is a Laravel Scramble package to show all routes and with all details, like payload examples etc.

To access doc just put follow route:

```bash
http://127.0.0.1:8000/docs/api
```

## Step 9: Using API

### Seeds

There are two seeders to create content to Buildings and Statuses table. (Is in STEP 5);

### Authentication

The routes to create and get a task, and create a comment needs to have a bearer token.

To generate just need use the registration route (api/register) and to make a login route(api/login)

```bash
POST:
Registration payload:

{
  "name": "real estate api",
  "email": "real-estate-api@state.com",
  "password": "realestateapi",
}

POST:
Login payload:

{
  "email": "real-estate-api@state.com",
  "password": "realestateapi",
}
```

To create a Task you can use this route: api/tasks

```bash
POST:
{
  "title": "string",
  "address": "string",
  "description": "string",
  "status_id": "1" // 1 (OPEN), 2 (IN_PROGRESS), 3 (COMPLETED), 4 (REFUSED),
  "user_id": 0,
  "building_id": 0
}
```

To get a task with filters. All attributes are optionals: api /tasks

```bash
GET:
{
  "date_from": "string",
  "date_to": "string",
  "status_id": "1" // 1 (OPEN), 2 (IN_PROGRESS), 3 (COMPLETED), 4 (REFUSED),
  "building_id": 0
}

OR to get all
GET:
{
}
```

To make a comment to specific task: api/comments/{task}

```bash
POST:
{
  "content": "string"
}
```


You should now have the project running on your local development environment. For more detailed instructions or troubleshooting, refer to the project's documentation or contact with me.

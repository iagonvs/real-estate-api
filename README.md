
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

## Step 3: Install Dependencies

Install the project's PHP dependencies with Composer:

```bash
composer install
```

## Step 4: Build and Run with Docker

Use Docker Compose to build and start the project containers:

```bash
docker-compose up -d --build
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

![Doc](https://drive.google.com/file/d/1QGROHI4sKqtWLnBKFUeQaZwWleUqOa9c/view?usp=sharing)

In the project there is a Laravel Scramble package to show all routes and with all details, like payload examples etc.

To access doc just put follow route:

```bash
http://127.0.0.1:8000/docs/api
```

You should now have the project running on your local development environment. For more detailed instructions or troubleshooting, refer to the project's documentation or contact the development team.

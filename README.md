# Task Management App

A simple task management app created using Laravel Sail.

## Prerequisites

- Install Docker Desktop before cloning the repository.

## Setup Guidelines

1. Clone the repository.
2. Setup the project using Docker Sail:
   ```bash
   ./vendor/bin/sail up -d
3. Setup node dependencies using npm or yarn:
    ```bash
    npm i
    # or
    yarn
4. Run the vite development server:
    ```bash
    npm run dev
    # or
    yarn run dev
5. Migrate the databases:
    ```bash
    ./vendor/bin/sail artisan migrate
6. Run the database seeder:
    ```
    ./vendor/bin/sail artisan db:seed
7. Access the application at: [http://localhost/login](http://localhost/login)


You can access the API documentation [here](https://documenter.getpostman.com/view/30704833/2sAXqtbhEY). 
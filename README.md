## How to run the web app

1. **Clone the repository:**

   ```bash
   git clone <repository-url>
   cd webtech-laravel
   ```

2. **Copy the example environment file and set your environment variables:**

   ```bash
   cp .env.example .env
   ```

   Edit `.env` as needed (e.g., set database credentials, app key, etc).

3. **Build image:**

   ```bash
   docker compose up -d --build
   ```

4. **Run database migrations**

   ```bash
   docker exec webtech-laravel-laravel.test-1 php artisan migrate  
   ```

> [!WARNING] 
> 
>In Case of `2025_07_06_134850_create_sessions_table` not being migrated (check with `docker compose exec webtech-laravel php artisan migrate:status`), run the following:
>1. Enter tinker mode:
>    
>    ```bash
>   docker compose exec webtech-laravel php artisan tinker
>   ```
>   
>2. Execute the following code snippet:
>
>    ```php
>   <?php
>    DB::table('migrations')->insert([
>    'migration' => '2025_07_06_134850_create_sessions_table',
>    'batch' => 1
>    ]);
>    exit
>   ```
>   
>3. Rerun migrations:
>
>    ```bash
>   docker exec webtech-laravel-laravel.test-1 php artisan migrate  
>   ```


## Accessing the App

- Visit [http://localhost](http://localhost) in your browser.
- If you changed the port in `docker-compose.yml`, use that port instead.

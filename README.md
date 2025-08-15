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

## Accessing the App

- Visit [http://localhost](http://localhost) in your browser.
- If you changed the port in `docker-compose.yml`, use that port instead.

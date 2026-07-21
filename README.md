# Setup

1. Install Docker
2. Make sure docker is running
3. Check out code: `git clone git@github.com:3ub41r/laravel-training-utmspace-2026.git`
4. `cd` into directory: `cd laravel-training-utmspace-2026`
4. `docker compose up`
5. Install packages locally: `docker run --rm -v $PWD:/app composer install --no-dev --no-scripts --optimize-autoloader --ignore-platform-reqs`
6. Make a copy of .env.example: `cp .env.example .env`
7. Generate APP_KEY: `docker compose exec dashboard-app php artisan key:generate --show`
8. Paste key into .env file, APP_KEY
9. Configure connection to MSSQL in .env: `MSSQL_*`
10. Test connection: open `http://localhost:81/mssql`

**Run commands on a running container**

`docker compose exec <service> <command>`

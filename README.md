## Beeverse Project

This project was made to fulfill the requirements of the web programming final exam.

## Working with project

### Prerequisite

1. PHP development environment (>=7.3)
2. Composer
3. NodeJS (>=16)

### Setup

1. Clone this repository

```
git clone https://github.com/MichaelStan27/Bookpedia
```

2. Install all project dependencies

```
npm install && composer install
```

3. Configure `.env` file
4. Sets APP_KEY value in `.env` file

```
php artisan key:generate
```

5. Link storage to public folder

```
php artisan storage:link
```

6. Run database migrations and seeder

```
php artisan migrate --seed
```

7. Build project assets

```
npm run dev
```

8. Preview project

```
php artisan serve
```

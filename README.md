# Delsy
Rebuilding of the [https://www.delsy.ru](https://www.delsy.ru) website.

## Requirements
- PHP 7.4.13
- PostgreSQL 8+

## Installation
Install project dependencies with the [Composer](https://getcomposer.org/):

`composer install`

Generate application key:

`php artisan key:generate`

Start migrations and seeds. Make sure you have a "production" value in an APP_ENV in your .env file to avoid seeding fake data for development needs.

`php artisan migrate --seed`

Create admin and default product.

`php artisan install`

Then install dependencies for the front end:

`npm i`

Compile your front end files with:

`npm run prod`

Run compression command

`npm run watch`

this will create `.gz` and `.br` archives for css and js assets in public directory which will served by nginx in case if `Accept-Encoding: gzip` presents

# Migrations
Migrations need to be done by this command `delsy:migrate:refresh {--seed=}`

where `-seed` receives arguments `dev` or `prod`
If arguments not provided - you will force to pick them in console selection
```
You need to provide type of seeder: dev or prod

 What seeder do you want to pick:
  [0] dev
  [1] prod
 > 
```

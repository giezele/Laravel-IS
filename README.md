# Laravel IS

### Task

Make the Information system (IS) for collecting, processing, storeing, and distributing information. Use Laravel framework, involve entities, realations, CRUD.


## Features


- CRUD for 2 entities.
- Filter each of entities in drop-down list;
- Search by title; 
- Custom view on one card;
- Authenticated login for company-approved managers only;
- Select language of two available options;

## Setup

1. Clone this repository `https://github.com/giezele/Laravel-IS` to the {app-directory} on your host.
2. Run CLI command inside of the {app-directory}:

    `composer install`
    
    ** or `php composer.phar install` if composer is not installed globally.
3. Create "new Schema" in your database (must be same name as in  `DB DATABASE=` )
4. Make a copy of .env.example and erase the ".example" extention.
5. Update .env file with your credentials:
```
    DB_DATABASE={enter_your_DB_name} //must be the same as Schema name in step 3  
    DB_USERNAME=root
    DB_PASSWORD={your_password} 
```
6. Run `php artisan migrate` in CLI inside your project.
7. Run `php artisan db:seed --class=UserSeeder`
8. Run `php artisan key:generate`
9. Run `php artisan serve` and click on the link to view the app in your browser.
10. LOGIN Email --> admin@admin.com
11. LOGIN Pass --> admin

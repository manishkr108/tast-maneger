1. first open project in vs code 
2. dependencies via Composer: composer install
3. Configure the environment: .env
4. Generate an application key: php artisan key:generate
5. Run migrations: php artisan migrate
6. if migrations given error run migrations file sepratly first you have to execute Project migrations file because 
    in task table project_id is foreign	key. use given command below
7. php artisan migrate --path=/database\migrations\2023_07_16_044210_create_projects_table.php
8. php artisan migrate
9. after that you can run seeder like,php artisan db:seed
10. i am creating seeder for storing project data

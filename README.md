# Square1 blog

## Installation

1) Clone this repository

    `git clone git@github.com:elbouamrani/square1-blog.git`

2) Run docker compose

   `docker compose up -d --build`

    if you have an older version of docker you have to run 
    
    `docker-compose up -d --build`

3) Install composer dependencies

    `docker exec app composer install`

4) Prepare the enviroment variables

    - copy .env.example file to .env 

        `docker exec app cp .env.example .env`
        
    - generate app 
        
        `docker exec app php artisan key:gen`

    - populate the cache and feed import variables

    ```
        IMPORT_USER_ID=1
        FEED_ENDPOINT=https://sq1-api-test.herokuapp.com/posts

        CACHE_RESPONSE_ACTIVE=true
        CACHE_RESPONSE_TTL=259200
    ```
    - create database

        you can create database by uncommenting phpmyadmin service in docker compose

        or you can run this command:

        `docker exec mysql mysql -u root -psecret -e "create database square1blog"`
    - configure database enviroment variables

    ```
        DB_PORT=3306
        DB_DATABASE=square1blog
        DB_PASSWORD=secret
    ```

5) Run database migrations

    `docker exec app php artisan migrate`

6) Initialize feed user
   
    `docker exec app php artisan feed:generate-user`

7) Install npm dependencies

    `docker exec app npm install`

    `docker exec app npm run prod`

8) [Optional] Run scheduler
   
    `docker exec app php artisan schedule:work`

9) [Optional] Run demo seeder

    `docker exec app php artisan db:seed DemoSeeder`

10) [Optional] Run mix watcher

    `docker exec app npm run watch`

11) [Optional] Run test

    `docker exec app php artisan test`

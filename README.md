1. cloning project from git
2. run composer install
3. run npm install
4. Create a copy of the .env example and rename it to .env
5. Modify the APP_URL in the .env to match the url of your test enviriorment
6. Rename the database to local instance of your database.
7. Run php artisan migrate to create the database/add the tables to the database
8. Run php artisan db:seed to seed your database

You can now log in using example@gmail.com using the password tijdelijk-(date formatted like d-m);

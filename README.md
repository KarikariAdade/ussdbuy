
## How to Install

1. Clone the Project<br><br>
2. Open project directory in your terminal and enter the following commands <br><br>
    <code>composer install</code> to install required packages<br><br>
    <code>npm install</code> to install node packages<br><br>
    <code>npm run dev</code> to compile node packages<br><br>
    <code>cp .env.example .env</code> to create a copy of the env file<br>
3. Configure your database in the .env file created<br><br>
4. Run migrations <code> php artisan migrate </code><br><br>
5. Run seeders <code>php artisan db:seed</code><br><br>
6. Generate application key <code>php artisan key:generate</code><br><br>
7. Serve the application <code>php artisan serve</code><br><br>
8. Login with the given credentials<br>
    Email: <code>admin@admin.com</code><br>
    Password: <code>password</code><br><br>
9. Upload the postman collection to access the api endpoints
   [click here](Bluespace_USSDBuy.postman_collection.json)

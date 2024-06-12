## Prerequisites
No specific version for the servers is required, but you'll need to have the following installed:

 - Composer, Node.js, and npm
 - MySQL and Apache servers running

The MySQL server should have a database created, and the credentials should be mapped to the database credentials in the .env file (lines 11-16).

## Getting Started

1. Clone the repository:
`git clone https://github.com/your-username/your-repo.git`

2. Install Composer dependencies:
`composer install`

3. Install npm packages:
`npm install`

4. Start the development server:
`php artisan serve`

5. Run the database migrations to create the necessary tables:
`php artisan migrate`

Note: Assuming there exists a MySQL database with the credentials specified in the .env file, this command will create the tables and connect the application server to the database.

6. Build the assets using Laravel Mix:
`npm run dev`

Note: You might be prompted to run npm run dev again after the first time.

After following these steps, your application should be up and running, and you can access it in your web browser at the URL provided by the php artisan serve command (usually http://localhost:8000) and add `item` at the end to view the shopping list, so your home page can be accessed through http://127.0.0.1:8000/item .

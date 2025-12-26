# Product-Management-System
A simple CRUD-based Product Management System with FakeStore API integration.

### Execute following commands for installation:

1. Clone the repository:   
    `git clone https://github.com/007Shawon/Product-Management-System.git`

2. Navigate to the project directory:
    `cd Product-Management-System`
   
4. Install Backend Dependencies
    `composer install`

5. Create the Database:
     Create a database for the project in MySQL.

7. Environment Configuration:
     In the root directory of the project, copy the `.env.example` file to a new file named `.env`:
     `cp .env.example .env`

9. Set the following database values in the `.env` file:
     - `DB_HOST`
     - `DB_PORT`
     - `DB_DATABASE`
     - `DB_USERNAME`
     - `DB_PASSWORD`

10. Run Database Migrations
     `php artisan migrate`

11. Generate Application Key
     `php artisan key:generate`

12. Start the Development Server
     `php artisan serve`

13. Access the Application:
     Open your browser and visit: "http://127.0.0.1:8000"

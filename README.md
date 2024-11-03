# Personal Light Instagram

This project is a clone of Instagram The application is built using modern web technologies, providing a seamless user experience.

# Features
- User authentication (registration, login, logout)
- Profile management (edit profile, upload profile picture)
- Post creation (upload images with captions)
- Responsive design for mobile and desktop views

## Technologies Used
- **Frontend:** Vue.js, Inertia.js, Tailwind CSS
- **Backend:** Laravel
- **Database:** MySQL

## Database
The database used for this project is `db_instagram`. Ensure that you have the database set up before running the application. The database file is included in the project folder.

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/alfito234/personal-light-instagram.git
    cd personal-light-instagram
    ```
2. Install dependencies:
    ```bash
    composer install
    npm install
    ```
3. Create a .env file and set your environment variables:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
4. Set up the database connection in your .env file.
5. Run migration
    ```bash
    php artisan migrate
    ```
6. Start the development server:
    ```bash
    php artisan serve
    ```
7. Start the development client:
    ```bash
    npm run dev
    ```

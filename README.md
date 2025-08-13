# Digital Leap Africa E-Learning Platform


Digital Leap Africa is a full-stack e-learning and community platform built with the Laravel framework. It provides a comprehensive suite of tools for managing and delivering educational content, tracking user progress, and fostering a community around learning. The entire platform, from the public-facing website to the advanced admin panel, is designed to be fully dynamic and database-driven.

## Features

*   **Public-Facing Website:** A fully responsive, dark-themed website showcasing courses, projects, eLibrary resources, and a job board.
*   **Complete Authentication:** Secure user registration, login, profile management, and password reset functionality.
*   **Role-Based Access Control:** A secure distinction between regular `users` and privileged `admins`.
*   **Advanced E-Learning System:**
    *   Course enrollment for authenticated users.
    *   Multi-level course structure: **Courses -> Topics -> Lessons**.
    *   Support for various lesson types (notes, videos, assignments).
*   **Gamification & Progress Tracking:**
    *   Users earn points for activities like enrolling in courses.
    *   Users can mark lessons as complete.
    *   The system automatically calculates and displays a course completion percentage.
    *   Total points are displayed on the user's profile.
*   **Comprehensive Admin Panel (CMS):**
    *   Full CRUD (Create, Read, Update, Delete) management for Jobs, Courses, Projects, and eLibrary Resources.
    *   Advanced interface for managing nested course content (Topics and Lessons).
    *   A global Site Settings page to dynamically control the site name, logo, and footer links.

## Tech Stack

*   **Backend:** PHP 8.1 / Laravel 10
*   **Frontend:** Blade / Tailwind CSS / Alpine.js
*   **Database:** MySQL

## Getting Started

Follow these instructions to get a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

You will need a local development environment with the following installed:
*   PHP >= 8.1
*   Composer
*   Node.js & npm
*   A local database server (e.g., MySQL via XAMPP, WAMP, or Laragon)

### Installation Procedure

Follow these steps to set up the project locally.

**1. Clone the Repository**
   Open your terminal and clone the project from GitHub:
   ```bash
   git clone https://github.com/osumba404/digital-leap-africa.git
   ```
   Navigate into the project directory:
   ```bash
   cd digital-leap-africa
   ```

**2. Install Dependencies**
   Install all the required PHP and JavaScript packages:
   ```bash
   # Install PHP dependencies
   composer install

   # Install JavaScript dependencies
   npm install
   ```

**3. Configure the Environment**
   Create your local environment file and generate a unique application key:
   ```bash
   # Create the .env file
   cp .env.example .env

   # Generate the app key
   php artisan key:generate
   ```

**4. Set Up the Database**
   *   Create a new, empty database using your preferred database tool (e.g., phpMyAdmin).
   *   Open the `.env` file you just created and update the `DB_` variables with your local database credentials:
     ```dotenv
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=your_database_name
     DB_USERNAME=your_database_username
     DB_PASSWORD=your_database_password
     ```

**5. Run Migrations and Seed the Database**
   This command will create all the necessary tables and populate them with the default content (sample courses, admin settings, etc.).
   ```bash
   php artisan migrate:fresh --seed
   ```

**6. Create the Storage Link**
   This makes your publicly stored files (like uploaded logos) accessible from the web.
   ```bash
   php artisan storage:link
   ```

**7. Compile Frontend Assets**
   Compile the CSS and JavaScript files for development:
   ```bash
   npm run dev
   ```
   *Keep this process running in a separate terminal window to automatically recompile assets as you make changes.*

**8. Serve the Application**
   In another terminal window, start the Laravel development server:
   ```bash
   php artisan serve
   ```
   The application will now be running at **http://127.0.0.1:8000**.

### Admin Access

To access the Admin Panel, you need to grant a user the `admin` role.

1.  **Register a new user** on the website.
2.  Open your database tool, navigate to the `users` table, and find the user you just created.
3.  Change the value in the `role` column from `user` to `admin`.
4.  Log in with that user, and you will see the "Admin Panel" link in the navigation.

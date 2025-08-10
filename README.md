# Digital Leap Africa

An online learning and skills development platform aimed at empowering users across Africa with accessible, quality educational resources.

Digital Leap Africa bridges the skills gap by offering courses, projects, a digital library, and a community hub. The platform supports web and USSD access, with gamification features and multi-language support (English, Swahili, French).

**Project Status:** Phase 3 (Accounts and Roles) in progress. Core authentication is complete.

## ✨ Core Features

* **10 Core Pages:** Homepage, Dashboard, Courses, Projects, eLibrary, Community, Events, Jobs, Profile, and Admin Panel.
* **Authentication:** Secure token-based API authentication using Laravel Sanctum, with social login via Google OAuth planned.
* **Multi-Language Support:** English, Swahili, and French.
* **USSD Access:** Core functionalities accessible via a USSD shortcode for users with limited internet.
* **Gamification:** A system of points, badges, and leaderboards to motivate learners.

## 💻 Tech Stack

* **Frontend:** React (Vite), Vue (for select components), Tailwind CSS, Axios
* **Backend:** Laravel 10+, PHP 8.1
* **Database:** MySQL 8.0
* **Authentication:** Laravel Sanctum (for API tokens)
* **APIs & Integrations:** Africa's Talking (USSD & SMS), Intervention Image

## 📂 Project Structure

```
digital-leap-africa/
├── backend/        # Laravel backend
├── frontend/
│   ├── react-app/  # React (Vite) primary app
│   └── vue-app/    # Vue components (e.g., Community, Jobs)
└── README.md       # This file
```

## 🛠️ Prerequisites

* Node.js v18+
* PHP v8.1+
* Composer
* MySQL v8.0+
* Git

## ⚙️ Setup and Installation

Follow these steps to get your local development environment running.

### 1. Clone the Repository

```bash
git clone https://github.com/osumba404/digital-leap-africa.git
cd digital-leap-africa
```

---

### 2. Backend Setup (Laravel)

```bash
# Navigate to the backend directory
cd backend

# Install PHP dependencies
composer install

# Create your environment file from the example
cp .env.example .env

# Generate a new application key
php artisan key:generate

# Configure your DB_DATABASE, DB_USERNAME, and DB_PASSWORD in the .env file.
# Make sure you have created a database named 'dla'.

# Run migrations and seed the database with initial data (including the admin user)
php artisan migrate:fresh --seed
```

> This will set up all necessary tables and create a default admin user.

---

### 3. Frontend Setup (React)

```bash
# Navigate to the React app directory from the project root
cd frontend/react-app

# Install Node.js dependencies
npm install
```

Create a local environment file:

```
# Create a new file named .env.local and add the following line:
VITE_API_URL=http://localhost:8000/api
```

## ▶️ Running the Application

You will need to run the frontend and backend servers in two separate terminals.

**Terminal 1 (Backend):**

```bash
cd backend
php artisan serve
```

The backend API will be running at `http://localhost:8000`.

**Terminal 2 (Frontend):**

```bash
cd frontend/react-app
npm run dev
```

The frontend will be running at `http://localhost:5173` (or the next available port).

## Default Login Credentials

After seeding the database, you can log in with the following default admin account:

* **Email:** [admin@digitalleap.africa](mailto:admin@digitalleap.africa)
* **Password:** password

## 🤝 Contributing

1. Create a new feature branch from the `develop` branch (e.g., `git checkout -b feat/user-profile`).
2. Make your changes and commit them with clear, descriptive messages following conventional commit standards.
3. Push your branch to the repository and open a Pull Request (PR) against `develop`.
4. All PRs require at least one review before they can be merged.

---

If you need additional setup instructions (Docker, CI/CD, testing, or deployments), add them to this README in the relevant sections.

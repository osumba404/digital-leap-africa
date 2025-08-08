# Digital Leap Africa

An online learning and skills development platform aimed at empowering users across Africa with accessible, quality educational resources.

Digital Leap Africa bridges the skills gap by offering courses, projects, a digital library, and a community hub. The platform supports web and USSD access, with gamification features and multi-language support (English, Swahili, French).

## ✨ Core Features

- 10 key pages: Homepage, Dashboard, Courses, Projects, eLibrary, Community, Events, Jobs, Profile, Admin Panel
- Multi-language support: English, Swahili, French
- USSD access for limited internet users
- Gamification: points, badges, leaderboards
- Google OAuth for social login
- Community forum, event, and job listings

## 💻 Tech Stack

- Frontend: React (Vite), Vue (select components), Tailwind CSS, Axios
- Backend: Laravel 10+, PHP 8.1
- Database: MySQL 8.0
- APIs: Africa's Talking (USSD & SMS), Google OAuth, Intervention Image

## 📂 Project Structure

```
digital-leap-africa/
├── backend/           # Laravel backend
├── frontend/
│   ├── react-app/     # React (Vite) primary app
│   └── vue-app/       # Vue components (Community, Jobs)
└── README.md          # This file
```

## 🛠️ Prerequisites

- Node.js v18+
- PHP v8.1+
- Composer
- MySQL v8.0+
- Git

## ⚙️ Setup and Installation

### 1. Clone the repository

```bash
git clone https://github.com/osumba404/digital-leap-africa.git
cd digital-leap-africa
```

### 2. Backend Setup (Laravel)

```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
# Configure DB in .env (DB_DATABASE, DB_USERNAME, DB_PASSWORD)
php artisan migrate
```

### 3. Frontend Setup (React)

```bash
cd ../frontend/react-app
npm install
# Create .env.local with:
# VITE_API_URL=http://localhost:8000
```

### 4. Running the Application

Open two terminals:

- Terminal 1 (Backend):

  ```bash
  cd backend
  php artisan serve
  ```

  Backend runs at [http://localhost:8000](http://localhost:8000)

- Terminal 2 (Frontend):

  ```bash
  cd frontend/react-app
  npm run dev
  ```

  Frontend runs at [http://localhost:5173](http://localhost:5173) (or next available port)

## 🤝 Contributing

- Branch from `develop` (e.g., `feat/user-dashboard`)
- Commit with clear messages
- Push branch and open PR against `develop`
- At least one review required before merge

# Artisan Serve Consulting – Project Management System

A web-based project management system built with [Laravel](https://laravel.com), designed for tracking, creating, and managing projects with user authentication.

## Features

- User registration and authentication
- Create, edit, and delete projects
- View all projects or only your own
- Filter projects by title and start date
- Paginated project lists
- Project phases: design, development, testing, deployment, complete

## Getting Started

### Prerequisites

- PHP >= 8.2
- Composer
- Node.js & npm

### Installation

1. **Clone the repository:**
   ```sh
   git clone git@github.com:branticus94/assignment-3-backend-development.git
   cd project-management-system
   ```

2. **Install PHP dependencies:**
   ```sh
   composer install
   ```

3. **Install JavaScript dependencies:**
   ```sh
   npm install
   ```

4. **Copy and configure environment variables:**
   ```sh
   cp .env.example .env
   # Edit .env as needed (APP_KEY, DB settings, etc.)
   php artisan key:generate
   ```

5. **Run database migrations and seeders:**
   ```sh
   php artisan migrate --seed
   ```

6. **Build frontend assets:**
   ```sh
   npm run build
   # Or for development:
   npm run dev
   ```

7. **Start the development server:**
   ```sh
   php artisan serve
   ```

## Usage

- Register a new account or log in.
- Create new projects, edit or delete your own.
- Use filters on the "All Projects" page to search.
- View project details and owner information.

## Folder Structure

- `app/Http/Controllers/` – Application controllers
- `app/Models/` – Eloquent models
- `resources/views/` – Blade templates
- `routes/web.php` – Web routes
- `database/migrations/` – Database schema
- `database/factories/` – Model factories
- `database/seeders/` – Seed data

---

For more details, see the [Laravel documentation](https://laravel.com/docs)

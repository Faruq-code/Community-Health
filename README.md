# Community Health Issue Reporting System

A full-stack web application built with **Laravel 11** and **MySQL** for reporting and managing community health issues. Featuring a "Refined Dark Editorial" design, secure UUID-based identification, and separate User/Admin portals.

## ✨ Features

- **User Portal**:
  - Secure registration and login.
  - Report community health issues with category and priority.
  - View status updates and admin responses.
  - Contact the support team via a dedicated contact form.
- **Admin Dashboard**:
  - Overview of all reports and contact messages.
  - Update report status (Pending → Resolved).
  - Respond to user reports.
  - Manage contact messages.
- **Architecture**:
  - Secure UUIDs for Users, Reports, and Messages.
  - Role-based access control (Admin vs. User).
  - "Refined Dark Editorial" aesthetic using Tailwind CSS & Glassmorphism.

## 🛠 Tech Stack

- **Framework**: Laravel 11
- **Database**: MySQL (Port 3306)
- **Frontend**: Blade, Tailwind CSS, Alpine.js
- **Auth**: Custom Admin Guard + Default User Auth

## 🚀 Setup Instructions

### 1. Requirements
- PHP 8.2+
- Composer
- MySQL Server (XAMPP recommended)

### 2. Installation
```bash
# Clone the repository
git clone <repository-url>
cd Community-Health

# Install dependencies
composer install
```

### 3. Environment Configuration
Create a `.env` file (or copy `.env.example`) and configure your database:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=community_health
DB_USERNAME=root
DB_PASSWORD=YourPassword123

SESSION_DRIVER=database
```

### 4. Database Setup
```bash
php artisan key:generate
php artisan migrate:fresh --seed
php artisan db:seed --class=AdminSeeder
```

### 5. Run the Application
```bash
php artisan serve
```
Visit: `http://127.0.0.1:8000`

## 🔑 Default Credentials
- **Admin**: `admin@community.com` / `admin123`
- **Test User**: `test@example.com` / `password`

## 📝 License
This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

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

## 🚀 Stress-Free Setup (Windows)

We've provided two scripts to make setup as easy as possible:
1. **`setup.bat`**: Run this first. It checks for PHP/Composer, creates your `.env`, and installs dependencies.
2. **`dev.bat`**: Run this to start the application. It launches both the PHP server and Vite at once.

---

## 🛠 Choose Your Setup Method

### 1. The Modern Way (Recommended)
Use **[Laravel Herd](https://herd.laravel.com/)**. It's a zero-config environment for Windows/Mac.
- **Why?** It includes PHP, Nginx, and Node.js. No need to install anything else.
- **Steps**:
  1. Install Laravel Herd.
  2. Open this folder in your terminal.
  3. Run `setup.bat`.
  4. Run `php artisan migrate --seed`.

### 2. The Classic Way (XAMPP)
Use XAMPP if you already have it installed.
- **Important**: You only need **MySQL** from XAMPP. You do **NOT** need to start Apache.
- **Steps**:
  1. Open XAMPP Control Panel and Start **MySQL**.
  2. Run `setup.bat`.
  3. Run `php artisan migrate --seed`.
  4. Run `dev.bat` to see the site.

### 3. The "No-Install" Way (SQLite)
If you don't want to install XAMPP or Herd at all.
- **Steps**:
  1. Open `.env` and change `DB_CONNECTION=mysql` to `DB_CONNECTION=sqlite`.
  2. Create an empty file in `database/` called `database.sqlite`.
  3. Run `setup.bat`.
  4. Run `php artisan migrate --seed`.

---

## 🏗 Setup Commands (Manual)

If you prefer manual setup:

```bash
# 1. Install dependencies
composer install
npm install

# 2. Setup environment
cp .env.example .env
php artisan key:generate

# 3. Database
php artisan migrate --seed

# 4. Start Development
php artisan serve
npm run dev
```

## 🔑 Default Credentials
- **Admin**: `admin@community.com` / `admin123`
- **Test User**: `test@example.com` / `password`

## 📝 License
This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

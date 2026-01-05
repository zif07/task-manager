🚀 Installation & Setup Guide
1️⃣ Prerequisites

Ensure the following are installed:

PHP ≥ 8.1

Composer

MySQL (phpMyAdmin)

Node.js (optional, if frontend assets are used)

2️⃣ Clone / Extract Project

If using Google Drive:

Extract the ZIP file
cd task-manager

3️⃣ Install Dependencies
composer install


(Optional)

npm install
npm run dev

4️⃣ Environment Setup
copy .env.example .env
php artisan key:generate


Update .env database settings:

DB_DATABASE=task_manager
DB_USERNAME=root
DB_PASSWORD=

5️⃣ Database Migration
php artisan migrate

6️⃣ Run the Application
php artisan serve


Access:

http://127.0.0.1:8000

👑 Admin Access
Make a User Admin

In phpMyAdmin:

UPDATE users SET role = 'admin' WHERE email = 'admin@example.com';


Or via Admin Panel (recommended).

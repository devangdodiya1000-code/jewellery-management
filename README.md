# Aurum Jewellery Management System

A modern Jewellery Management System built with Laravel 12.  
This project includes authentication using Laravel Breeze, an admin panel for managing categories and products, and a product listing page with category-wise filtering and global search functionality.

---

# Features

## Frontend Features

- Product listing by category
- Global product search/filter
- Responsive UI
- User authentication system

## Admin Panel Features

### Category Management
- Create Category
- Update Category
- Delete Category
- View Categories

### Product Management
- Create Product
- Update Product
- Delete Product
- View Products

## Authentication

This project uses Laravel Breeze for authentication.

Features include:
- Login
- Registration
- Logout
- Password Protection

---

# Tech Stack

- Laravel 12
- PHP 8.2+
- Laravel Breeze
- MySQL
- Node.js 20+
- Vite
- Tailwind CSS / Bootstrap

---

# System Requirements

Before running this project, make sure your system has the following installed:

| Requirement | Version |
|---|---|
| PHP | 8.2+ |
| Composer | Latest |
| Node.js | 20+ |
| NPM | Latest |
| MySQL | 5.7+ / 8+ |

---

# Installation Guide

Follow the steps below to run the project on your local system.

---

## 1. Clone the Repository

```bash
git clone <your-repository-url>
```

Move into the project directory:

```bash
cd aurum-jewellery-management
```

---

## 2. Install PHP Dependencies

```bash
composer install
```

---

## 3. Install Node Modules

```bash
npm install
```

---

## 4. Create Environment File

Copy the `.env.example` file and create a new `.env` file:

```bash
cp .env.example .env
```

---

## 5. Generate Application Key

```bash
php artisan key:generate
```

---

## 6. Configure Database

Open the `.env` file and update your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=aurum_jewellery
DB_USERNAME=root
DB_PASSWORD=
```

---

## 7. Run Database Migrations

```bash
php artisan migrate
```

---

## 8. Start Development Server

Run Laravel development server:

```bash
php artisan serve
```

In another terminal, run Vite server:

```bash
npm run dev
```

---

# Default Application URLs

| Service | URL |
|---|---|
| Laravel App | http://127.0.0.1:8000 |
| Vite Dev Server | http://127.0.0.1:5173 |

---

# Admin Panel

The admin panel allows administrators to manage:

## Categories

- Add Categories
- Edit Categories
- Delete Categories
- View Category List

## Products

- Add Products
- Edit Products
- Delete Products
- View Product List

---

# Product Listing Features

Users can:

- View products category-wise
- Search products using global filter/search
- Browse products easily

---

# Useful Commands

## Run Laravel Server

```bash
php artisan serve
```

## Run Vite Development Server

```bash
npm run dev
```

## Build Frontend Assets

```bash
npm run build
```

## Run Migrations

```bash
php artisan migrate
```

## Clear Application Cache

```bash
php artisan optimize:clear
```

---

# Project Folder Structure

```bash
app/
bootstrap/
config/
database/
public/
resources/
routes/
storage/
tests/
```

---

# Security Features

- Laravel Breeze Authentication
- CSRF Protection
- Password Hashing
- Protected Admin Routes

---

# Future Improvements

- Order Management
- Invoice Generation
- Customer Management
- Product Image Upload
- Dashboard Analytics
- Role & Permission Management

---

# Author

Developed by **Devang Dodiya**

---

#Images

<img width="1920" height="1008" alt="Screenshot from 2026-05-28 09-44-59" src="https://github.com/user-attachments/assets/00412b63-ca1a-4787-9019-3426c69c2376" />
<img width="1920" height="1008" alt="Screenshot from 2026-05-28 09-45-05" src="https://github.com/user-attachments/assets/badd26b9-aef1-4897-bdc8-4341851373d6" />
<img width="1920" height="1008" alt="Screenshot from 2026-05-28 09-45-15" src="https://github.com/user-attachments/assets/bb75d0d1-860e-424d-9f0a-7ed2787717f4" />
<img width="1920" height="1008" alt="Screenshot from 2026-05-28 09-45-32" src="https://github.com/user-attachments/assets/5f630a4e-7822-4f9f-9d27-7ad751340512" />
<img width="1920" height="1008" alt="Screenshot from 2026-05-28 09-45-43" src="https://github.com/user-attachments/assets/c9786f7c-a5c4-427c-8872-194f8072a9a1" />
<img width="1920" height="1008" alt="Screenshot from 2026-05-28 09-43-26" src="https://github.com/user-attachments/assets/8353aed4-1bf7-4d0d-93ea-17966f57aab7" />
<img width="1920" height="1008" alt="Screenshot from 2026-05-28 09-43-48" src="https://github.com/user-attachments/assets/412d4402-a3d4-46e9-95f1-693f9d2f2ec7" />
<img width="1920" height="1008" alt="Screenshot from 2026-05-28 09-43-57" src="https://github.com/user-attachments/assets/89bd2db0-ec70-422d-99fb-f92915ec407a" />
<img width="1920" height="1008" alt="Screenshot from 2026-05-28 09-44-04" src="https://github.com/user-attachments/assets/6f01a9b5-13c6-46d6-a2d0-b817398ab945" />
<img width="1920" height="1008" alt="Screenshot from 2026-05-28 09-44-23" src="https://github.com/user-attachments/assets/3b6c058a-92a8-47c8-8191-2c05cc4a5001" />
<img width="1920" height="1008" alt="Screenshot from 2026-05-28 09-44-31" src="https://github.com/user-attachments/assets/ab076568-8b0b-42d2-b65f-c52701a78f42" />
<img width="1920" height="1008" alt="Screenshot from 2026-05-28 09-42-07" src="https://github.com/user-attachments/assets/77f746cc-a1cd-42e9-8cb7-7451f7314705" />
<img width="1920" height="1008" alt="Screenshot from 2026-05-28 09-42-07" src="https://github.com/user-attachments/assets/4c7a93c5-5116-4dd0-9a34-58bc3fcc7abc" />


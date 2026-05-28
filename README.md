Aurum Jewellery Management System

A modern Jewellery Management System built with Laravel 12.
This project includes authentication using Laravel Breeze, an admin panel for managing categories and products, and a product listing page with category-wise filtering and global search functionality.

Features
Frontend Features
Product listing by category
Global product search/filter
Responsive UI
User authentication
Admin Panel Features
Category CRUD
Create Category
Update Category
Delete Category
View Categories
Product CRUD
Create Product
Update Product
Delete Product
View Products
Authentication
Laravel Breeze Authentication
Login
Registration
Password protection
Tech Stack
PHP 8.2+
Laravel 12
Laravel Breeze
MySQL
Node.js 20+
Vite
Bootstrap / Tailwind CSS
System Requirements

Before running this project, make sure your system has the following installed:

Requirement	Version
PHP	8.2+
Composer	Latest
Node.js	20+
NPM	Latest
MySQL	5.7+ / 8+
Installation Guide

Follow the steps below to run the project on your local system.

1. Clone the Repository
git clone <your-repository-url>

Move into the project directory:

cd aurum-jewellery-management
2. Install PHP Dependencies
composer install
3. Install Node Modules
npm install
4. Create Environment File

Copy the .env.example file and create a new .env file:

cp .env.example .env
5. Generate Application Key
php artisan key:generate
6. Configure Database

Open the .env file and update your database credentials:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=aurum_jewellery
DB_USERNAME=root
DB_PASSWORD=
7. Run Database Migrations
php artisan migrate
8. Start Development Server

Run Laravel server:

php artisan serve

In another terminal, run Vite:

npm run dev
Default Application URLs
Service	URL
Laravel App	http://127.0.0.1:8000
Vite Dev Server	http://127.0.0.1:5173
Authentication Setup

This project uses Laravel Breeze for authentication.

Available authentication features:

Login
Register
Logout
Password Protection
Admin Panel

The admin panel allows administrators to manage:

Categories
Add new categories
Edit existing categories
Delete categories
View category list
Products
Add products
Edit products
Delete products
View product list
Product Listing Features

Users can:

View products category-wise
Search products using global filter/search
Browse products easily
Useful Commands
Run Development Server
php artisan serve
Run Vite
npm run dev
Build Frontend Assets
npm run build
Run Migrations
php artisan migrate
Clear Cache
php artisan optimize:clear
Folder Structure
app/
bootstrap/
config/
database/
public/
resources/
routes/
storage/
Security
Authentication handled using Laravel Breeze
CSRF protection enabled
Password hashing included by default
Future Improvements
Order Management
Invoice Generation
Customer Management
Role & Permission Management
Product Image Upload
Dashboard Analytics
Author

Developed by Devang Dodiya

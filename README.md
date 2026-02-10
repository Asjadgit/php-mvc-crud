# Core PHP MVC CRUD (Laravel Learning Project)

A simple **CRUD application built using Core PHP** to demonstrate the **MVC (Model–View–Controller) architecture** from scratch.
This project is designed for **beginners learning Laravel** who want to understand what happens *under the hood* before using a framework.

---

## 🎯 Purpose of This Project

Frameworks like Laravel hide a lot of complexity. This repository exists to:

* Understand MVC architecture clearly
* Learn how routing works internally
* See how controllers, models, and views interact
* Understand database abstraction using PDO
* Build confidence before moving to Laravel

> If you understand this project, Laravel will feel much easier.

---

## 🧠 What You Will Learn

* MVC architecture in plain PHP
* Front controller pattern (`index.php`)
* Clean URL routing using `.htaccess`
* Database connection using PDO
* CRUD operations without any framework
* Separation of concerns (logic vs UI)

---

## 📁 Project Structure

```
php-mvc-crud/
│
├── app/
│   ├── Controllers/
│   │   └── UserController.php
│   │
│   ├── Models/
│   │   └── User.php
│   │
│   └── Views/
│       └── users/
│           ├── index.php
│           ├── create.php
│           └── edit.php
│
├── core/
│   ├── Controller.php
│   └── Database.php
│
├── public/
│   ├── .htaccess
│   └── index.php
│
└── README.md
```

---

## 🏗 Architecture Overview

```
Request (URL)
   ↓
index.php (Front Controller)
   ↓
Controller
   ↓
Model (Database)
   ↓
Controller
   ↓
View (HTML)
```

This is the same request lifecycle used by Laravel and other modern frameworks.

---

## 🗄 Database Setup

Create a MySQL database and table:

```sql
CREATE DATABASE php_mvc;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100)
);
```

---

## 🔌 Core Components Explained

### Database Class (`core/Database.php`)

* Centralized database connection
* Uses PDO for secure queries
* Similar to Laravel's `config/database.php`

```php
Database::connect();
```

---

### Base Controller (`core/Controller.php`)

* Shared parent controller
* Responsible for loading views
* Extended by all controllers

```php
$this->view('users/index', compact('users'));
```

---

## 📦 Model Layer

### User Model (`app/Models/User.php`)

Handles all database operations:

* Fetch all users
* Create new user
* Find user by ID
* Update user
* Delete user

> No SQL logic exists in controllers.

---

## 🎮 Controller Layer

### UserController (`app/Controllers/UserController.php`)

Handles application logic:

* Receives request
* Calls model methods
* Returns views

Equivalent to a **Laravel resource controller**.

---

## 🖼 View Layer

Views contain only HTML and minimal PHP.

Example:

```php
<?php foreach ($users as $user): ?>
    <?= $user['name']; ?>
<?php endforeach; ?>
```

> No database or business logic in views.

---

## 🚦 Routing

Routing is handled using:

* `.htaccess` for clean URLs
* `public/index.php` as front controller

Example URLs:

```
/user
/user/create
/user/edit/1
/user/delete/1
```

---

## ▶ How to Run the Project

1. Clone the repository
2. Place it inside `htdocs` (XAMPP) or `www` (WAMP)
3. Import the database
4. Start Apache & MySQL
5. Open browser:

```
http://localhost/php-mvc-crud/public
```

---

## 🔗 Laravel Concept Mapping

| Core PHP       | Laravel          |
| -------------- | ---------------- |
| index.php      | public/index.php |
| Controller.php | Base Controller  |
| PDO            | Eloquent / DB    |
| Views          | Blade Templates  |
| Manual routing | Laravel Router   |

---

## 👨‍🎓 Who Is This For?

* Beginners learning Laravel
* Students learning MVC
* Developers preparing for interviews
* Anyone wanting to understand backend fundamentals

---

## 📌 Disclaimer

This project is **for learning purposes only** and does not include advanced features like authentication, validation, or security layers.

---

## ⭐ If You Found This Helpful

* Star the repository ⭐
* Share it with other learners
* Use it as a foundation before learning Laravel

---

## 📬 Feedback & Contributions

Suggestions and improvements are welcome. Feel free to open an issue or submit a pull request.

Happy coding 🚀

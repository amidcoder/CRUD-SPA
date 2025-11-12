# Laravel + Vue 3 SPA (DDD Architecture)

A full-stack Single Page Application built with **Laravel 11 (API Backend)** and **Vue 3 (Frontend)**.  
Implements **Domain‑Driven Design**, **Sanctum Authentication**, and **Role‑Based Access Control** with an **Element Plus UI**.

---

## 🚀 Features

- 🧩 **DDD Structure** (Domain, Application, Infrastructure)
- 🔐 **Laravel Sanctum Auth**
- 👥 **User Roles** (admin / user)
- 📦 **CRUD** for Posts (Eloquent Repository pattern)
- 🎨 **Element Plus + Pinia + Vue Router**
- ⚙️ **XAMPP local setup** (no Docker)
- 💾 **RESTful API**, SPA frontend, and CORS ready

---

## 🏗️ Architecture Overview

```
src/
 ├── Domains/
 │    ├── Posts/
 │    │    ├── Entities/
 │    │    └── Repositories/
 ├── Application/
 │    └── UseCases/
 └── Infrastructure/
      └── Persistence/
```

Frontend (Vue 3):
```
src/
 ├── components/
 ├── stores/
 ├── views/
 ├── router/
 └── App.vue
```

---

## 🧰 Tech Stack

| Layer      | Technology                     |
|:------------|:-------------------------------|
| Backend     | Laravel 11 + PHP 8.3           |
| Auth        | Laravel Sanctum                |
| Frontend    | Vue 3 + Pinia + Element Plus   |
| Database    | MySQL (XAMPP)                  |

---

## ⚙️ Installation

### 1️⃣ Backend (Laravel 11)
```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Ensure `.env` includes:
```
APP_URL=http://127.0.0.1:8000
FRONTEND_URL=http://localhost:5173
```

### 2️⃣ Frontend (Vue 3)
```bash
cd frontend
npm install
npm run dev
```

Then open **http://localhost:5173**

---

## 🔑 Authentication Workflow

- Register/Login via `/api/register` and `/api/login`  
- Sanctum issues a personal access token  
- Token stored in Pinia Store and used in `Authorization: Bearer` header  

---

## 🧠 Use Case – Post CRUD

| Action | Method | Endpoint |
|:--------|:--------|:----------|
| List | GET | `/api/posts` |
| Create | POST | `/api/posts` |
| Update | PUT | `/api/posts/{id}` |
| Delete | DELETE | `/api/posts/{id}` |

Each route protected by **`auth:sanctum` middleware**.

---

## 🧩 Dependency Binding

Registered inside:
```php
// app/Providers/AppServiceProvider.php
$this->app->bind(
  \App\Domains\Posts\Repositories\PostRepositoryInterface::class,
  \Src\Infrastructure\Persistence\EloquentPostRepository::class
);
```

---

## 🧾 License

**MIT License © 2025 – Amid Ahmadi‑Afshar**  
Built for educational and professional reference (SPA + DDD pattern).

---

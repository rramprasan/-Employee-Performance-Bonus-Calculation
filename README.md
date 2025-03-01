# 🎯 Employee Bonus Management System  

## 📌 Introduction  
This is an **Employee Bonus Management System** built using **Laravel 12**. The system allows administrators to manage employees, calculate bonuses, and generate reports.

## 🚀 Features  
✔️ **User Authentication** (Admin & Employee roles)  
✔️ **Employee Management** (CRUD operations)  
✔️ **Bonus Calculation**  
✔️ **Bonus Reports**  
✔️ **Role-based Access Control**  

## 🛠️ Tech Stack  
- **Backend:** Laravel 12  
- **Database:** MySQL  
- **Frontend:** Blade Templates  

---

## 📖 Installation Guide  

### ✅ Prerequisites  
Ensure you have the following installed:  
- **PHP** 8.1+  
- **Composer**  
- **MySQL**  
- **Laravel 12**  

### 📂 Step 1: Clone the Repository  
```sh
git clone https://github.com/-Employee-Performance-Bonus-Calculation
cd employee-bonus-management
```

### 📦 Step 2: Install Dependencies  
```sh
composer install
npm install
npm run dev
```

### ⚙️ Step 3: Create Environment File  
```sh
cp .env.example .env
```
Update the `.env` file with your database details.

### 🏗️ Step 4: Create Database  
Manually create a new database:  
- **Database Name:** `employee`  
- **Collation:** `utf8mb4_unicode_ci`  

Run migrations:  
```sh
php artisan migrate --seed
```

### 🔑 Step 5: Generate Application Key  
```sh
php artisan key:generate
```

### 🚀 Step 6: Run the Server  
```sh
php artisan serve
```

---

## 🔗 API Routes  

### 💰 Bonus Routes  
📌 **Calculate Bonus:** `POST /api/calculate-bonus`  
📌 **Get Bonus Report:** `GET /api/getEmployeesReport`  

---

## 🔐 Admin Login Credentials  
```sh
Email: admin@admin.com
Password: admin123
```

---

## 📜 License  
This project is open-sourced software licensed under the [MIT License](https://opensource.org/licenses/MIT).  

---

### 🎯 Want to contribute?  
Feel free to fork this repository, open issues, or submit pull requests to enhance the project! 🚀  

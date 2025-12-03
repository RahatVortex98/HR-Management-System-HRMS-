🏢 Full-Stack HR Management System (HRMS)

A complete Human Resource Management System built with Laravel and Filament PHP, featuring dedicated and secure portals for Admins, HR Managers, and Employees.
Designed using a Server-Driven UI architecture powered by the TALL Stack (Tailwind, Alpine.js, Livewire, Laravel) for fast and scalable development.


✨ Key Features
1. Multi-Panel Role-Based Access

        ✔ Admin Panel – Manage system settings, roles, permissions, departments, and job positions
        ✔ HR Manager Panel – Oversee attendance, leave requests, payroll, and performance reviews
        ✔ Employee Panel – Self-service access to attendance logs, leave requests, payslips, and profile info

All panels run inside the same Laravel project using Filament’s multi-panel support.

2. Core HR Modules
   
        | Module                     | Description                                             |
        | -------------------------- | ------------------------------------------------------- |
        | **User & Access Control**  | Role-based permissions powered by *Filament Shield*     |
        | **Organization Structure** | Manage departments, positions, and reporting hierarchy  |
        | **Leave Management**       | Submit, approve, reject, and track leave requests       |
        | **Attendance Tracking**    | Check-in/out system with daily hour calculations        |
        | **Payroll**                | Automatic salary generation using Laravel Queues & Jobs |
        | **Performance Reviews**    | Evaluate employee performance with scoring & feedback   |

🛠 Technology Stack

        Backend: Laravel 12 (PHP)
        
        UI: Filament PHP v4 (Server-Driven)
        
        Frontend: Tailwind CSS, Livewire, Alpine.js (TALL Stack)
        
        Database: MySQL (Eloquent ORM)
        
        Background Jobs: Laravel Queues (used for payroll processing)

🚀 Getting Started:

        Clone the Repository
        git clone [YOUR_REPO_URL]
        cd hrms-filament

Install Dependencies:

        composer install

Environment Setup:

        cp .env.example .env
        php artisan key:generate


Update your .env file with your database credentials.

Run Migrations & Seeders:

        php artisan migrate --seed

Start Development Server:

        php artisan serve


Open in browser:

        http://127.0.0.1:8000

🔐 Panels & Access Paths

    | Role                 | URL         |
    | -------------------- | ----------- |
    | **Admin Panel**      | `/admin`    |
    | **HR Manager Panel** | `/hr`       |
    | **Employee Panel**   | `/employee` |


📄 License
This project is open-sourced and available under the MIT License.



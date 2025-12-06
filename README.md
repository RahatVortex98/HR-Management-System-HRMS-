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

        Others: Filament sheild-> https://filamentphp.com/plugins/bezhansalleh-shield

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


#Installing the panel builder    
    
#Filament Sheild:

    composer require filament/filament:"^4.0"

    php artisan filament:install --panels

    > Open /admin in your web browser, sign in, and start building your app!

    
#1. Install Package(filament):
    
    composer require bezhansalleh/filament-shield

#2. Configure Auth Provider

1.Publish the config and set your auth provider model.

    php artisan vendor:publish --tag="filament-shield-config"

2.Add the HasRoles trait to your auth provider model:

    use Spatie\Permission\Traits\HasRoles;
 
    class User extends Authenticatable
    {
        use HasRoles;
    }
    
#3. Setup Shield

Run the setup command (it is interactive and smart):

    $php artisan shield:setup

#4. Command for making Super admin:

    php artisan shield:super-admin

<img width="879" height="278" alt="cap" src="https://github.com/user-attachments/assets/0be0ceb9-d6b0-45c1-b748-b57bd24c9096" />

Login Interface: http://127.0.0.1:8000/admin/login 

<img width="1366" height="651" alt="login interface" src="https://github.com/user-attachments/assets/4e8fe9f0-b4c6-4e61-b1fb-e59f5648b77c" />

Generating Model To The Filament(dashboard):

    php artisan make:filament-resource model_name --generate

📄 License
This project is open-sourced and available under the MIT License.



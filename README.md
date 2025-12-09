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

    or,

    php artisan make:filament-resource model_name

Created New Employee By Super Admin:

<img width="1366" height="998" alt="New Employee Created By super admin" src="https://github.com/user-attachments/assets/d373e55f-7dbe-493b-8282-a2aca0c487af" />

After Creation:

<img width="2397" height="651" alt="view interface" src="https://github.com/user-attachments/assets/9e89f594-13c9-4043-a56e-5cf94ed4a033" />

After Creation Department:

<img width="1366" height="651" alt="deparment view" src="https://github.com/user-attachments/assets/5249c8ea-06b8-41d3-94a8-25616bc34b8b" />


After Creation Positions:

<img width="1366" height="651" alt="Position view" src="https://github.com/user-attachments/assets/6948d440-fb4d-4495-a32a-0d76c7c8af83" />

Leave Type Creation:

<img width="1366" height="651" alt="leave Type Creation" src="https://github.com/user-attachments/assets/741f208f-0d04-4bf4-8c71-f0d703718aaf" />

After Creation Leave Type:

<img width="1366" height="651" alt="leave Type View" src="https://github.com/user-attachments/assets/f8fe0f5c-3ad2-4123-a207-7850a5ae3023" />



📊 Filament Widget Generation:

    The command being executed is 
    php artisan make:filament-widget
    This is a Filament command used to scaffold the necessary files for adding a customized component, called a Widget,      
    to your Filament administration panel.  

<img width="894" height="331" alt="widget" src="https://github.com/user-attachments/assets/8781a33a-47a7-4749-9ccd-b031b8de7d32" />

    Input: Stats overview

    Result: The user chose the pre-built StatsOverviewWidget. 
    This is specifically designed to show a series of numerical 
    stats cards (like "Total Users," "Revenue Today," etc.) on the dashboard.

Link: https://filamentphp.com/docs/4.x/widgets/stats-overview

After adding widget:

<img width="1366" height="660" alt="after adding widget" src="https://github.com/user-attachments/assets/430c2f06-ba28-439d-ba23-657cb676221d" />


#Live updating stats (polling):

    protected ?string $pollingInterval = '60s'; //widgets refresh their data every 60 seconds.
    
#Disabling lazy loading:

    protected static bool $isLazy = false;

Updated Interface of Super Admin Dashboard:

<img width="1366" height="660" alt="updated dashboard super-admin" src="https://github.com/user-attachments/assets/2dfef528-1906-4047-9538-d9d388ee087c" />


Adding Hr Panel:

Link: https://filamentphp.com/docs/4.x/panel-configuration#the-default-admin-panel

    php artisan make:filament-panel hr 

    Super admin should build  Role section and give permission and then create hr manager....

<img width="1366" height="1022" alt="hr made by super admin" src="https://github.com/user-attachments/assets/5ef8760f-9ec8-477a-b963-a0a7afaae1a0" />


Login Interface: http://127.0.0.1:8000/hr/login


<img width="1358" height="660" alt="Hr Login Interface" src="https://github.com/user-attachments/assets/aaf98c57-1a21-48de-9659-e710300c27a7" />

After Login: 

<img width="1358" height="660" alt="after login" src="https://github.com/user-attachments/assets/e56b4722-c961-448b-84b2-184ed359f15e" />


Policies & Permissions for both super-admin and hr:

    php artisan shield:generate --all

<p align="center">
  <img src="https://github.com/user-attachments/assets/093a4f5c-9152-4194-92e5-abf141954837" width="48%" />
  <img src="https://github.com/user-attachments/assets/fa83390a-2971-4ab1-add2-04f6ce7eac62" width="48%" />
</p>



📄 License
This project is open-sourced and available under the MIT License.



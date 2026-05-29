# CourseHub DMU — University Course Management System

A full-stack web application for browsing and managing university programmes, modules, and academic staff. Built with **PHP (Slim Framework 4)** following the **MVC architecture pattern**, with an **SQLite** database and **Monolog** logging.

Developed for **CTEC3705: Web Application Development** — Niels Brock Copenhagen Business College / De Montfort University.

---

## How to Run the Website

### Prerequisites
- **XAMPP** (or any PHP 8.1+ environment with Composer)

### Steps

1. **Extract** the project folder into your XAMPP `htdocs` directory  
   Example path: `C:\xampp\htdocs\web-project-ctec-3705-group-2\`

2. **Start Apache** in the XAMPP Control Panel

3. **Open terminal** in the `coursehub` folder and run:
   ```
   composer install
   ```

4. **Start the PHP development server:**
   ```
   cd coursehub
   php -S localhost:8080 -t public
   ```

5. **Open your browser** and go to:
   - Public site: http://localhost:8080
   - Admin panel: http://localhost:8080/admin/login

The SQLite database comes **pre-populated** with 12 programmes, 34 modules, and 6 staff members. No additional database setup is required.

---

## Login Credentials

### Admin Panel
| Username | Password |
|----------|----------|
| admin | Admin1234! |

Access at: http://localhost:8080/admin/login

### Staff Portal
| Name | Email | Password |
|------|-------|----------|
| Dr. Alice Johnson | a.johnson@coursehub.ac.uk | Staff1234! |
| Prof. Mark Stevens | m.stevens@coursehub.ac.uk | Staff1234! |
| Dr. Priya Patel | p.patel@coursehub.ac.uk | Staff1234! |
| Mr. James Carter | j.carter@coursehub.ac.uk | Staff1234! |
| Dr. Fatima Al-Hassan | f.alhassan@coursehub.ac.uk | Staff1234! |
| Prof. David Okonkwo | d.okonkwo@coursehub.ac.uk | Staff1234! |

Access at: http://localhost:8080/staff/login

### Student Accounts (Test Users)
| Name | Email | Password |
|------|-------|----------|
| Urmi | urmi@gmail.com | urmi1234 |
| Rim | rim@gmail.com | rim12345 |

Access at: http://localhost:8080/login

You can also register a new student account at: http://localhost:8080/register

---

## All Features & Functionalities

### Public Pages (No Login Required)

| Feature | URL | Description |
|---------|-----|-------------|
| Homepage | `/` | Hero banner, statistics strip (12 programmes, 34 modules, 6 staff), search form, featured programmes, Why Choose Us section |
| Programme Listing | `/programmes` | Browse all published programmes with keyword search and level filter (Undergraduate / Postgraduate) |
| Programme Detail | `/programmes/{slug}` | Full programme page with description, modules by year, related programmes, programme leader info, and interest registration form |
| Module Listing | `/modules` | Browse all 34 modules with interactive filter chips by level, year, and shared status |
| Module Detail | `/modules/{id}` | Module overview, credit value, year of study, module leader with photo, and list of programmes that offer it |
| Staff Directory | `/staff` | Grid of all 6 academic staff with photos, roles, departments, and module counts |
| Staff Profile | `/staff/{id}` | Full staff profile with biography, contact details, teaching modules, and programmes led |
| Interest Registration | `/programmes/{slug}/register` | Register interest in a programme (works for both guests and logged-in students) |
| Interest Confirmation | `/interest/confirmed` | Confirmation page after successful registration |
| Interest Withdrawal | `/interest/withdraw` | Remove all interest registrations by email |

### Student Features (Login Required)

| Feature | URL | Description |
|---------|-----|-------------|
| Student Registration | `/register` | Create account with first name, last name, email, password (min 8 characters) |
| Student Login | `/login` | Sign in with email and password |
| Student Logout | `/logout` | Sign out and clear session |
| Account Dashboard | `/account` | View registered interests and saved favourites with stats |
| Edit Profile | `/account/edit` | Update name, phone, bio |
| Change Password | `/account/password` | Change password (requires current password) |
| Delete Account | `/account/delete` | Permanently delete account and all associated data |
| Forgot Password | `/forgot-password` | Request password reset via email |
| Reset Password | `/reset-password?token=...` | Set new password using secure token (expires in 1 hour) |
| Favourite Programmes | `/favourite/{slug}` | Toggle save/unsave a programme (heart button on programme pages) |
| Withdraw Interest | `/account/withdraw/{id}` | Remove a specific interest registration from dashboard |

### Staff Portal (Staff Login Required)

| Feature | URL | Description |
|---------|-----|-------------|
| Staff Login | `/staff/login` | Sign in with academic email and password |
| Staff Logout | `/staff/logout` | Sign out |
| Staff Portal | `/staff/portal` | Dashboard showing all modules, filter by "My Modules" or year, stats cards |
| Edit Profile | `/staff/profile/edit` | Update name, role, department, email, phone, office, photo URL, bio |
| Change Password | `/staff/profile/password` | Change password (requires current password) |
| Delete Profile | `/staff/profile/delete` | Permanently delete staff profile |

### Admin Dashboard (Admin Login Required)

| Feature | URL | Description |
|---------|-----|-------------|
| Admin Login | `/admin/login` | Sign in with username and password |
| Admin Logout | `/admin/logout` | Sign out |
| Dashboard | `/admin/dashboard` | Overview with stats, programmes table, recent registrations |
| **Programme Management** | | |
| List Programmes | `/admin/programmes` | Table of all programmes with status, module count, registration count |
| Create Programme | `/admin/programmes/create` | Form with title, level, duration, description, leader assignment, module selection |
| Edit Programme | `/admin/programmes/{id}/edit` | Update programme details and reassign modules |
| Delete Programme | `/admin/programmes/{id}/delete` | Remove a programme |
| Toggle Publish | `/admin/programmes/{id}/toggle` | Switch between Published and Draft status |
| **Module Management** | | |
| List Modules | `/admin/modules` | Table showing code, title, year, credits, leader, programme count |
| Create Module | `/admin/modules/create` | Form with title, code, year, credits, description, leader assignment |
| Edit Module | `/admin/modules/{id}/edit` | Update module details |
| Delete Module | `/admin/modules/{id}/delete` | Remove a module |
| **Staff Management** | | |
| List Staff | `/admin/staff` | Table with name, role, email, password (show/hide), module count |
| Create Staff | `/admin/staff/create` | Form with all staff details and password |
| Edit Staff | `/admin/staff/{id}/edit` | Update staff details, optionally change password |
| Delete Staff | `/admin/staff/{id}/delete` | Remove a staff member |
| **Registration Management** | | |
| View Registrations | `/admin/registrations` | Table of all interest registrations |
| Export CSV | `/admin/registrations/export` | Download all registrations as a CSV file |
| Delete Registration | `/admin/registrations/{id}/delete` | Remove a registration |

---

## Technical Details

### Tech Stack
| Layer | Technology |
|-------|-----------|
| Language | PHP 8.1+ |
| Framework | Slim Framework 4 |
| Database | SQLite 3 (PDO) |
| Logging | Monolog 3 (PSR-3) |
| Architecture | MVC (Model-View-Controller) |
| Frontend | PHP views, HTML5, CSS3, JavaScript |
| Icons | Font Awesome 6 |
| Images | Unsplash (free to use) |

### Database Schema (9 Tables, Normalised to 3NF)
| Table | Description | Relationships |
|-------|-------------|---------------|
| staff | 6 academic staff members | 1:M to programmes, 1:M to modules |
| programmes | 12 degree programmes (UG/PG) | M:M to modules (via programme_modules) |
| modules | 34 teaching modules | M:M to programmes (via programme_modules) |
| programme_modules | Junction table | Resolves programmes-modules M:M |
| students | Registered student accounts | M:M to programmes (via favourites) |
| favourites | Junction table | Resolves students-programmes M:M |
| interest_registrations | Interest submissions | M:1 to programmes, M:1 to students |
| admins | Admin login accounts | Standalone (no FK) |
| contact_messages | Contact form submissions | Standalone (no FK) |

### Security Features
- Bcrypt password hashing for all user types
- Prepared statements (PDO) preventing SQL injection
- htmlspecialchars with ENT_QUOTES preventing XSS attacks
- Session regeneration (session_regenerate_id) preventing session fixation
- Input validation on all form submissions
- Separate admin table for security isolation
- Secure password reset with random tokens and 1-hour expiry

### Accessibility Features
- ARIA labels on key sections (stats strip, search form, navigation)
- Skip-to-content link for keyboard navigation
- Proper alt text on all images
- lang="en" on HTML tag
- Semantic HTML5 elements (main, nav, article, aside)
- Fully responsive design for desktop, tablet, and mobile

### Logging
All user actions are logged to `coursehub/logs/app.log` using Monolog:
- Login/logout events (students, staff, admins)
- Failed login attempts (security monitoring)
- Programme/module/staff CRUD operations
- Interest registrations and withdrawals
- Profile updates and password changes
- Account deletions

### Project Structure
```
coursehub/
├── public/
│   └── index.php                    — Entry point
├── app/
│   ├── bootstrap.php                — Logger + database setup
│   ├── controllers/
│   │   ├── ProgrammeController.php  — Programme browsing and interest
│   │   ├── ModuleController.php     — Module listing and detail
│   │   ├── StaffController.php      — Staff directory and portal
│   │   ├── StudentAuthController.php — Student auth and account
│   │   └── AdminController.php      — Admin CRUD dashboard
│   ├── model/
│   │   ├── ProgrammeModule.php      — Programme queries
│   │   ├── ModuleModule.php         — Module queries
│   │   ├── StaffModule.php          — Staff queries
│   │   ├── StudentModel.php         — Student queries
│   │   ├── InterestModel.php        — Interest queries
│   │   └── AdminModel.php           — Admin auth
│   ├── views/
│   │   ├── Layout.php               — Shared header/footer/nav
│   │   ├── HomeView.php             — Homepage
│   │   ├── ProgrammeView.php        — Programme pages
│   │   ├── ModuleView.php           — Module pages
│   │   ├── StaffView.php            — Staff pages and portal
│   │   ├── StudentAuthView.php      — Auth and account pages
│   │   └── AdminView.php            — Admin panel pages
│   └── routes/
│       └── web.php                  — All route definitions
├── database/
│   ├── schema.sql                   — Full schema with seed data
│   └── coursehub.sqlite             — SQLite database
├── logs/
│   └── app.log                      — Application log
└── vendor/                          — Composer dependencies
```

---

## Group Contribution

| Member | Role | Responsibility |
|--------|------|---------------|
| Member A (Israat) | Frontend and Views | All view files, HTML/CSS, accessibility, SEO, performance, responsive design |
| Member B | Models and Database | Database schema, all model files, bootstrap, data access queries, input validation |
| Member C | Controllers and Routes | All controllers, routes, logging (54 log statements), session security, authentication |

---

## GitHub Repository

https://github.com/Niels-Brock-Copenhegan-Business-College/web-project-ctec-3705-group-2
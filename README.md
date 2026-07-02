# 🚨 Emergency Incident Report System

> A web-based emergency management platform where citizens can report incidents, agencies respond and update statuses, and admins oversee the entire operation — built with PHP and MySQL.

---

## 📌 Overview

This system was built to streamline emergency reporting and response coordination. Instead of calling a hotline and waiting, citizens can submit a report with location, photos, and details directly through the web app. The report is instantly visible to the relevant agency, who can update the status in real time. An admin oversees all reports, agencies, and users from a central dashboard.

The project demonstrates multi-role authentication, relational database design, file uploads, geolocation integration, and full CRUD operations across three separate portals.

---

## ⚙️ How It Works

**For Citizens (Users Portal)**
1. Register and log in to the user portal
2. Submit an emergency report with category, location (via map), description, and photo
3. Track the status of submitted reports in real time

**For Agencies (Agency Portal)**
1. Log in to the agency portal
2. View incoming emergency reports assigned to their jurisdiction
3. Update report status (e.g. Responding, Resolved)

**For Administrators (Admin Portal)**
1. Log in to the admin dashboard
2. Manage all users, agencies, emergency categories, and report types
3. View all reports across all agencies with full details
4. Add or remove agency accounts

---

## 🏗️ System Architecture

```
emergency/
├── homepage/           # Public landing page (HTML/CSS/JS)
├── portal/
│   ├── admin/          # Admin dashboard — manage everything
│   ├── agency/         # Agency portal — respond to reports
│   └── users/          # Citizen portal — submit and track reports
├── uploads/            # User-uploaded photos and videos
└── connect.php         # Root database connection
```

Each portal has its own:
- Login / authentication system
- Session management
- Includes folder (connect, head, navigation, sidebar)

---

## 🛠️ Tools & Technologies

| Category       | Tool / Language              |
|----------------|------------------------------|
| Backend        | PHP 8.2                      |
| Database       | MySQL (MariaDB)              |
| Frontend       | Bootstrap 4, jQuery          |
| ORM            | Idiorm (lightweight PHP ORM) |
| Maps           | Geolocation API (browser)    |
| File uploads   | PHP native file handling     |
| Deployment     | Railway (PHP + MySQL)        |

---

## 👥 User Roles

| Role    | Access                                                         |
|---------|----------------------------------------------------------------|
| Admin   | Full system access — users, agencies, reports, categories      |
| Agency  | View and respond to reports assigned to their agency           |
| User    | Submit emergency reports, track status, manage own profile     |

---

## 🚀 Getting Started (Local)

### Prerequisites
- XAMPP / WAMP (PHP 8.x + MySQL)
- A browser

### Setup

```bash
# 1. Clone the repository
git clone https://github.com/your-username/emergency-incident-report.git

# 2. Copy the emergency/ folder into your XAMPP htdocs directory
# e.g. C:/xampp/htdocs/emergency

# 3. Import the database
# Open phpMyAdmin → create database 'db_ems' → import database/db_ems.sql

# 4. Start Apache and MySQL in XAMPP

# 5. Visit in browser
http://localhost/emergency
```

### Default Login Credentials (demo only)

| Portal | URL | Username | Password |
|--------|-----|----------|----------|
| Admin | `/portal/admin/sign-in.php` | `admin` | `admin` |
| Agency | `/portal/agency/sign-in.php` | `123` | `123` |
| User | `/portal/users/sign-in.php` | Register a new account | — |

> ⚠️ These are demo credentials for local testing only. Change them before any real deployment.

---

## 🌐 Deployment (Railway)

See [DEPLOY.md](DEPLOY.md) for the full step-by-step Railway deployment guide.

**Environment variables required:**

```env
DB_HOST=your_railway_mysql_host
DB_USER=your_railway_mysql_user
DB_PASS=your_railway_mysql_password
DB_NAME=db_ems
```

---

## 🔒 Security Notes

The following security improvements were applied to this project before deployment:

- ✅ SQL injection prevention — login queries use prepared statements (`mysqli_prepare`)
- ✅ File upload validation — only `.jpg`, `.jpeg`, `.png`, `.gif` extensions accepted
- ✅ Database credentials moved to environment variables via `getenv()`
- ✅ Deprecated `mysql_connect()` replaced with `mysqli_connect()`
- ✅ Session regeneration on login (`session_regenerate_id()`)

---

## 🔮 Future Improvements

These improvements are planned for a future version:

- [ ] **Password hashing** — store passwords using `password_hash()` / `password_verify()` instead of plain text
- [ ] **Persistent file storage** — integrate Cloudinary or AWS S3 so uploaded photos survive server redeployments
- [ ] **Standardise DB connections** — unify all database access to PDO throughout (currently mixes PDO, mysqli, and Idiorm)
- [ ] **Real-time notifications** — use WebSockets or polling to notify agencies of new reports instantly
- [ ] **Email alerts** — send confirmation email to citizen when report status changes
- [ ] **Mobile responsive portals** — admin/agency/user dashboards currently optimised for desktop
- [ ] **Rate limiting** — prevent spam submissions on the emergency report form
- [ ] **Role-based access control (RBAC)** — formalise permissions system rather than per-page session checks

---

## 📸 Screenshots

> Add screenshots here once deployed. Suggested shots:
> - Public homepage
> - User report submission form
> - Admin dashboard with report list
> - Agency portal status update view

---

## 👤 Author

**Allen Pascual**
· [GitHub](https://github.com/lBurstLimitl)

---

*Built as a capstone-style project demonstrating multi-role web application development with PHP and MySQL.*

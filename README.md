# NexusAuth — PHP & MySQL Auth System

A dynamic, database-driven registration & login system built with PHP 8 and MySQL.

---

## 📁 Files

| File | Purpose |
|------|---------|
| `config.php` | DB connection + schema bootstrap |
| `layout.php` | Shared CSS + HTML helpers |
| `index.php` | Entry point (redirects) |
| `register.php` | Registration form + validation |
| `login.php` | Login form + session start |
| `dashboard.php` | Protected user dashboard |
| `logout.php` | Session destruction + redirect |

---

## ⚙️ Setup

### 1. Requirements
- PHP 8.0+
- MySQL 5.7+ / MariaDB 10.3+
- Apache/Nginx with a local server (XAMPP, Laragon, MAMP, etc.)

### 2. Configure the database
Edit the top of **`config.php`**:
```php
define('DB_USER', 'root');   // your MySQL username
define('DB_PASS', '');       // your MySQL password
```
The database (`auth_system`) and the `users` table are created **automatically** on first run.

### 3. Deploy
Copy the entire folder into your web server's document root:
- XAMPP → `htdocs/nexusauth/`
- Laragon → `www/nexusauth/`

### 4. Open in browser
```
http://localhost/nexusauth/
```

---

## ✅ Features

- **Registration** with server-side + live client-side validation
  - Username: 3–50 chars, alphanumeric + underscore, unique
  - Email: format check + unique
  - Password: 8+ chars, must contain uppercase + digit, bcrypt-hashed
  - Confirm password match
- **Login** by username **or** email
- **Session management** with `session_regenerate_id()` on login
- **Dashboard** shows live DB data & session info
- **Logout** button fully destroys the session & cookie
- Error messages stop execution and surface the DB error string

---

## 🔒 Security Notes

- Passwords stored as **bcrypt** hashes (`PASSWORD_BCRYPT`)
- All user input passed through **prepared statements** (no SQL injection)
- Output always escaped with `htmlspecialchars()`
- Session ID regenerated on login to prevent session-fixation attacks
- Session cookie deleted on logout

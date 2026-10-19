# Lost and Found System (PHP + MySQL)

A simple XAMPP-ready web application with account registration/login, lost/found reports, search/filtering, optional item photos, claim submission, user report management, and an administrator dashboard.

## Requirements
- Windows with XAMPP (Apache, PHP, MySQL/MariaDB)
- A modern browser

## Installation in XAMPP
1. Extract the project folder into `C:\xampp\htdocs\lost_found_php` (the folder must contain `index.php`, `config.php`, and `database.sql`).
2. Open XAMPP Control Panel and start **Apache** and **MySQL**.
3. Open `http://localhost/phpmyadmin` in your browser.
4. Select **Import**, choose this project's `database.sql`, and click **Import/Go**. The SQL creates the `lost_and_found` database and its tables.
5. Open `config.php`. The default XAMPP settings are host `127.0.0.1`, database `lost_and_found`, user `root`, and blank password. Change these only if your MySQL setup differs.
6. Make sure the `uploads` folder exists and is writable. It is included in this project.
7. Visit `http://localhost/lost_found_php/`.
8. Create an account, log in, and post a test lost/found report.

## Make an administrator account
1. Register an account through the website first.
2. Open phpMyAdmin, choose the `lost_and_found` database, and open the SQL tab.
3. Run this query, replacing `your_username` with the account's exact username:

```sql
UPDATE users SET role = 'admin' WHERE username = 'your_username';
```

4. Log out and log back in. The Admin link should now appear.

## Features
- Passwords stored with PHP `password_hash()`; login uses `password_verify()`.
- PDO prepared statements for database operations.
- Search by item title, location, or description; filter by type/category.
- Optional JPG/PNG/WEBP image upload (maximum 3 MB).
- Users can submit claims and close their own active reports.
- Admin can approve/reject claims and update report status.

## Troubleshooting
- **Database connection failed:** Start MySQL in XAMPP, import `database.sql`, and check credentials in `config.php`.
- **404 Not Found:** Check the folder path is exactly `C:\xampp\htdocs\lost_found_php` and use `http://localhost/lost_found_php/`.
- **Photo upload not working:** Ensure `uploads` exists and PHP upload limits allow at least 3 MB.
- **Blank page/PHP error:** Check Apache's PHP error log in XAMPP.

## Notes
This is a student project starter, not a production deployment. Before public hosting, add CSRF protection, stricter moderation/privacy controls, rate limiting, and secure HTTPS configuration. Contact information entered on a report is visible to visitors, so users should only share details they are comfortable publishing.

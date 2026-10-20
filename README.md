# Aviation Safety Management System (ASMS)

ASMS is a PHP web application for managing aviation safety operations, including aircraft, incidents, hazards, risks, maintenance, alerts, compliance, and reports.

## Requirements

- PHP 8.0 or newer with the `PDO` and `pdo_mysql` extensions enabled
- MySQL 8.0 or newer
- Apache with `mod_rewrite` enabled and `.htaccess` overrides allowed
- Composer is optional for running the core application
- A browser with an internet connection for the externally hosted UI libraries (Bootstrap, charts, maps, and related assets)

The application uses PHP sessions and needs permission to store session files through PHP's configured session handler.

## Install locally with XAMPP

1. Install and start Apache and MySQL from XAMPP.
2. Copy this project directory into XAMPP's `htdocs` directory, keeping its name as `asms`. For example: `C:\xampp\htdocs\asms`.
3. Create the database by importing the SQL files in order:
   - Import `database/asms_schema.sql` first. It creates the `asms_db` database and its tables.
   - Import `database/asms_seed.sql` second. It adds sample users and example records.

   You can import these files with phpMyAdmin or from a terminal opened in the project directory:

   ```sh
   mysql -u root -p < database/asms_schema.sql
   mysql -u root -p < database/asms_seed.sql
   ```

   If your local MySQL root account has no password, remove `-p`.
4. Configure the database connection in `config/database.php`. The defaults are `127.0.0.1`, database `asms_db`, user `root`, and an empty password; these defaults are intended for a local XAMPP setup.
5. Open [http://localhost/asms](http://localhost/asms). The app redirects unauthenticated visitors to the login page.

## Hosting on another server

1. Provision Apache, PHP 8.0+, MySQL 8.0+, and the PHP `pdo_mysql` extension on the server. Enable Apache `mod_rewrite` and permit `.htaccess` overrides for the application directory.
2. Deploy the project as a directory named `asms` beneath the web document root (for example, `/var/www/html/asms`) or configure the virtual host's document root to point at the project directory.
3. Create a dedicated MySQL database and user for ASMS. Import `database/asms_schema.sql` and then `database/asms_seed.sql` using phpMyAdmin or the MySQL command-line client.
4. Update the host, database name, username, and password in `config/database.php` to match that database. Do not use the local XAMPP `root`/empty-password defaults on a hosted server.
5. Set `BASE_URL` in `config/config.php` to the URL path where the app is served:
   - Use `'/asms'` when it is served at `https://example.com/asms`.
   - Use `''` when the virtual host serves it at the domain root.
6. Ensure Apache applies the project's `.htaccess` rewrite rules. Its current `RewriteBase` is `/asms/`; if you change the URL path, update that value to match (use `/` for a root deployment).
7. Visit the deployed URL over HTTPS and sign in.

Keep the application URL path, `BASE_URL`, and Apache `RewriteBase` consistent. If your host does not allow `.htaccess`, configure equivalent rewrite rules in the virtual host.

## Sign in and start using ASMS

The seed file creates sample accounts for these roles: Administrator, Safety Officer, Maintenance Engineer, Auditor, and Pilot. It labels the initial password as `password123`; the administrator account is `admin@asms.aero`.

The seed data is demonstration data, not production credentials. Remove or replace the sample accounts and records before making the site available to real users. If the documented sample password does not work, set a new password hash for the account using PHP's `password_hash()` before signing in.

After signing in, use the navigation to manage aircraft, incidents, hazards, risks, maintenance, alerts, compliance, users, and reports. Report downloads fall back to CSV when the optional export libraries are unavailable. Although `composer.json` lists PDF and spreadsheet libraries, the application currently does not load Composer's autoloader, so running `composer install` alone does not enable those export formats.

## Before exposing a server publicly

- Replace sample users, passwords, and data; use unique, strong credentials.
- Use HTTPS and a dedicated database user with only the permissions ASMS needs.
- Configure the web server to prevent direct downloads of configuration files, SQL dumps, and other internal project files. The included `.htaccess` provides URL rewriting but is not a complete production access-control policy.
- Back up the database regularly and protect those backups.
- The UI loads several libraries from public CDNs, so allow outbound browser access to those hosts or arrange an approved local hosting alternative.

## Troubleshooting

- **Database connection error:** Confirm MySQL is running, the `asms_db` database exists, and `config/database.php` has the correct connection values.
- **404s or broken navigation:** Check that `mod_rewrite` and `.htaccess` overrides are enabled, and that `BASE_URL` and `RewriteBase` match the deployed path.
- **Blank or PHP error page:** Check the Apache/PHP error log and confirm PHP 8+ and `pdo_mysql` are enabled.
- **Exports download as CSV:** This is the current fallback. The application does not load Composer's autoloader, so installing the listed Composer packages alone will not enable PDF or spreadsheet exports.

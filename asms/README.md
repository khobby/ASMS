# Aviation Safety Management System (ASMS)

Deploy under XAMPP htdocs, e.g. C:/xampp/htdocs/asms

Requirements:
- PHP 8+, MySQL 8, Apache (XAMPP)
- Optional: Composer to install TCPDF and PhpSpreadsheet

Quick setup:
1. Import `database/asms_schema.sql` into MySQL and then `database/asms_seed.sql`.
2. Place this folder in your Apache `htdocs` as `asms`.
3. Run `composer install` to install optional packages.
4. Visit http://localhost/asms

Default sample users in seed: admin@asms.aero (password: password123)

# VPN Store

A PHP/MySQL storefront prototype for VPN packages.

## Requirements
- PHP 8.1+ with mysqli and mbstring enabled
- MySQL 8+ or a compatible MariaDB release
- Apache/Nginx configured to serve PHP

## Local setup (XAMPP)
1. Copy/clone this repository into `C:\\xampp\\htdocs\\Vpn_Store`.
2. Start Apache and MySQL.
3. Create a database named `shop_db` in phpMyAdmin and import [shop_db (4).sql](./shop_db%20(4).sql).
4. For local development, the app defaults to `127.0.0.1`, database `shop_db`, user `root`, and an empty password. **Do not use these defaults on a public server.**
5. Open `http://localhost/Vpn_Store/login.php` or `register.php`.

## Environment configuration
Set these environment variables in the web server for production:
- `SHOP_DB_HOST`
- `SHOP_DB_NAME`
- `SHOP_DB_USER`
- `SHOP_DB_PASSWORD`
- `CONTACT_TO` (real mailbox receiving contact requests)
- `CONTACT_FROM` (verified sender address accepted by the mail server)

The app never takes prices from the browser. Checkout expects `$_SESSION['cart']` to be an associative array of product IDs to quantities, for example `[12 => 2]`. Cart buttons in the current storefront must populate this session value before checkout can place an order.

## Important production checklist
- Configure a dedicated least-privilege MySQL account; never expose database errors to visitors.
- Migrate `billing_details`, `orders`, and `order_items` to InnoDB before relying on transactional order creation. See [database hardening migration](./database/hardening-migration.sql).
- Configure and test SMTP in PHPMailer; the contact handler intentionally refuses to send until valid sender and recipient addresses are configured.
- Integrate a real payment provider before advertising that payments are accepted. Checkout currently records an unpaid order only.
- Add CSRF tokens, login throttling, password reset, HTTPS, and authorization checks to any future account/admin routes.
- Import the database SQL before using the app; do not commit real credentials or customer data.

## Current limitations
This is a portfolio/demo project, not a production-ready VPN provisioning or payment platform. No live VPN subscription provisioning or payment gateway is configured.

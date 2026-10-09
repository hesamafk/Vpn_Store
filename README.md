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
5. Open `http://localhost/Vpn_Store/catalog.php` to browse database products. Register at `register.php` and sign in at `login.php` if needed.
6. **Test mode is on by default.** Checkout displays a test-mode notice and refuses to create orders. Keep it enabled until real VPN plans, prices, and fulfillment are defined. Do not disable it on a public server.

## Environment configuration
Set these environment variables in the web server for production:
- `SHOP_DB_HOST`
- `SHOP_DB_NAME`
- `SHOP_DB_USER`
- `SHOP_DB_PASSWORD`
- `CONTACT_TO` (real mailbox receiving contact requests)
- `CONTACT_FROM` (verified sender address accepted by the mail server)

`SHOP_TEST_MODE` defaults to `1` (safe test mode). Only set `SHOP_TEST_MODE=0` in a controlled local test environment if you intentionally need to exercise unpaid-order recording. There is no payment gateway, and disabling this flag does not make the store ready to sell.

The supported catalog flow is `catalog.php` → `cart.php` → `checkout.php`. The cart stores only product IDs and quantities in the session; product names and prices are read from MySQL on the server. The checkout recalculates the order and records it as unpaid. **The committed SQL dump currently contains no rows in `products`, so the catalog is expected to be empty after a fresh import.** Add your real VPN plan names, duration/data limits, prices, and delivery terms before treating it as a usable store; do not publish invented demo prices. The legacy `shop.php` theme page is separate from this new database-backed catalog; do not assume its old theme controls are connected to checkout.

## Important production checklist
- Configure a dedicated least-privilege MySQL account; never expose database errors to visitors.
- Migrate `billing_details`, `orders`, and `order_items` to InnoDB before relying on transactional order creation. See [database hardening migration](./database/hardening-migration.sql).
- Configure and test SMTP in PHPMailer; the contact handler intentionally refuses to send until valid sender and recipient addresses are configured.
- Integrate a real payment provider before advertising that payments are accepted. Checkout currently records an unpaid order only.
- CSRF tokens are used by the login, registration, cart, and checkout forms. Still add login throttling, password reset, HTTPS, and authorization checks before a public launch.
- Passwords created through the updated registration form are hashed. Existing accounts created with plaintext passwords may need a safe password-reset/re-registration process; do not re-enable plaintext password comparisons.
- Import the database SQL before using the app; do not commit real credentials or customer data.

## Current limitations
This is a portfolio/demo project, not a production-ready VPN provisioning or payment platform. No live VPN subscription provisioning or payment gateway is configured.

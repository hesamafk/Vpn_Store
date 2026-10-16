# PHP Store — Local Commerce Project

A Persian PHP/MySQL storefront with a database-backed catalogue, registration, login, session cart and transactional order capture. Checkout records unpaid orders; no payment gateway is included.

## Local setup

Use PHP 8.2+ with `mysqli` and `mbstring`, plus MySQL 8 (or a compatible MariaDB installation). XAMPP can provide the local server. Copy this repository into `htdocs` and create a local `shop_db` database.

Import the SQL in this order into your local development database:

1. `shop_db (4).sql` — supplied schema and sample data
2. `database/hardening-migration.sql` — enables transactions for order tables
3. `database/billing-link-migration.sql` — enables product locking and links an order to its billing record; run once

Back up any existing database before applying migrations. Configure `SHOP_DB_HOST`, `SHOP_DB_NAME`, `SHOP_DB_USER` and `SHOP_DB_PASSWORD` as server environment variables; `.env.example` is documentation, not an automatically loaded file. Local defaults are `127.0.0.1`, `shop_db`, `root`, and an empty password.

Open `catalog.php` through Apache, or from the repository run `php -S 127.0.0.1:8000` and visit http://127.0.0.1:8000. `index.php`, `shop.php` and the legacy `indexh.html` URL route to the catalogue.

## Source layout

- `config.php` — database connection, session setup, HTML escaping and CSRF helpers
- `catalog.php`, `cart.php`, `checkout.php` — browsing and order flow
- `login.php`, `register.php` — account forms
- `sendmail.php` — optional contact handler using PHP's configured mail transport
- `database/` — incremental database migrations
- `store.css` — shared layout defaults and focus styles
- `.github/workflows/` — PHP lint and MySQL integration checks

## Order and email behavior

Order submission is disabled by default. For a local order-recording test, set `SHOP_TEST_MODE=0`. The server recalculates and locks catalogue prices inside the order transaction, links billing details, and redirects after success. Orders remain unpaid; there is no automatic provisioning or payment processing.

For contact email, configure `CONTACT_TO`, `CONTACT_FROM` and the server's PHP mail/SMTP transport. An unconfigured or rejected delivery returns an explicit error. No missing PHPMailer directory is required.

## Validation

Run `python scripts/check_project.py` with Python 3 and Node.js for bundled asset/JavaScript checks; run `php -l` on the PHP files with your runtime. The integration workflow imports the supplied SQL, applies both migrations, checks prepared queries and transaction rollback.

See [validation results](docs/VALIDATION.md). A PHP AST parse is not a substitute for PHP/MySQL runtime verification. This remains a local learning project; production payment, account recovery, abuse controls and deployment operations are outside its current scope.

## Source history

The original SQL and earlier source remain in Git history. The missing legacy template assets were replaced by the maintained local catalogue flow. Existing notices are preserved; this pass adds no license grant.

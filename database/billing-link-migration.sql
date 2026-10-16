-- Run once after importing the original dump and hardening-migration.sql.
-- If upgrading an existing database, back it up first.
ALTER TABLE products ENGINE=InnoDB;
ALTER TABLE orders ADD COLUMN billing_details_id INT NULL AFTER user_id;
ALTER TABLE orders ADD INDEX idx_orders_billing (billing_details_id);
ALTER TABLE orders ADD CONSTRAINT fk_orders_billing FOREIGN KEY (billing_details_id) REFERENCES billing_details(id);

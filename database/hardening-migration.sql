-- Run only after backing up the database.
-- MyISAM does not support transactions; convert order-related tables before relying on checkout rollback.
ALTER TABLE billing_details ENGINE=InnoDB;
ALTER TABLE orders ENGINE=InnoDB;
ALTER TABLE order_items ENGINE=InnoDB;

-- Optional uniqueness hardening. Run only after resolving any existing duplicate values.
-- ALTER TABLE login ADD UNIQUE KEY uq_login_username (username);
-- ALTER TABLE login ADD UNIQUE KEY uq_login_email (email);

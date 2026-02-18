-- Migration: Add parent_id to categories for sub-category support
ALTER TABLE categories ADD COLUMN parent_id INT DEFAULT NULL AFTER name;
ALTER TABLE categories ADD FOREIGN KEY (parent_id) REFERENCES categories(id) ON DELETE CASCADE;

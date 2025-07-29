-- Add content column to blogs table
ALTER TABLE `blogs` ADD COLUMN `content` LONGTEXT NULL AFTER `description`;

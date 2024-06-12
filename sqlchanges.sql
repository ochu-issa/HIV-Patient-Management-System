--user
ALTER TABLE `users` ADD `username` VARCHAR(20) NULL AFTER `role_id`;
ALTER TABLE `users` ADD UNIQUE(`username`);
ALTER TABLE `users` CHANGE `role_id` `role_id` BIGINT(20) UNSIGNED NULL;
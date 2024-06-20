--user
ALTER TABLE `users` ADD `username` VARCHAR(20) NULL AFTER `role_id`;
ALTER TABLE `users` ADD UNIQUE(`username`);
ALTER TABLE `users` CHANGE `role_id` `role_id` BIGINT(20) UNSIGNED NULL;

-- 12/06/2024
ALTER TABLE `pattients` ADD `dob` DATE NULL AFTER `gender`;
ALTER TABLE `pattients` ADD `age` INT(20) NULL AFTER `dob`;
ALTER TABLE `pattients` DROP `age`;


CREATE TABLE `patient_detail_items` (`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT , `patient_detail_id` BIGINT UNSIGNED NOT NULL , `cd4_count` INT(200) NOT NULL , `viral_load` INT(200) NOT NULL , `allergies` VARCHAR(255) NOT NULL , `blood_presssure` INT(200) NOT NULL , `medication_adherence` INT(200) NOT NULL DEFAULT '1' , `diagnosis_date` DATE NOT NULL , `weight` DECIMAL NOT NULL , `art_regimen` VARCHAR(255) NOT NULL , `next_appointment_date` DATE NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `patient_detail_items` ADD FOREIGN KEY (`patient_detail_id`) REFERENCES `patient_details`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `patient_detail_items` CHANGE `diagnosis_date` `diagnosis_date` DATETIME NOT NULL;
ALTER TABLE `patient_detail_items` ADD `appointment_by` BIGINT UNSIGNED NULL AFTER `next_appointment_date`;
ALTER TABLE `patient_detail_items` CHANGE `next_appointment_date` `next_appointment_date` DATE NULL;
ALTER TABLE `patient_detail_items` ADD `status` INT(200) NOT NULL AFTER `appointment_by`;
ALTER TABLE `patient_detail_items` CHANGE `blood_presssure` `blood_pressure` INT(200) NOT NULL;
ALTER TABLE `patient_detail_items` CHANGE `diagnosis_date` `diagnosis_date` TIMESTAMP NOT NULL;

-- /16-06-2024
ALTER TABLE `patient_detail_items` CHANGE `patient_detail_id` `patient_details_id` BIGINT(20) UNSIGNED NOT NULL;

-- 17-06-2024
CREATE TABLE `patient_sessions` (`id` BIGINT NOT NULL AUTO_INCREMENT , `patient_id` BIGINT UNSIGNED NOT NULL , `patient_otp_id` BIGINT UNSIGNED NULL , `created_by` BIGINT UNSIGNED NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `patient_sessions` ADD FOREIGN KEY (`created_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE; ALTER TABLE `patient_sessions` ADD FOREIGN KEY (`patient_id`) REFERENCES `pattients`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `patient_sessions` ADD `branch_id` BIGINT UNSIGNED NOT NULL AFTER `patient_id`;
ALTER TABLE `patient_sessions` ADD `is_active` BIGINT UNSIGNED NOT NULL AFTER `created_by`;
ALTER TABLE `patient_sessions` ADD FOREIGN KEY (`branch_id`) REFERENCES `branches`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `patient_details` CHANGE `patient_id` `patient_id` BIGINT UNSIGNED NOT NULL;
ALTER TABLE `patient_details` CHANGE `branch_id` `branch_id` BIGINT UNSIGNED NOT NULL;
ALTER TABLE `patient_details` CHANGE `doctor_id` `doctor_id` BIGINT UNSIGNED NOT NULL;

ALTER TABLE `patient_details` ADD FOREIGN KEY (`branch_id`) REFERENCES `branches`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE; ALTER TABLE `patient_details` ADD FOREIGN KEY (`doctor_id`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE; ALTER TABLE `patient_details` ADD FOREIGN KEY (`patient_id`) REFERENCES `pattients`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `patient_details` ADD `patient_session_id` BIGINT UNSIGNED NULL AFTER `id`;
ALTER TABLE `patient_sessions` CHANGE `id` `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `patient_details` ADD FOREIGN KEY (`patient_session_id`) REFERENCES `patient_sessions`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `patient_sessions` ADD `updated_by` BIGINT UNSIGNED NULL AFTER `created_by`;
ALTER TABLE `patient_sessions` ADD FOREIGN KEY (`updated_by`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--user
ALTER TABLE `users` ADD `username` VARCHAR(20) NULL AFTER `role_id`;
ALTER TABLE `users` ADD UNIQUE(`username`);
ALTER TABLE `users` CHANGE `role_id` `role_id` BIGINT(20) UNSIGNED NULL;

-- 12/06/2024
ALTER TABLE `pattients` ADD `dob` DATE NULL AFTER `gender`;
ALTER TABLE `pattients` ADD `age` INT(20) NULL AFTER `dob`;
ALTER TABLE `pattients` DROP `age`;


CREATE TABLE `hiv_patient`.`patient_detail_items` (`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT , `patient_detail_id` BIGINT UNSIGNED NOT NULL , `cd4_count` INT(200) NOT NULL , `viral_load` INT(200) NOT NULL , `allergies` VARCHAR(255) NOT NULL , `blood_presssure` INT(200) NOT NULL , `medication_adherence` INT(200) NOT NULL DEFAULT '1' , `diagnosis_date` DATE NOT NULL , `weight` DECIMAL NOT NULL , `art_regimen` VARCHAR(255) NOT NULL , `next_appointment_date` DATE NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
ALTER TABLE `patient_detail_items` ADD FOREIGN KEY (`patient_detail_id`) REFERENCES `patient_details`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `patient_detail_items` CHANGE `diagnosis_date` `diagnosis_date` DATETIME NOT NULL;
ALTER TABLE `patient_detail_items` ADD `appointment_by` BIGINT UNSIGNED NULL AFTER `next_appointment_date`;
ALTER TABLE `patient_detail_items` CHANGE `next_appointment_date` `next_appointment_date` DATE NULL;
ALTER TABLE `patient_detail_items` ADD `status` INT(200) NOT NULL AFTER `appointment_by`;
ALTER TABLE `patient_detail_items` CHANGE `blood_presssure` `blood_pressure` INT(200) NOT NULL;
ALTER TABLE `patient_detail_items` CHANGE `diagnosis_date` `diagnosis_date` TIMESTAMP NOT NULL;

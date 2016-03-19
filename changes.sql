ALTER TABLE `project_phase` ADD `project_status_id` INT NOT NULL , ADD `project_id` INT NOT NULL ; 

ALTER TABLE `project_phase` ADD FOREIGN KEY (`project_status_id`) REFERENCES `wathiq`.`project_status`(`id`) ON DELETE CASCADE ON UPDATE CASCADE; ALTER TABLE `project_phase` ADD FOREIGN KEY (`project_id`) REFERENCES `wathiq`.`project`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `project` ADD `file` VARCHAR(255) NOT NULL ;

// 12/12/2015

ALTER TABLE `project_phase` ADD `project_phase_id` INT NOT NULL ;
ALTER TABLE `project_phase` CHANGE `project_phase_id` `project_phase_id` INT(11) NULL DEFAULT '0';
ALTER TABLE `project_phase` CHANGE `project_phase_id` `project_phase_id` INT(11) NULL DEFAULT NULL;
ALTER TABLE `project_phase` ADD FOREIGN KEY (`project_phase_id`) REFERENCES `wathiq`.`project_phase`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `project_subphase_deliverable` DROP FOREIGN KEY `fk_project_subphase_delivery_project_subphase1`; ALTER TABLE `project_subphase_deliverable` ADD CONSTRAINT `fk_project_subphase_delivery_project_subphase1` FOREIGN KEY (`project_subphase_id`) REFERENCES `wathiq`.`project_phase`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE `project_subphase_deliverable` CHANGE `project_subphase_id` `project_phase_id` INT(11) NOT NULL;

DROP TABLE `attachment_subphase`, `project_subphase`;
ALTER TABLE `project_subphase_deliverable` CHANGE `project_phase_id` `project_phase_id` INT(11) NULL;
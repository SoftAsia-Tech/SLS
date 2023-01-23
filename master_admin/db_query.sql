-- Alter teacher table by adding 'teacher_id'
ALTER TABLE `sls_classes` ADD `teacher_id` INT NULL AFTER `school_id`;
-- Alter sls_students table by adding 'schoolID'
ALTER TABLE `sls_students` ADD `schoolID` INT NOT NULL AFTER `classID`;
-- sync did not work

ALTER TABLE `esrbija`.`administrators` 
CHANGE COLUMN `created_at` `created_at` DATETIME NULL DEFAULT NULL ;
ALTER TABLE `esrbija`.`administrators` 
CHANGE COLUMN `updated_at` `updated_at` DATETIME NULL DEFAULT NULL ;


ALTER TABLE `esrbija`.`anketes` 
CHANGE COLUMN `created_at` `created_at` DATETIME NULL DEFAULT NULL ;
ALTER TABLE `esrbija`.`anketes` 
CHANGE COLUMN `updated_at` `updated_at` DATETIME NULL DEFAULT NULL ;






ALTER TABLE `esrbija`.`kategorijes` 
CHANGE COLUMN `created_at` `created_at` DATETIME NULL DEFAULT NULL ;
ALTER TABLE `esrbija`.`kategorijes` 
CHANGE COLUMN `updated_at` `updated_at` DATETIME NULL DEFAULT NULL ;

ALTER TABLE `esrbija`.`mestos` 
CHANGE COLUMN `created_at` `created_at` DATETIME NULL DEFAULT NULL ;
ALTER TABLE `esrbija`.`mestos` 
CHANGE COLUMN `updated_at` `updated_at` DATETIME NULL DEFAULT NULL ;


ALTER TABLE `esrbija`.`moderators` 
CHANGE COLUMN `created_at` `created_at` DATETIME NULL DEFAULT NULL ;
ALTER TABLE `esrbija`.`moderators` 
CHANGE COLUMN `updated_at` `updated_at` DATETIME NULL DEFAULT NULL ;

ALTER TABLE `esrbija`.`neprivilegovan_korisniks` 
CHANGE COLUMN `created_at` `created_at` DATETIME NULL DEFAULT NULL ;
ALTER TABLE `esrbija`.`neprivilegovan_korisniks` 
CHANGE COLUMN `updated_at` `updated_at` DATETIME NULL DEFAULT NULL ;

ALTER TABLE `esrbija`.`obavestenjas` 
CHANGE COLUMN `created_at` `created_at` DATETIME NULL DEFAULT NULL ;
ALTER TABLE `esrbija`.`obavestenjas` 
CHANGE COLUMN `updated_at` `updated_at` DATETIME NULL DEFAULT NULL ;

ALTER TABLE `esrbija`.`password_resets` 
CHANGE COLUMN `created_at` `created_at` DATETIME NULL DEFAULT NULL ;

ALTER TABLE `esrbija`.`pitanjas` 
CHANGE COLUMN `created_at` `created_at` DATETIME NULL DEFAULT NULL ;
ALTER TABLE `esrbija`.`pitanjas` 
CHANGE COLUMN `updated_at` `updated_at` DATETIME NULL DEFAULT NULL ;
ALTER TABLE `esrbija`.`ponudjeni_odgovoris` 
CHANGE COLUMN `created_at` `created_at` DATETIME NULL DEFAULT NULL ;
ALTER TABLE `esrbija`.`ponudjeni_odgovoris` 
CHANGE COLUMN `updated_at` `updated_at` DATETIME NULL DEFAULT NULL ;















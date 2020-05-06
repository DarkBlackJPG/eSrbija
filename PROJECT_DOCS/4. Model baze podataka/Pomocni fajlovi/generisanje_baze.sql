-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema esrbija
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `esrbija` ;

-- -----------------------------------------------------
-- Schema esrbija
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `esrbija` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ;
USE `esrbija` ;

-- -----------------------------------------------------
-- Table `esrbija`.`korisniks`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `esrbija`.`korisniks` ;

CREATE TABLE IF NOT EXISTS `esrbija`.`korisniks` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(191) NOT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `verification_token` VARCHAR(191) NULL DEFAULT NULL,
  `password` VARCHAR(191) NOT NULL,
  `isAdmin` TINYINT(1) NOT NULL,
  `isMod` TINYINT(1) NOT NULL,
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `korisniks_email_unique` (`email` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `esrbija`.`administrators`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `esrbija`.`administrators` ;

CREATE TABLE IF NOT EXISTS `esrbija`.`administrators` (
  `id` BIGINT(20) UNSIGNED NOT NULL,
  `ime` VARCHAR(191) NOT NULL,
  `prezime` VARCHAR(191) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `administrators_id_foreign`
    FOREIGN KEY (`id`)
    REFERENCES `esrbija`.`korisniks` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `esrbija`.`anketes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `esrbija`.`anketes` ;

CREATE TABLE IF NOT EXISTS `esrbija`.`anketes` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(191) NOT NULL,
  `obrisanoFlag` TINYINT(1) NOT NULL,
  `isActive` TINYINT(1) NOT NULL,
  `nivoLokNac` INT(11) NOT NULL,
  `korisnik_id` BIGINT(20) UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `anketes_korisnik_id_foreign` (`korisnik_id` ASC) VISIBLE,
  CONSTRAINT `anketes_korisnik_id_foreign`
    FOREIGN KEY (`korisnik_id`)
    REFERENCES `esrbija`.`korisniks` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `esrbija`.`mestos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `esrbija`.`mestos` ;

CREATE TABLE IF NOT EXISTS `esrbija`.`mestos` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(191) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `esrbija`.`ankete_mestos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `esrbija`.`ankete_mestos` ;

CREATE TABLE IF NOT EXISTS `esrbija`.`ankete_mestos` (
  `ankete_id` BIGINT(20) UNSIGNED NOT NULL,
  `mesto_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`ankete_id`, `mesto_id`),
  UNIQUE INDEX `ankete_mestos_ankete_id_mesto_id_unique` (`ankete_id` ASC, `mesto_id` ASC) VISIBLE,
  INDEX `ankete_mestos_mesto_id_foreign` (`mesto_id` ASC) VISIBLE,
  CONSTRAINT `ankete_mestos_ankete_id_foreign`
    FOREIGN KEY (`ankete_id`)
    REFERENCES `esrbija`.`anketes` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `ankete_mestos_mesto_id_foreign`
    FOREIGN KEY (`mesto_id`)
    REFERENCES `esrbija`.`mestos` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `esrbija`.`kategorijes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `esrbija`.`kategorijes` ;

CREATE TABLE IF NOT EXISTS `esrbija`.`kategorijes` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(191) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `esrbija`.`obavestenjas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `esrbija`.`obavestenjas` ;

CREATE TABLE IF NOT EXISTS `esrbija`.`obavestenjas` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `naslov` VARCHAR(191) NOT NULL,
  `opis` TEXT NOT NULL,
  `link` VARCHAR(191) NOT NULL,
  `nivoLokNac` SMALLINT(6) NOT NULL,
  `korisnik_id` BIGINT(20) UNSIGNED NOT NULL,
  `obrisanoFlag` TINYINT(1) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `obavestenjas_korisnik_id_foreign` (`korisnik_id` ASC) VISIBLE,
  CONSTRAINT `obavestenjas_korisnik_id_foreign`
    FOREIGN KEY (`korisnik_id`)
    REFERENCES `esrbija`.`korisniks` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `esrbija`.`kategorije_obavestenja`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `esrbija`.`kategorije_obavestenja` ;

CREATE TABLE IF NOT EXISTS `esrbija`.`kategorije_obavestenja` (
  `obavestenja_id` BIGINT(20) UNSIGNED NOT NULL,
  `kategorije_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`obavestenja_id`, `kategorije_id`),
  UNIQUE INDEX `kategorije_obavestenja_obavestenja_id_kategorije_id_unique` (`obavestenja_id` ASC, `kategorije_id` ASC) VISIBLE,
  INDEX `kategorije_obavestenja_kategorije_id_foreign` (`kategorije_id` ASC) VISIBLE,
  CONSTRAINT `kategorije_obavestenja_kategorije_id_foreign`
    FOREIGN KEY (`kategorije_id`)
    REFERENCES `esrbija`.`kategorijes` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `kategorije_obavestenja_obavestenja_id_foreign`
    FOREIGN KEY (`obavestenja_id`)
    REFERENCES `esrbija`.`obavestenjas` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `esrbija`.`kategorije_ovlascenjas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `esrbija`.`kategorije_ovlascenjas` ;

CREATE TABLE IF NOT EXISTS `esrbija`.`kategorije_ovlascenjas` (
  `korisnik_id` BIGINT(20) UNSIGNED NOT NULL,
  `kategorije_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`korisnik_id`, `kategorije_id`),
  UNIQUE INDEX `kategorije_ovlascenjas_korisnik_id_kategorije_id_unique` (`korisnik_id` ASC, `kategorije_id` ASC) VISIBLE,
  INDEX `kategorije_ovlascenjas_kategorije_id_foreign` (`kategorije_id` ASC) VISIBLE,
  CONSTRAINT `kategorije_ovlascenjas_kategorije_id_foreign`
    FOREIGN KEY (`kategorije_id`)
    REFERENCES `esrbija`.`kategorijes` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `kategorije_ovlascenjas_korisnik_id_foreign`
    FOREIGN KEY (`korisnik_id`)
    REFERENCES `esrbija`.`korisniks` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `esrbija`.`kategorije_pretplates`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `esrbija`.`kategorije_pretplates` ;

CREATE TABLE IF NOT EXISTS `esrbija`.`kategorije_pretplates` (
  `korisnik_id` BIGINT(20) UNSIGNED NOT NULL,
  `kategorije_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`korisnik_id`, `kategorije_id`),
  UNIQUE INDEX `kategorije_pretplates_korisnik_id_kategorije_id_unique` (`korisnik_id` ASC, `kategorije_id` ASC) VISIBLE,
  INDEX `kategorije_pretplates_kategorije_id_foreign` (`kategorije_id` ASC) VISIBLE,
  CONSTRAINT `kategorije_pretplates_kategorije_id_foreign`
    FOREIGN KEY (`kategorije_id`)
    REFERENCES `esrbija`.`kategorijes` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `kategorije_pretplates_korisnik_id_foreign`
    FOREIGN KEY (`korisnik_id`)
    REFERENCES `esrbija`.`korisniks` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `esrbija`.`migrations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `esrbija`.`migrations` ;

CREATE TABLE IF NOT EXISTS `esrbija`.`migrations` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(191) NOT NULL,
  `batch` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `esrbija`.`moderators`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `esrbija`.`moderators` ;

CREATE TABLE IF NOT EXISTS `esrbija`.`moderators` (
  `id` BIGINT(20) UNSIGNED NOT NULL,
  `approved` TINYINT(1) NOT NULL DEFAULT '0',
  `naziv` VARCHAR(191) NOT NULL,
  `adresa` VARCHAR(191) NOT NULL,
  `adminNotified` TINYINT(1) NOT NULL DEFAULT '0',
  `pib` VARCHAR(9) NOT NULL,
  `maticniBroj` VARCHAR(8) NOT NULL,
  `opstinaPoslovanja_id` BIGINT(20) UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `moderators_naziv_unique` (`naziv` ASC) VISIBLE,
  UNIQUE INDEX `moderators_pib_unique` (`pib` ASC) VISIBLE,
  UNIQUE INDEX `moderators_maticnibroj_unique` (`maticniBroj` ASC) VISIBLE,
  INDEX `moderators_opstinaposlovanja_id_foreign` (`opstinaPoslovanja_id` ASC) VISIBLE,
  CONSTRAINT `moderators_id_foreign`
    FOREIGN KEY (`id`)
    REFERENCES `esrbija`.`korisniks` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `moderators_opstinaposlovanja_id_foreign`
    FOREIGN KEY (`opstinaPoslovanja_id`)
    REFERENCES `esrbija`.`mestos` (`id`)
    ON DELETE RESTRICT)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `esrbija`.`neprivilegovan_korisniks`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `esrbija`.`neprivilegovan_korisniks` ;

CREATE TABLE IF NOT EXISTS `esrbija`.`neprivilegovan_korisniks` (
  `id` BIGINT(20) UNSIGNED NOT NULL,
  `ime` VARCHAR(191) NOT NULL,
  `prezime` VARCHAR(191) NOT NULL,
  `datumRodjenja` DATE NOT NULL,
  `adresaPrebivalista` VARCHAR(191) NOT NULL,
  `jmbg` VARCHAR(13) NOT NULL,
  `pol` TINYINT(1) NOT NULL,
  `brojLicneKarte` VARCHAR(9) NOT NULL,
  `opstinaPrebivalista_id` BIGINT(20) UNSIGNED NOT NULL,
  `opstinaRodjenja_id` BIGINT(20) UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `neprivilegovan_korisniks_jmbg_unique` (`jmbg` ASC) VISIBLE,
  UNIQUE INDEX `neprivilegovan_korisniks_brojlicnekarte_unique` (`brojLicneKarte` ASC) VISIBLE,
  INDEX `neprivilegovan_korisniks_opstinaprebivalista_id_foreign` (`opstinaPrebivalista_id` ASC) VISIBLE,
  INDEX `neprivilegovan_korisniks_opstinarodjenja_id_foreign` (`opstinaRodjenja_id` ASC) VISIBLE,
  CONSTRAINT `neprivilegovan_korisniks_id_foreign`
    FOREIGN KEY (`id`)
    REFERENCES `esrbija`.`korisniks` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `neprivilegovan_korisniks_opstinaprebivalista_id_foreign`
    FOREIGN KEY (`opstinaPrebivalista_id`)
    REFERENCES `esrbija`.`mestos` (`id`)
    ON DELETE RESTRICT,
  CONSTRAINT `neprivilegovan_korisniks_opstinarodjenja_id_foreign`
    FOREIGN KEY (`opstinaRodjenja_id`)
    REFERENCES `esrbija`.`mestos` (`id`)
    ON DELETE RESTRICT)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `esrbija`.`pitanjas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `esrbija`.`pitanjas` ;

CREATE TABLE IF NOT EXISTS `esrbija`.`pitanjas` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tekst` TEXT NOT NULL,
  `ankete_id` BIGINT(20) UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `pitanjas_ankete_id_foreign` (`ankete_id` ASC) VISIBLE,
  CONSTRAINT `pitanjas_ankete_id_foreign`
    FOREIGN KEY (`ankete_id`)
    REFERENCES `esrbija`.`anketes` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `esrbija`.`ponudjeni_odgovoris`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `esrbija`.`ponudjeni_odgovoris` ;

CREATE TABLE IF NOT EXISTS `esrbija`.`ponudjeni_odgovoris` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tekst` VARCHAR(191) NOT NULL,
  `pitanja_id` BIGINT(20) UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `ponudjeni_odgovoris_pitanja_id_foreign` (`pitanja_id` ASC) VISIBLE,
  CONSTRAINT `ponudjeni_odgovoris_pitanja_id_foreign`
    FOREIGN KEY (`pitanja_id`)
    REFERENCES `esrbija`.`pitanjas` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `esrbija`.`odgovori_korisnik`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `esrbija`.`odgovori_korisnik` ;

CREATE TABLE IF NOT EXISTS `esrbija`.`odgovori_korisnik` (
  `korisnik_id` BIGINT(20) UNSIGNED NOT NULL,
  `ponudjeni_odgovori_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`korisnik_id`, `ponudjeni_odgovori_id`),
  UNIQUE INDEX `odgovori_korisnik_korisnik_id_ponudjeni_odgovori_id_unique` (`korisnik_id` ASC, `ponudjeni_odgovori_id` ASC) VISIBLE,
  INDEX `odgovori_korisnik_ponudjeni_odgovori_id_foreign` (`ponudjeni_odgovori_id` ASC) VISIBLE,
  CONSTRAINT `odgovori_korisnik_korisnik_id_foreign`
    FOREIGN KEY (`korisnik_id`)
    REFERENCES `esrbija`.`korisniks` (`id`)
    ON DELETE CASCADE,
  CONSTRAINT `odgovori_korisnik_ponudjeni_odgovori_id_foreign`
    FOREIGN KEY (`ponudjeni_odgovori_id`)
    REFERENCES `esrbija`.`ponudjeni_odgovoris` (`id`)
    ON DELETE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `esrbija`.`password_resets`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `esrbija`.`password_resets` ;

CREATE TABLE IF NOT EXISTS `esrbija`.`password_resets` (
  `email` VARCHAR(191) NOT NULL,
  `token` VARCHAR(191) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  INDEX `password_resets_email_index` (`email` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

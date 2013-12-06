<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131204153204 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("CREATE  TABLE IF NOT EXISTS `new-roofpilot`.`study_promo_code` (
                          `study_promo_code_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                          `study_id` INT(50) UNSIGNED NOT NULL ,
                          `study_promo_code_value` VARCHAR(45) NOT NULL ,
                          `study_promo_code_amount` INT(10) NOT NULL ,
                          PRIMARY KEY (`study_promo_code_id`),
                		  INDEX `fk_study_promo_code_study1_idx` (`study_id`) ,
                          CONSTRAINT `fk_study_promo_code_study1`
		                    FOREIGN KEY (`study_id`)
		                    REFERENCES `proofpilot`.`study` (`study_id`)
		                    ON DELETE NO ACTION
		                    ON UPDATE NO ACTION)
                        ENGINE = InnoDB");

    }

    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("DROP  TABLE IF EXISTS `new-proofpilot`.`study_promo_code`");

    }
}

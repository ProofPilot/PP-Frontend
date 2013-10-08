<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131007185050 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`participant` ADD COLUMN `level_id` INTEGER(10) UNSIGNED NOT NULL DEFAULT 1 AFTER `participant_state`,
                ADD CONSTRAINT `fk_participant_level` FOREIGN KEY (`level_id`) 
                REFERENCES `proofpilot`.`participant_level` (`participant_level_id`) 
                ON DELETE NO ACTION 
                ON UPDATE NO ACTION;");
        $this->addSql("UPDATE `proofpilot`.`participant` SET `level_id` = (SELECT `participant_level_id` FROM `proofpilot`.`participant_level` 
                WHERE `participant_level_name` = 'Lead') WHERE `participant_mobile_sms_code_confirmed`= false ");
        $this->addSql("UPDATE `proofpilot`.`participant` SET `level_id` = (SELECT `participant_level_id` FROM `proofpilot`.`participant_level`
                WHERE `participant_level_name` = 'Customer') WHERE `participant_mobile_sms_code_confirmed`= true ");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`participant` DROP FOREIGN KEY `fk_participant_level`;
                ALTER TABLE `proofpilot`.`participant` DROP COLUMN `level_id`
               , DROP INDEX `fk_participant_level`;");
    }
}

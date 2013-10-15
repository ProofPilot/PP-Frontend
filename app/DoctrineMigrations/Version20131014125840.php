<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131014125840 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`participant` ADD COLUMN `participant_interested` VARCHAR(128) NULL AFTER `participant_state`;
                       UPDATE `proofpilot`.`race` SET `race_name` =  'White and/or Eurpoean descent' WHERE `race_id` = 1;
                       UPDATE `proofpilot`.`race` SET `race_name` =  'African descent' WHERE `race_id` = 2;
                       UPDATE `proofpilot`.`race` SET `race_name` =  'Hispanic and/or Latino' WHERE `race_id` = 3;
                       UPDATE `proofpilot`.`race` SET `race_name` =  'South Asian' WHERE `race_id` = 4;
                       INSERT INTO `proofpilot`.`race` (`race_name`, `status_id`) VALUES ('East Asian', 1);
                       INSERT INTO `proofpilot`.`race` (`race_name`, `status_id`) VALUES ('Arab/Middle Eastern', 1);
                       INSERT INTO `proofpilot`.`race` (`race_name`, `status_id`) VALUES ('Native American or Aboriginal', 1);
                       INSERT INTO `proofpilot`.`race` (`race_name`, `status_id`) VALUES ('Other', 1);
                       INSERT INTO `proofpilot`.`sex` (`sex_name`, `status_id`) VALUES ('Transgendered',1);");
        $this->addSql("ALTER TABLE `proofpilot`.`participant` ADD COLUMN `participant_language` INT(1) UNSIGNED NOT NULL DEFAULT 1,
                       ADD CONSTRAINT `fk_particpant_language`
                       FOREIGN KEY (`participant_language`) 
                       REFERENCES `proofpilot`.`language` (`language_id`) 
                       ON DELETE NO ACTION 
                       ON UPDATE NO ACTION;");
        $this->addSql("UPDATE `proofpilot`.`participant` SET `participant_language` =  (SELECT`language_id` FROM `proofpilot`.`language` WHERE `language`.`locale` = `participant`.`participant_locale`  );");
    }

    public function down(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`participant` Drop FOREIGN KEY `fk_particpant_language`;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant` Drop INDEX `fk_particpant_language`;");
        $this->addSql(" ALTER TABLE `proofpilot`.`participant` Drop COLUMN `participant_language`;
                ALTER TABLE `proofpilot`.`participant` Drop COLUMN `participant_interested`;
                DELETE FROM `proofpilot`.`race` WHERE `race_name` = 'East Asian';
                DELETE FROM `proofpilot`.`race` WHERE `race_name` = 'Arab/Middle Eastern';
                DELETE FROM `proofpilot`.`race` WHERE `race_name` = 'Native American or Aboriginal';
                DELETE FROM `proofpilot`.`race` WHERE `race_name` = 'Other';
                DELETE FROM `proofpilot`.`sex` WHERE `sex_name` = 'Transgendered';");
        
    }
}

<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130920111553 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`participant` ADD COLUMN `participant_timezone` INT(11) UNSIGNED NOT NULL DEFAULT 1 AFTER `participant_state`;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant` ADD CONSTRAINT `fk_participant_timezone`
                FOREIGN KEY (`participant_timezone`) 
                REFERENCES `proofpilot`.`participant_timezone` (`participant_timezone_id`) 
                ON DELETE NO ACTION 
                ON UPDATE NO ACTION");
        $this->addSql("UPDATE `proofpilot`.`participant` LEFT JOIN `participant_contact_time_link` ON `participant`.`participant_id` = `participant_contact_time_link`.`participant_id`
                        SET `proofpilot`.`participant`.`participant_timezone` = 
	                    if (`proofpilot`.`participant_contact_time_link`.`participant_id` is null,1,`proofpilot`.`participant_contact_time_link`.`participant_timezone`)");
        $this->addSql("UPDATE `proofpilot`.`participant` SET `participant_timezone` = 1 WHERE `participant_timezone` = 0;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_contact_time_link` 
                DROP FOREIGN KEY `FL_participant_contact_time_link_timezone`,
                DROP COLUMN `participant_timezone`;");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}

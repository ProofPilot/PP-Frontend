<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130907163606 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_timezone` ADD COLUMN `participant_timezone_name` VARCHAR(25) NULL  AFTER `participant_timezone_desc`;
                UPDATE `proofpilot`.`participant_timezone` SET `participant_timezone_name`='America/New_York' WHERE `participant_timezone_desc` LIKE 'EST%';
                UPDATE `proofpilot`.`participant_timezone` SET `participant_timezone_name`='America/Chicago' WHERE `participant_timezone_desc` LIKE 'CST%';
                UPDATE `proofpilot`.`participant_timezone` SET `participant_timezone_name`='America/Denver' WHERE `participant_timezone_desc` LIKE 'MST%';
                UPDATE `proofpilot`.`participant_timezone` SET `participant_timezone_name`='America/Los_Angeles' WHERE `participant_timezone_desc` LIKE 'PST%';
                UPDATE `proofpilot`.`participant_timezone` SET `participant_timezone_name`='America/Anchorage' WHERE `participant_timezone_desc` LIKE 'AST%';
                UPDATE `proofpilot`.`participant_timezone` SET `participant_timezone_name`='Pacific/Honolulu' WHERE `participant_timezone_desc` LIKE 'HAT%';
                UPDATE `proofpilot`.`participant_timezone` SET `participant_timezone_name`='America/Sao_Paulo' WHERE `participant_timezone_desc` LIKE 'BST%';
                UPDATE `proofpilot`.`participant_timezone` SET `participant_timezone_name`='America/Lima' WHERE `participant_timezone_desc` LIKE 'PET%';
                UPDATE `proofpilot`.`participant_timezone` SET `participant_timezone_name`='Europe/London' WHERE `participant_timezone_desc` LIKE 'GMT%';
                ALTER TABLE `proofpilot`.`participant_timezone` CHANGE COLUMN `participant_timezone_name` `participant_timezone_name` VARCHAR(25) NOT NULL  ;
        ");

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

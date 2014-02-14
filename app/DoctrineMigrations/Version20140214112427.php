<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140214112427 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        //this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("
                ALTER TABLE `new-proofpilot`.`location`
                ADD COLUMN `url` VARCHAR(255) NULL,
                ADD COLUMN `operation_hours` VARCHAR(255) NULL,
                ADD COLUMN `services` TEXT NULL;
            				");
        
        $this->addSql("
                UPDATE `new-proofpilot`.`location` SET `url` = 'some url', `operation_hours` = '12:00 - 17:00', `services` = 'SOME descriptions' WHERE `location_name` LIKE 'Starbucks NY%';
                UPDATE `new-proofpilot`.`location` SET `url` = 'some url', `operation_hours` = '12:00 - 17:00', `services` = 'SOME descriptions' WHERE `location_name` LIKE 'Starbucks West Town IL%';
                UPDATE `new-proofpilot`.`location` SET `url` = 'some url', `operation_hours` = '12:00 - 17:00', `services` = 'SOME descriptions' WHERE `location_name` LIKE 'Sunset Plaza Dental%';
                UPDATE `new-proofpilot`.`location` SET `url` = 'some url', `operation_hours` = '12:00 - 17:00', `services` = 'SOME descriptions' WHERE `location_name` LIKE 'Drug Rehabilitation Center in West Hollywood%';
                UPDATE `new-proofpilot`.`location` SET `url` = 'some url', `operation_hours` = '12:00 - 17:00', `services` = 'SOME descriptions' WHERE `location_name` LIKE 'Stone Skin Care%';
                UPDATE `new-proofpilot`.`location` SET `url` = 'some url', `operation_hours` = '12:00 - 17:00', `services` = 'SOME descriptions' WHERE `location_name` LIKE 'Jessica Nail Clinic%';
                UPDATE `new-proofpilot`.`location` SET `url` = 'some url', `operation_hours` = '12:00 - 17:00', `services` = 'SOME descriptions' WHERE `location_name` LIKE 'Back to Total Health%';
                UPDATE `new-proofpilot`.`location` SET `url` = 'some url', `operation_hours` = '12:00 - 17:00', `services` = 'SOME descriptions' WHERE `location_name` LIKE 'Sunset Acupuncture - META CLINIC%';
                UPDATE `new-proofpilot`.`location` SET `url` = 'some url', `operation_hours` = '12:00 - 17:00', `services` = 'SOME descriptions' WHERE `location_name` LIKE 'Saban Community Clinic - Beverly Health Cente%';
                UPDATE `new-proofpilot`.`location` SET `url` = 'some url', `operation_hours` = '12:00 - 17:00', `services` = 'SOME descriptions' WHERE `location_name` LIKE 'James Guay%';
                UPDATE `new-proofpilot`.`location` SET `url` = 'some url', `operation_hours` = '12:00 - 17:00', `services` = 'SOME descriptions' WHERE `location_name` LIKE 'Liddy Health Works%';
                UPDATE `new-proofpilot`.`location` SET `url` = 'some url', `operation_hours` = '12:00 - 17:00', `services` = 'SOME descriptions' WHERE `location_name` LIKE 'Sunset Plaza Beauty Boutique%';
                UPDATE `new-proofpilot`.`location` SET `url` = 'some url', `operation_hours` = '12:00 - 17:00', `services` = 'SOME descriptions' WHERE `location_name` LIKE 'Blueprint Health%';
                UPDATE `new-proofpilot`.`location` SET `url` = 'some url', `operation_hours` = '12:00 - 17:00', `services` = 'SOME descriptions' WHERE `location_name` LIKE 'Test Location%';
                UPDATE `new-proofpilot`.`location` SET `url` = 'some url', `operation_hours` = '12:00 - 17:00', `services` = 'SOME descriptions' WHERE `location_name` LIKE 'Test 2%';
                UPDATE `new-proofpilot`.`location` SET `url` = 'some url', `operation_hours` = '12:00 - 17:00', `services` = 'SOME descriptions' WHERE `location_name` LIKE 'Abt Assoc%';
                            ");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("
                ALTER TABLE `new-proofpilot`.`location`
                DROP COLUMN `url`,
                DROP COLUMN `operation_hours`,
                DROP COLUMN `services`;
            				");
    }
}

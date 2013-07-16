<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130716134842 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`participant` ADD COLUMN `participant_language_id` INT(10) UNSIGNED NULL AFTER `facebookId`,
                ALTER TABLE `participant` 
                ADD CONSTRAINT `fk_participant_language_id1` 
                FOREIGN KEY (`participant_language_id`) REFERENCES `language` (`language_id`) 
                ON DELETE NO ACTION ON UPDATE NO ACTION;");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`participant` DROP FOREIGN KEY `fk_participant_language_id1`;
                 ALTER TABLE `proofpilot`.`intervention` DROP COLUMN `language_id`");
    }
}

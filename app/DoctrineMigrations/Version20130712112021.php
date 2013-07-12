<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130712112021 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`study` DROP COLUMN `study_name`");
        $this->addSql("ALTER TABLE `proofpilot`.`study_content` ADD COLUMN `study_name` VARCHAR(255) NULL DEFAULT NULL  AFTER `language_id`");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`study_content` DROP COLUMN `study_name`");
        $this->addSql("ALTER TABLE `proofpilot`.`study` ADD COLUMN `study_name` varchar(45) NOT NULL  AFTER `study_id`");
    }
}

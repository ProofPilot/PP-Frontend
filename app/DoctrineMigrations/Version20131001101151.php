<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131001101151 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql('ALTER TABLE `proofpilot`.`participant` CHANGE COLUMN `participant_mobile_number` `participant_mobile_number` VARCHAR(45) NULL');
        $this->addSql('UPDATE `participant` SET `participant_mobile_number` = NULL where `participant_mobile_number` = ""');

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql('ALTER TABLE `proofpilot`.`participant` CHANGE COLUMN `participant_mobile_number` `participant_mobile_number` VARCHAR(45)');

    }
}

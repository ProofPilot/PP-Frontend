<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140117162916 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `new-proofpilot`.`intervention` ADD COLUMN `intervention_expiration_period` INT(10) NULL DEFAULT NULL");
        $this->addSql("ALTER TABLE `new-proofpilot`.`intervention` ADD COLUMN `intervention_expiration_date` datetime NULL DEFAULT NULL");
        $this->addSql("ALTER TABLE `new-proofpilot`.`participant_intervention_link` ADD COLUMN `participant_intervention_link_expiration_date` datetime NULL DEFAULT NULL");
        $this->addSql("INSERT INTO `new-proofpilot`.`status` (`status_name`) VALUES  ('Expired')");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

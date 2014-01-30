<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140130105838 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `new-proofpilot`.`participant_campaign_link` ADD COLUMN `is_participant_recruiter` TINYINT NOT NULL DEFAULT 0");
        $this->addSql("UPDATE `new-proofpilot`.`participant_campaign_link` SET `is_participant_recruiter` = 0");
        
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

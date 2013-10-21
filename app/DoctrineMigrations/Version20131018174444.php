<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131018174444 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("ALTER TABLE `proofpilot`.`participant_intervention_link` ADD COLUMN `participant_intervention_link_send_time` DATETIME NULL AFTER `participant_id`;");

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("ALTER TABLE `proofpilot`.`participant_intervention_link` DROP COLUMN `send_time` ;");
    }
}

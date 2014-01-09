<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140109123019 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `new-proofpilot`.`study` CHANGE COLUMN register_proccess participant_register_last TINYINT NOT NULL");
        $this->addSql("ALTER TABLE `new-proofpilot`.`study` CHANGE COLUMN study_skip_steps study_skip_consent TINYINT NOT NULL");
        $this->addSql("ALTER TABLE `new-proofpilot`.`study` ADD COLUMN study_skip_about_me TINYINT NOT NULL AFTER study_skip_consent");

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

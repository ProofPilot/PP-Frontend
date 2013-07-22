<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130722102101 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		$this->addSql("ALTER TABLE proofpilot.study_content ADD COLUMN study_url VARCHAR(200) NULL DEFAULT NULL  AFTER study_consent , ADD COLUMN study_tagline VARCHAR(250) NULL DEFAULT NULL  AFTER study_url , ADD COLUMN study_description VARCHAR(2000) NULL DEFAULT NULL  AFTER study_tagline");

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE proofpilot.study_content DROP COLUMN study_url, DROP COLUMN study_tagline, DROP COLUMN study_description");
    }
}

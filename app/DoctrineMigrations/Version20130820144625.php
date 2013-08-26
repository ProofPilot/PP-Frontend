<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130820144625 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("ALTER TABLE proofpilot.device ADD COLUMN study_id INT(10) UNSIGNED NOT NULL DEFAULT 2 AFTER device_used, ADD CONSTRAINT fk_device_study1 FOREIGN KEY (study_id ) REFERENCES proofpilot.study (study_id ) ON DELETE NO ACTION ON UPDATE NO ACTION, ADD INDEX fk_device_study1_idx (study_id ASC)");
    	
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

    }
}

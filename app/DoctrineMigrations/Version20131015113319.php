<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131015113319 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("ALTER TABLE proofpilot.temporal_access_code CHANGE COLUMN temporal_access_code temporary_access_code_timestamp TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP, 
    			       RENAME TO  proofpilot.temporary_access_code");
    	 
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

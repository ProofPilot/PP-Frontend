<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131008153221 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("CREATE  TABLE IF NOT EXISTS temporal_access_code (
	    	id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
	    	sms_code VARCHAR(4) NOT NULL ,
	    	temporal_access_code TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	    	PRIMARY KEY (id) )
	    	ENGINE = InnoDB");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("DROP TABLE temporal_access_code");
    }
}

<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131218190546 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("INSERT INTO study_organization_role SET study_organization_role_name = 'Affiliate'");
    	$this->addSql("INSERT INTO intervention_type SET intervention_type_name = 'Referred', status_id = '1'");
    	$this->addSql("ALTER TABLE organization CHANGE COLUMN organization_name organization_name VARCHAR(500) NOT NULL  , ADD COLUMN organization_logo VARCHAR(255) NULL DEFAULT NULL  AFTER status_id");
    	    	
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("DELETE FROM study_organization_role WHERE study_organization_role_name = 'Affiliate'");
    	$this->addSql("DELETE FROM intervention_type WHERE intervention_type_name = 'Referred'");
    	$this->addSql("ALTER TABLE organization DROP COLUMN organization_logo");

    }
}

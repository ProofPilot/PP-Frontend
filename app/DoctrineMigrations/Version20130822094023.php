<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130822094023 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");	
    	$this->addSql("INSERT INTO site (site_id, site_name, site_url, organization_id, status_id) VALUES (3, 'Sexpro Default', NULL, 6, 1)");
    	$this->addSql("INSERT INTO campaign_site_link (campaign_site_link_id, campaign_id, site_id) VALUES (4, 4, 3)");
    	
    	$this->addSql("ALTER TABLE arm ADD COLUMN arm_code VARCHAR(45) NOT NULL AFTER arm_id");
    	$this->addSql("UPDATE arm set arm_code = arm_id");
    	$this->addSql("ALTER TABLE arm ADD UNIQUE INDEX arm_code_UNIQUE (arm_code ASC)");
    	    	
    	$this->addSql("ALTER TABLE intervention ADD COLUMN intervention_code VARCHAR(45) NOT NULL AFTER language_id");
    	$this->addSql("UPDATE `intervention` set `intervention_code` = CONCAT('I', `intervention_id`, '-', `language_id`)");
    	$this->addSql("ALTER TABLE intervention ADD UNIQUE INDEX intervention_code_UNIQUE (intervention_code ASC)");
    	
    	$this->addSql("ALTER TABLE study ADD COLUMN study_code VARCHAR(45) NOT NULL  AFTER email_verification_required");
    	$this->addSql("UPDATE study set study_code = study_id");
    	$this->addSql("ALTER TABLE study ADD UNIQUE INDEX study_code_UNIQUE (study_code ASC)");
    	
    	$this->addSql("ALTER TABLE site ADD COLUMN site_default TINYINT(3) UNSIGNED NOT NULL DEFAULT 0  AFTER status_id");
    	
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    }
}

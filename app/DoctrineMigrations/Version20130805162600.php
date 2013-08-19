<?php
/*
 * This is part of the ProofPilot package.
*
* (c)2012-2013 Cyclogram, Inc, West Hollywood, CA <crew@proofpilot.com>
* ALL RIGHTS RESERVED
*
* This software is provided by the copyright holders to Manila Consulting for use on the
* Center for Disease Control's Evaluation of Rapid HIV Self-Testing among MSM in High
* Prevalence Cities until 2016 or the project is completed.
*
* Any unauthorized use, modification or resale is not permitted without expressed permission
* from the copyright holders.
*
* KnowatHome branding, URL, study logic, survey instruments, and resulting data are not part
* of this copyright and remain the property of the prime contractor.
*
*/
namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130805162600 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

    	$this->addSql("ALTER TABLE proofpilot.site ADD COLUMN organization_id INT(10) UNSIGNED NOT NULL  AFTER site_url, ADD CONSTRAINT fk_site_organization1 FOREIGN KEY (organization_id ) REFERENCES proofpilot.organization (organization_id) ON DELETE NO ACTION ON UPDATE NO ACTION, ADD INDEX fk_site_organization1_idx (organization_id ASC)");
    	$this->addSql("CREATE  TABLE IF NOT EXISTS proofpilot.representative_site_link (representative_site_link_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, representative_id INT(10) UNSIGNED NOT NULL, site_id INT(10) UNSIGNED NOT NULL, PRIMARY KEY (representative_site_link_id), INDEX fk_representative_site_link_representative1_idx (representative_id ASC), INDEX fk_representative_site_link_site1_idx (site_id ASC), CONSTRAINT fk_representative_site_link_representative1 FOREIGN KEY (representative_id ) REFERENCES proofpilot.representative (representative_id ) ON DELETE NO ACTION ON UPDATE NO ACTION, CONSTRAINT fk_representative_site_link_site1 FOREIGN KEY (site_id ) REFERENCES proofpilot.site (site_id ) ON DELETE NO ACTION ON UPDATE NO ACTION) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8");
    	$this->addSql("CREATE  TABLE IF NOT EXISTS proofpilot.campaign_site_link (campaign_site_link_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, campaign_id INT(10) UNSIGNED NOT NULL, site_id INT(10) UNSIGNED NOT NULL, PRIMARY KEY (campaign_site_link_id), INDEX fk_campaign_site_link_campaign1_idx (campaign_id ASC), INDEX fk_campaign_site_link_site1_idx (site_id ASC), CONSTRAINT fk_campaign_site_link_campaign1 FOREIGN KEY (campaign_id ) REFERENCES proofpilot.campaign (campaign_id ) ON DELETE NO ACTION ON UPDATE NO ACTION, CONSTRAINT fk_campaign_site_link_site1 FOREIGN KEY (site_id ) REFERENCES proofpilot.site (site_id ) ON DELETE NO ACTION ON UPDATE NO ACTION) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8");
    	
    	 
    	
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	
    	$this->addSql("ALTER TABLE proofpilot.site DROP COLUMN organization_id, DROP CONSTRAINT fk_site_organization1, DROP INDEX fk_site_organization1_idx");
    	$this->addSql("DROP TABLE proofpilot.representative_site_link");
    	$this->addSql("DROP TABLE proofpilot.campaign_site_link");
    	 

    }
}

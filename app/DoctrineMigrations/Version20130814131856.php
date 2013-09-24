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
class Version20130814131856 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("INSERT INTO campaign (campaign_name, campaign_desc, campaign_target, campaign_url, campaign_budget, campaign_budget_spend, campaign_date_start, campaign_date_end, campaign_type_id, placement_id, affinity_id, status_id)
                       VALUES ('SexPro SF', 'SexPro San Francisco', NULL, NULL, NULL, NULL, NULL, NULL, 1, 3, 1, 1)");
    	
    	$this->addSql("INSERT INTO campaign (campaign_name, campaign_desc, campaign_target, campaign_url, campaign_budget, campaign_budget_spend, campaign_date_start, campaign_date_end, campaign_type_id, placement_id, affinity_id, status_id)
                       VALUES ('SexPro NY', 'SexPro New York', NULL, NULL, NULL, NULL, NULL, NULL, 1, 3, 1, 1)");
    	
    	$this->addSql("INSERT INTO campaign (campaign_name, campaign_desc, campaign_target, campaign_url, campaign_budget, campaign_budget_spend, campaign_date_start, campaign_date_end, campaign_type_id, placement_id, affinity_id, status_id)
                       VALUES ('SexPro Rio', 'SexPro Rio de Janeiro', NULL, NULL, NULL, NULL, NULL, NULL, 1, 3, 1, 1)");
    	
    	$this->addSql("INSERT INTO campaign (campaign_name, campaign_desc, campaign_target, campaign_url, campaign_budget, campaign_budget_spend, campaign_date_start, campaign_date_end, campaign_type_id, placement_id, affinity_id, status_id)
                       VALUES ('SexPro Lima', 'SexPro Lima', NULL, NULL, NULL, NULL, NULL, NULL, 1, 3, 1, 1)");
    	
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131108171703 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("DELETE FROM `proofpilot`.`participant_intervention_link` WHERE `intervention_id` = (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KOCSocialMediaSurvey')");
        $this->addSql("DELETE FROM `proofpilot`.`participant_arm_link` WHERE `arm_id` = (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` = 'KOCSMDefault')");
        $this->addSql("DELETE FROM `proofpilot`.`participant_arm_link` WHERE `arm_id` = (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` = 'KOCOnline')");
       
        
        $this->addSql("DELETE FROM `proofpilot`.`arm_intervention_link` WHERE `arm_id` = (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` = 'KOCSMDefault')");
        $this->addSql("DELETE FROM `proofpilot`.`arm_intervention_link` WHERE `arm_id` = (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` = 'KOCOnline')");
        $this->addSql("DELETE FROM `proofpilot`.`participant_campaign_link` WHERE `campaign_id` = (SELECT `campaign_id` FROM `proofpilot`.`campaign` WHERE `campaign_name` = 'KOCSocial')");
        $this->addSql("DELETE FROM `proofpilot`.`campaign_site_link` WHERE `campaign_id` = (SELECT `campaign_id` FROM `proofpilot`.`campaign` WHERE `campaign_name` = 'KOCSocial')");
        $this->addSql("DELETE FROM `proofpilot`.`campaign` WHERE `campaign_name` = 'KOCSocial'");
        $this->addSql("DELETE FROM `proofpilot`.`arm_intervention_link` WHERE `intervention_id` = (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KOCSocialMediaSurvey')");
        $this->addSql("DELETE FROM `proofpilot`.`arm` WHERE `arm_code` = 'KOCSMDefault'");
        $this->addSql("DELETE FROM `proofpilot`.`arm` WHERE `arm_code` = 'KOCOnline'");
        $this->addSql("DELETE FROM `proofpilot`.`placement` WHERE `study_id` = (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'kocsocialmedia')");
        $this->addSql("DELETE FROM `proofpilot`.`device` WHERE `study_id` = (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'kocsocialmedia')");
        $this->addSql("DELETE FROM `proofpilot`.`intervention` WHERE `study_id` = (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'kocsocialmedia')");
        $this->addSql("DELETE FROM `proofpilot`.`intervention` WHERE `intervention_id` = 'KOCSocialMediaSurvey'");
        
        $this->addSql("DELETE FROM `proofpilot`.`study_content` WHERE `study_id` = (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'kocsocialmedia')");
        $this->addSql("DELETE FROM `proofpilot`.`study_organization_link` WHERE `study_id` = (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'kocsocialmedia')");
        $this->addSql("DELETE FROM `proofpilot`.`study` WHERE `study_code` = 'kocsocialmedia'");
        
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

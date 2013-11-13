<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131112183259 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("DELETE FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'MPFOCUS';
                       DELETE FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'MPFORM';");
        $this->addSql("DELETE FROM `proofpilot`.`arm` WHERE `arm_code` = 'AForm';
                       DELETE FROM `proofpilot`.`arm` WHERE `arm_code` = 'AFormative';");
        $this->addSql("DELETE FROM `proofpilot`.`study_content` WHERE `study_id` = (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'S4581');");
        $this->addSql("DELETE FROM `proofpilot`.`study_organization_link` WHERE `study_id` = (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'S4581');");
        $this->addSql("DELETE FROM `proofpilot`.`campaign_site_link` WHERE `site_id` = (SELECT `site_id` FROM `proofpilot`.`site` WHERE `site_name` = 'Make a Pledge Formative');");
        $this->addSql("DELETE FROM `proofpilot`.`campaign` WHERE `campaign_name` = 'Make a Pledge Formative Study - Default Campa';");
        $this->addSql("DELETE FROM `proofpilot`.`placement` WHERE `study_id` = (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'S4581');");
        $this->addSql("DELETE FROM `proofpilot`.`study` WHERE `study_code` = 'S4581';");
        $this->addSql("DELETE FROM `proofpilot`.`site` WHERE `site_name` = 'Make a Pledge Formative';");
        
        $this->addSql("INSERT INTO `proofpilot`.`study`
                (`study_recruitment_start`, `study_recruitment_end`,`study_recruitment_extend_end`,`status_id`,`study_allow_invites`,`study_allow_sharing`,`study_invite_only`,`study_facebook_page`,`study_twitter_page`,`study_allow_mobile_devices_store_date`, `study_barcode_required`, `study_real_time_graphics`, `email_verification_required`, `study_code`)
                VALUES (NULL,NULL,NULL,6,0,0,0,NULL,NULL,0,0,0,0,'S4581');");
        
        $this->addSql("INSERT INTO `proofpilot`.`study_content`
                (`study_id`,`language_id`,`study_name`, `study_logo`,`study_video`,`study_graphic`,`study_about`,`study_whats_involved`,`study_requirements`,`study_privacy`,`study_elegibility_survey`,`study_video_addition`, `study_consent_image`, `study_consent_introduction`, `study_consent`, `study_url`,`study_tagline`, `study_description`, `study_proofpilot_privacy`)
                VALUES ((SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'S4581'),1,'Make a Pledge Formative Study',NULL,NULL,NULL,NULL,'<p>Consent information here.&nbsp;</p>',NULL,NULL,481663,NULL,NULL,NULL,NULL,'S4581',NULL,NULL,NULL);");
        
        $this->addSql("INSERT INTO `proofpilot`.`arm`
                (`arm_code`, `arm_name`,`arm_quota`,`arm_ceilling`,`arm_description`,`study_id`,`status_id`,`arm_default`)
                VALUES ('AFormative', 'Formative Survey', 250, 250, NULL,
                (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'S4581'),1,1);");
        
        $this->addSql("INSERT INTO `proofpilot`.`intervention`
                (`language_id`,`intervention_name`,`intervention_type_id`,`intervention_url`,`sid_id`,`intervention_response_url`,
                `status_id`,`intervention_title`,`intervention_descripton`,`intervention_code`,`study_id`, `intervention_incentive_amount`)
                VALUES (1, 'Formative Survey', 2,NULL,817215,NULL,1,'Now Take the Full Survey','Take this survey and earn $15 while also helping to design a new kind of HIV campaign.','MPFORM',
                (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'S4581'), 15);");
        
        $this->addSql("INSERT INTO `proofpilot`.`intervention`
                (`language_id`,`intervention_name`,`intervention_type_id`,`intervention_url`,`sid_id`,`intervention_response_url`,
                `status_id`,`intervention_title`,`intervention_descripton`,`intervention_code`,`study_id`, `intervention_incentive_amount`)
                VALUES (1, 'Focus Group', 1,NULL,NULL,NULL,1,'Join the focus group!','Join the focus group on xxxx at xxxx','MPFOCUS',
                (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'S4581'), 350);");
        
        
        $this->addSql("INSERT INTO `proofpilot`.`study_organization_link`
                (`organization_id`,`study_id`, `study_organization_role_id`,`status_id`)
                VALUES ((SELECT `organization_id` FROM `proofpilot`.`organization` WHERE `organization_name` = 'Georgia State University'),(SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'S4581'),1,1);");
        
        $this->addSql("INSERT INTO `proofpilot`.`site`
                (`site_name`,`site_url`, `organization_id`,`status_id`, `site_default`)
                VALUES ('Make a Pledge Formative',NULL,(SELECT `organization_id` FROM `proofpilot`.`organization` WHERE `organization_name` = 'Georgia State University'),1,1);");
        
        $this->addSql("INSERT INTO `proofpilot`.`placement`
                (`placement_name`,`placement_description`, `placement_cost_per_placement`,`placement_cost_per_impression`, `placement_budget`, `placement_budget_spent`, `placement_date_start`, `placement_date_stop`, `study_id`, `status_id`)
                VALUES ('Make a Pledge Formative Study - Default Place','Make a Pledge Formative Study - Default Place',NULL,NULL,NULL,NULL,NULL,NULL,(SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'S4581'),1);");
        
        $this->addSql("ALTER TABLE `proofpilot`.`campaign` MODIFY COLUMN `campaign_name` varchar(100) NOT NULL");
        
        $this->addSql("INSERT INTO `proofpilot`.`campaign`
                (`campaign_name`,`campaign_desc`, `campaign_target`,`campaign_url`, `campaign_budget`, `campaign_budget_spend`,`campaign_date_start`, `campaign_date_end`, `campaign_type_id`, `placement_id`, `affinity_id`, `status_id`, `campaign_default_per_site`)
                VALUES ('Make a Pledge Formative Study - Default Campaign','Make a Pledge Formative Study - Default campaign',NULL,NULL,NULL,NULL,NULL,NULL,3,(SELECT `placement_id` FROM `proofpilot`.`placement` WHERE `placement_name` = 'Make a Pledge Formative Study - Default Place'),1,1,1);");
        
        $this->addSql("INSERT INTO `proofpilot`.`campaign_site_link`
                (`campaign_id`,`site_id`)
                VALUES ((SELECT `campaign_id` FROM `proofpilot`.`campaign` WHERE `campaign_name` = 'Make a Pledge Formative Study - Default Campaign'), (SELECT `site_id` FROM `proofpilot`.`site` WHERE `site_name` = 'Make a Pledge Formative'));");
        
        $this->addSql("INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` = 'AFormative') ,
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'MPFORM'), 1, 1);");
        $this->addSql("INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` = 'AFormative') ,
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'MPFOCUS'), 1, 0);");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

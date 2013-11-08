<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131028105024 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("DELETE FROM `proofpilot`.`participant_intervention_link` WHERE `intervention_id` = (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KOCBaseline')");
        $this->addSql("DELETE FROM `proofpilot`.`participant_intervention_link` WHERE `intervention_id` = (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'LocalTechUseSurvey')");
        $this->addSql("DELETE FROM `proofpilot`.`participant_intervention_link` WHERE `intervention_id` = (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KOCFollowUpSurvey')");
        $this->addSql("DELETE FROM `proofpilot`.`participant_intervention_link` WHERE `intervention_id` = (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KOCCondomPickUpSurvey')");
        $this->addSql("DELETE FROM `proofpilot`.`participant_intervention_link` WHERE `intervention_id` = (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 10)");
        $this->addSql("DELETE FROM `proofpilot`.`arm_intervention_link` WHERE `arm_id` = (SELECT `study_id` FROM `proofpilot`.`arm` WHERE `arm_code` = 'KOCOnline')");
        $this->addSql("DELETE FROM `proofpilot`.`arm_intervention_link` WHERE `intervention_id` = (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KOCBaseline')");
        $this->addSql("DELETE FROM `proofpilot`.`arm_intervention_link` WHERE `intervention_id` = (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'LocalTechUseSurvey')");
        $this->addSql("DELETE FROM `proofpilot`.`arm_intervention_link` WHERE `intervention_id` = (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KOCFollowUpSurvey')");
        $this->addSql("DELETE FROM `proofpilot`.`arm_intervention_link` WHERE `intervention_id` = (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KOCCondomPickUpSurvey')");
        $this->addSql("DELETE FROM `proofpilot`.`arm_intervention_link` WHERE `intervention_id` = (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 10)");
        $this->addSql("DELETE FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KOCBaseline';
                       DELETE FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'LocalTechUseSurvey';
                       DELETE FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KOCFollowUpSurvey';
                       DELETE FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KOCCondomPickUpSurvey';
                       DELETE FROM `proofpilot`.`intervention` WHERE `intervention_code` = 10;");
        
        $this->addSql("INSERT INTO `proofpilot`.`arm`
                (`arm_code`, `arm_name`,`arm_quota`,`arm_ceilling`,`arm_description`,`study_id`,`status_id`,`arm_default`)
                VALUES ('KOCCondomTrainingArm', 'KOC Condom Training Arm', NULL, NULL, NULL,
                (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'koc'),1,0);");
        
        $this->addSql("INSERT INTO `proofpilot`.`arm`
                (`arm_code`, `arm_name`,`arm_quota`,`arm_ceilling`,`arm_description`,`study_id`,`status_id`,`arm_default`)
                VALUES ('KOCNoTrainingArm', 'KOC No Training Arm', NULL, NULL, NULL,
                (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'koc'),1,0);");
        
        $this->addSql("INSERT INTO `proofpilot`.`arm`
                (`arm_code`, `arm_name`,`arm_quota`,`arm_ceilling`,`arm_description`,`study_id`,`status_id`,`arm_default`)
                VALUES ('KOCOnlineOnlyArm', 'KOC Online Only Arm', NULL, NULL, NULL,
                (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'koc'),1,1);");
        
        $this->addSql("INSERT INTO `proofpilot`.`intervention`
                (`language_id`,`intervention_name`,`intervention_type_id`,`intervention_url`,`sid_id`,`intervention_response_url`,
                `status_id`,`intervention_title`,`intervention_descripton`,`intervention_code`,`study_id`, `intervention_incentive_amount`)
                VALUES (1, 'KOC Baseline', 2,'http://limesurvey.dev1.proofpilot.net/index.php/survey/index.php/432264/lang-en',432264,NULL,1,'KOC Baseline',NULL,'KOCBaseline',
                (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'koc'), 0);");
        
        $this->addSql("INSERT INTO `proofpilot`.`intervention`
                (`language_id`,`intervention_name`,`intervention_type_id`,`intervention_url`,`sid_id`,`intervention_response_url`,
                `status_id`,`intervention_title`,`intervention_descripton`,`intervention_code`,`study_id`, `intervention_incentive_amount`)
                VALUES (1, 'KOC Training', 1,NULL,NULL,NULL,1,'KOC Training',NULL,'KOCTraining',
                (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'koc'), 0);");
        
        $this->addSql("INSERT INTO `proofpilot`.`intervention`
                (`language_id`,`intervention_name`,`intervention_type_id`,`intervention_url`,`sid_id`,`intervention_response_url`,
                `status_id`,`intervention_title`,`intervention_descripton`,`intervention_code`,`study_id`, `intervention_incentive_amount`)
                VALUES (1, 'KOC Technology Use Survey', 2,'http://limesurvey.dev1.proofpilot.net/index.php/survey/index.php/378198/lang-en',378198,NULL,1,'KOC Technology Use Survey',NULL,'KOCTechnologyUseSurvey',
                (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'koc'), 0);");
        
        $this->addSql("INSERT INTO `proofpilot`.`intervention`
                (`language_id`,`intervention_name`,`intervention_type_id`,`intervention_url`,`sid_id`,`intervention_response_url`,
                `status_id`,`intervention_title`,`intervention_descripton`,`intervention_code`,`study_id`, `intervention_incentive_amount`)
                VALUES (1, 'KOC Condom Pick-Up Survey', 2,'http://limesurvey.dev1.proofpilot.net/index.php/survey/index.php/949233/lang-en',949233,NULL,1,'KOC Condom Pick-Up Survey',NULL,'KOCCondomPick-UpSurvey',
                (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'koc'), 0);");
        
        $this->addSql("INSERT INTO `proofpilot`.`intervention`
                (`language_id`,`intervention_name`,`intervention_type_id`,`intervention_url`,`sid_id`,`intervention_response_url`,
                `status_id`,`intervention_title`,`intervention_descripton`,`intervention_code`,`study_id`, `intervention_incentive_amount`)
                VALUES (1, 'KOC Follow-Up Survey', 2,'http://limesurvey.dev1.proofpilot.net/index.php/survey/index.php/825826/lang-en',825826,NULL,1,'KOC Follow-Up Survey',NULL,'KOCFollow-UpSurvey',
                (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'koc'), 0);");
        
        
        $this->addSql("INSERT INTO `proofpilot`.`study_organization_link`
                (`organization_id`,`study_id`, `study_organization_role_id`,`status_id`)
                VALUES (5,(SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'koc'),1,1);");
        
        $this->addSql("INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` = 'KOCCondomTrainingArm') ,
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KOCBaseline'), 1, 1);
                INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` = 'KOCCondomTrainingArm') ,
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KOCTraining'), 1, 0);
                INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` = 'KOCCondomTrainingArm') ,
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KOCTechnologyUseSurvey'), 1, 0);
                INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` = 'KOCCondomTrainingArm') ,
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KOCCondomPick-UpSurvey'), 1, 0);
                INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` = 'KOCCondomTrainingArm') ,
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KOCFollow-UpSurvey'), 1, 0);");
                
        
        $this->addSql("INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` ='KOCNoTrainingArm') ,
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KOCBaseline'), 1, 1);
                INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` ='KOCNoTrainingArm') ,
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KOCTechnologyUseSurvey'), 1, 0);
                INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` = 'KOCNoTrainingArm') ,
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KOCCondomPick-UpSurvey'), 1, 0);
                INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` = 'KOCNoTrainingArm') ,
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KOCFollow-UpSurvey'), 1, 0);");
        
        
        $this->addSql("INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` ='KOCOnlineOnlyArm') ,
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KOCBaseline'), 1, 1);
                INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` ='KOCOnlineOnlyArm') ,
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KOCTechnologyUseSurvey'), 1, 0);
                INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` = 'KOCOnlineOnlyArm') ,
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KOCCondomPick-UpSurvey'), 1, 0);
                INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` = 'KOCOnlineOnlyArm') ,
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KOCFollow-UpSurvey'), 1, 0);");
    }
    

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

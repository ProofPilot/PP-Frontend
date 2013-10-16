<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131016121155 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("INSERT INTO `proofpilot`.`study` 
                                     (`study_recruitment_start`,`study_recruitment_end`,`study_recruitment_extend_end`,`status_id`,`study_allow_invites`,`study_allow_sharing`,
                                     `study_invite_only`,`study_facebook_page`,`study_twitter_page`,`study_allow_mobile_devices_store_date`,
                                     `study_barcode_required`,`study_real_time_graphics`,`email_verification_required`,`study_code`) 
                              VALUES (NULL,NULL,0,1,0,0,0,NULL,NULL,0,0,0,0, 'defaultparticipant');");
                
        $this->addSql("INSERT INTO `proofpilot`.`arm` 
                                     (`arm_code`, `arm_name`,`arm_quota`,`arm_ceilling`,`arm_description`,`study_id`,`status_id`,`arm_default`) 
                              VALUES ('DefaultParticipantArm', 'Default Participant Arm', NULL, NULL, NULL,
                                     (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'defaultparticipant'),1,0);");
                
        $this->addSql("INSERT INTO `proofpilot`.`intervention`
                                     (`language_id`,`intervention_name`,`intervention_type_id`,`intervention_url`,`sid_id`,`intervention_response_url`,
                                     `status_id`,`intervention_title`,`intervention_descripton`,`intervention_code`,`study_id`, `intervention_incentive_amount`) 
                              VALUES (1, 'Default Participant Email Confirm', 1,NULL,NULL,NULL,1,'Confirm your e-mail address',NULL,'DefaultParticipantEmailConfirm', 
                                     (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'defaultparticipant'), 0);");
                
        $this->addSql("INSERT INTO `proofpilot`.`intervention`
                                     (`language_id`,`intervention_name`,`intervention_type_id`,`intervention_url`,`sid_id`,`intervention_response_url`,
                                     `status_id`,`intervention_title`,`intervention_descripton`,`intervention_code`,`study_id`, `intervention_incentive_amount`) 
                              VALUES (1, 'Default Participant Communication Preferences', 1,NULL,NULL,NULL,1,'Update communication preferences',NULL,'DefaultParticipantCommunicationPreferences', 
                                     (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'defaultparticipant'), 0);");
                
        $this->addSql("INSERT INTO `proofpilot`.`intervention`
                                     (`language_id`,`intervention_name`,`intervention_type_id`,`intervention_url`,`sid_id`,`intervention_response_url`,
                                     `status_id`,`intervention_title`,`intervention_descripton`,`intervention_code`,`study_id`, `intervention_incentive_amount`) 
                              VALUES (1, 'Default Participant Shipping Information', 1,NULL,NULL,NULL,1,'Add Shipping information',NULL,'DefaultParticipantShippingInformation', 
                                     (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'defaultparticipant'), 0);");
                        
        $this->addSql("INSERT INTO `proofpilot`.`study_content`
                                     (`study_id`,`language_id`,`study_name`,`study_logo`,`study_video`,`study_graphic`,`study_about`,`study_whats_involved`,
                                     `study_requirements`,`study_privacy`,`study_elegibility_survey`,`study_video_addition`,`study_consent_image`,`study_consent_introduction`,
                                     `study_consent`,`study_url`,`study_tagline`,`study_description`,`study_proofpilot_privacy`)
                              VALUES ((SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'defaultparticipant'), 1,'Default Participant Study', 'logo2.png',
                                     NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131021154000 extends AbstractMigration
{
    public function up(Schema $schema)
    {
//         this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("INSERT INTO `proofpilot`.`study`
                (`study_recruitment_start`,`study_recruitment_end`,`study_recruitment_extend_end`,`status_id`,`study_allow_invites`,`study_allow_sharing`,
                `study_invite_only`,`study_facebook_page`,`study_twitter_page`,`study_allow_mobile_devices_store_date`,
                `study_barcode_required`,`study_real_time_graphics`,`email_verification_required`,`study_code`)
                VALUES (NULL,NULL,0,1,0,0,0,NULL,NULL,0,0,0,0, 'eStamp4');");
        
        $this->addSql("INSERT INTO `proofpilot`.`arm`
                (`arm_code`, `arm_name`,`arm_quota`,`arm_ceilling`,`arm_description`,`study_id`,`status_id`,`arm_default`)
                VALUES ('eStamp4InterventionArm', 'eStamp4 Intervention Arm', NULL, NULL, NULL,
                (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'eStamp4'),1,0);");
        
        $this->addSql("INSERT INTO `proofpilot`.`arm`
                (`arm_code`, `arm_name`,`arm_quota`,`arm_ceilling`,`arm_description`,`study_id`,`status_id`,`arm_default`)
                VALUES ('eStamp4ControlArm', 'eStamp4 Control Arm', NULL, NULL, NULL,
                (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'eStamp4'),1,0);");
        
        $this->addSql("INSERT INTO `proofpilot`.`arm`
                (`arm_code`, `arm_name`,`arm_quota`,`arm_ceilling`,`arm_description`,`study_id`,`status_id`,`arm_default`)
                VALUES ('eStamp4HIVPositiveArm', 'eStamp4 HIV Positive Arm', NULL, NULL, NULL,
                (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'eStamp4'),1,0);");
        
        $this->addSql("INSERT INTO `proofpilot`.`intervention`
                (`language_id`,`intervention_name`,`intervention_type_id`,`intervention_url`,`sid_id`,`intervention_response_url`,
                `status_id`,`intervention_title`,`intervention_descripton`,`intervention_code`,`study_id`, `intervention_incentive_amount`)
                VALUES (1, 'eStamp4 HIV Baseline', 2,'http://limesurvey.dev1.proofpilot.net/index.php/survey/index.php/393626/lang-en',393626,NULL,1,'eStamp4 HIV Baseline',NULL,'eStamp4HIVBaseline',
                (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'eStamp4'), 0);");
        
        $this->addSql("INSERT INTO `proofpilot`.`intervention`
                (`language_id`,`intervention_name`,`intervention_type_id`,`intervention_url`,`sid_id`,`intervention_response_url`,
                `status_id`,`intervention_title`,`intervention_descripton`,`intervention_code`,`study_id`, `intervention_incentive_amount`)
                VALUES (1, 'eStamp4 HIV Follow-up', 2,'http://limesurvey.dev1.proofpilot.net/index.php/survey/index.php/254935/lang-en',254935,NULL,1,'eStamp4 HIV Follow-up',NULL,'eStamp4HIVFollow-up',
                (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'eStamp4'), 0);");
        
        $this->addSql("INSERT INTO `proofpilot`.`intervention`
                (`language_id`,`intervention_name`,`intervention_type_id`,`intervention_url`,`sid_id`,`intervention_response_url`,
                `status_id`,`intervention_title`,`intervention_descripton`,`intervention_code`,`study_id`, `intervention_incentive_amount`)
                VALUES (1, 'eStamp4 Baseline', 2,'http://limesurvey.dev1.proofpilot.net/index.php/survey/index.php/819549/lang-en',819549,NULL,1,'eStamp4 Baseline',NULL,'eStamp4Baseline',
                (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'eStamp4'), 0);");
        
        $this->addSql("INSERT INTO `proofpilot`.`intervention`
                (`language_id`,`intervention_name`,`intervention_type_id`,`intervention_url`,`sid_id`,`intervention_response_url`,
                `status_id`,`intervention_title`,`intervention_descripton`,`intervention_code`,`study_id`, `intervention_incentive_amount`)
                VALUES (1, 'eStamp4 Self-Test Results', 2,'http://limesurvey.dev1.proofpilot.net/index.php/survey/index.php/479586/lang-en',479586,NULL,1,'eStamp4 Self-Test Results',NULL,'eStamp4Self-TestResults',
                (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'eStamp4'), 0);");
        
        $this->addSql("INSERT INTO `proofpilot`.`intervention`
                (`language_id`,`intervention_name`,`intervention_type_id`,`intervention_url`,`sid_id`,`intervention_response_url`,
                `status_id`,`intervention_title`,`intervention_descripton`,`intervention_code`,`study_id`, `intervention_incentive_amount`)
                VALUES (1, 'eStamp4 RCT Follow-Up 4', 2,'http://limesurvey.dev1.proofpilot.net/index.php/survey/index.php/932957/lang-en',932957,NULL,1,'eStamp4 RCT Follow-Up 4',NULL,'eStamp4RCTFollow-Up4',
                (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'eStamp4'), 0);");
        
        $this->addSql("INSERT INTO `proofpilot`.`intervention`
                (`language_id`,`intervention_name`,`intervention_type_id`,`intervention_url`,`sid_id`,`intervention_response_url`,
                `status_id`,`intervention_title`,`intervention_descripton`,`intervention_code`,`study_id`, `intervention_incentive_amount`)
                VALUES (1, 'eStamp4 Control Arm Intervention', 2,'http://limesurvey.dev1.proofpilot.net/index.php/survey/index.php/141635/lang-en',141635,NULL,1,'eStamp4 Control Arm Intervention',NULL,'eStamp4ControlArmIntervention',
                (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'eStamp4'), 0);");
        
        $this->addSql("INSERT INTO `proofpilot`.`intervention`
                (`language_id`,`intervention_name`,`intervention_type_id`,`intervention_url`,`sid_id`,`intervention_response_url`,
                `status_id`,`intervention_title`,`intervention_descripton`,`intervention_code`,`study_id`, `intervention_incentive_amount`)
                VALUES (1, 'eStamp4 Self-Test Results at Completion 4', 2,'http://limesurvey.dev1.proofpilot.net/index.php/survey/index.php/699237/lang-en',699237,NULL,1,'eStamp4 Self-Test Results at Completion 4',NULL,'eStamp4Self-TestResultsatCompletion',
                (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'eStamp4'), 0);");
        
        $this->addSql("INSERT INTO `proofpilot`.`intervention`
                (`language_id`,`intervention_name`,`intervention_type_id`,`intervention_url`,`sid_id`,`intervention_response_url`,
                `status_id`,`intervention_title`,`intervention_descripton`,`intervention_code`,`study_id`, `intervention_incentive_amount`)
                VALUES (1, 'eStamp4 HIV Welcome Kit', 5,NULL,NULL,NULL,1,NULL,NULL,'eStamp4HIVWelcomeKit',
                (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'eStamp4'), 0);");
        
        $this->addSql("INSERT INTO `proofpilot`.`intervention`
                (`language_id`,`intervention_name`,`intervention_type_id`,`intervention_url`,`sid_id`,`intervention_response_url`,
                `status_id`,`intervention_title`,`intervention_descripton`,`intervention_code`,`study_id`, `intervention_incentive_amount`)
                VALUES (1, 'eStamp4 Welcome Kit', 5,NULL,NULL,NULL,1,NULL,NULL,'eStamp4WelcomeKit',
                (SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'eStamp4'), 0);");
        
        $this->addSql("INSERT INTO `proofpilot`.`study_content`
                (`study_id`,`language_id`,`study_name`,`study_logo`,`study_video`,`study_graphic`,`study_about`,`study_whats_involved`,
                `study_requirements`,`study_privacy`,`study_elegibility_survey`,`study_video_addition`,`study_consent_image`,`study_consent_introduction`,
                `study_consent`,`study_url`,`study_tagline`,`study_description`,`study_proofpilot_privacy`)
                VALUES ((SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'eStamp4'), 1,'eStamp 4', 'logo-1-en.png',
                'video','graphic-1-en.png','<p>What Is KnowAtHome?</p><p>&nbsp;</p><p>KnowAtHome is a research study being conducted by Emory University to 
                evaluate the acceptability, use and effectiveness of HIV self-test kits among men in our community. Click on Are You Eligible? to see if you&rsquo;re
                 eligible to participate.</p>','<p>involved</p>','<p>Congratulations! You are eligible to participate in this health study,&nbsp;Complete the 
                registration process and enroll into this study. Thank you for your time.</p>','<p>KnowAtHome.org takes your privacy and security seriously. Your
                trust is of the upmost importance to us, and we will never betray it. We use the most advanced technology and techniques to safeguard all your information.&nbsp;</p>',
                349799,'video-addtion',NULL,'<p>Thank you for your interest in our study. First, we have a few questions to determine if you&rsquo;re eligible. Please take note of
                 the following information:<br /> 1. Your answers are anonymous: we don\'t have any information about who you are beyond the questions you answer.<br /> 2. Some 
                questions are about sensitive topics; you can choose not to answer any question that you are not comfortable with.<br /> 3. If you have any questions or comments, 
                you may contact the Principal Investigator, Dr. Patrick Sullivan of Emory University, at (404) 727-2038.</p><p><br />Public reporting burden of this collection of 
                information is estimated to average 3 minutes per response, including the time for reviewing instructions, searching existing data sources, gathering and maintaining 
                the data needed, and completing and reviewing the collection of information. An agency may not conduct or sponsor, and a person is not required to respond to a collection 
                of information unless it displays a currently valid OMB control number. Send comments regarding this burden estimate or any other aspect of this collection of information, 
                including suggestions for reducing this burden to CDC/ATSDR Reports Clearance Officer; 1600 Clifton Road NE, MS D-74, Atlanta, Georgia 30333; Attn: OMB-PRA (0920-0840)</p>',
                '<p class=\"p1\"><span class=\"s2\">You may keep a copy of this form for your records if you like.</span></p><p class=\"p1\"><span class=\"s2\">&nbsp;</span></p>
                <p class=\"p1\">&nbsp;</p><p class=\"p1\"><span class=\"s1\">* Reading level does not include HIPAA Authorization language.</span></p>','knowathome4',NULL,'<p>Thank you for your interest in this health study!&nbsp;</p>
                <p>&nbsp;</p><p>Emory University is conducting a research study on home HIV testing. If you are eligible and agree to participate, we will mail you free rapid HIV home testing kits. You can use these kits to test yourself
                 and read your results within 15-20 minutes. You can earn up to $30 if you complete all study activities.</p><p>&nbsp;</p><p>The consent form will give you more information about the purpose of our study and what kind of 
                questions we will ask you to determine if you are eligible to participate. If you would like to learn more, please click on the &ldquo;Continue&rdquo; button below. Otherwise, you may close your browser.</p>',NULL);");
        
        $this->addSql("INSERT INTO `proofpilot`.`study_organization_link`
                (`organization_id`,`study_id`, `study_organization_role_id`,`status_id`)
                VALUES (3,(SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'eStamp4'),1,1);");
        
        $this->addSql("INSERT INTO `proofpilot`.`study_organization_link`
                (`organization_id`,`study_id`, `study_organization_role_id`,`status_id`)
                VALUES (3,(SELECT `study_id` FROM `proofpilot`.`study` WHERE `study_code` = 'eStamp4'),2,1);");
        
        $this->addSql("INSERT INTO `proofpilot`.`test_type`
                (`test_type_name`,`status_id`)
                VALUES ('eStamp4WelcomeKit',1);");
        
        $this->addSql("INSERT INTO `proofpilot`.`test_type`
                (`test_type_name`,`status_id`)
                VALUES ('eStamp4HIVWelcomeKit',1);");
        
        $this->addSql("INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` = 'eStamp4InterventionArm') ,
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'eStamp4Baseline'), 1, 0);
                INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` = 'eStamp4InterventionArm') ,
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'eStamp4Self-TestResults'), 1, 0);
                INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` = 'eStamp4InterventionArm') ,
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'eStamp4RCTFollow-Up4'), 1, 0);
                INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` = 'eStamp4InterventionArm') ,
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'eStamp4Self-TestResultsatCompletion'), 1, 0);");
                
        $this->addSql("INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` ='eStamp4ControlArm') ,
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'eStamp4Baseline'), 1, 0);
                INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` ='eStamp4ControlArm') ,
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'eStamp4ControlArmIntervention'), 1, 0);");
                
        $this->addSql("INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` ='eStamp4HIVPositiveArm') ,
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'eStamp4HIVBaseline'), 1, 0);
                INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` ='eStamp4HIVPositiveArm') ,
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'eStamp4HIVFollow-up'), 1, 0);");

           $this->addSql("ALTER TABLE `proofpilot`.`participant_survey_link` ADD COLUMN `status_id`  INT(1) UNSIGNED NULL AFTER `save_id`,
                       ADD CONSTRAINT `fk_particpant_status`
                       FOREIGN KEY (`status_id`) 
                       REFERENCES `proofpilot`.`status` (`status_id`) 
                       ON DELETE NO ACTION 
                       ON UPDATE NO ACTION;");

        $this->addSql("ALTER TABLE participant_survey_link DROP INDEX save_id_UNIQUE;");

        $this->addSql("ALTER TABLE `participant_survey_link` ADD UNIQUE KEY  `save_survey_id_UNIQUE` (`save_id`,`sid_id`);");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

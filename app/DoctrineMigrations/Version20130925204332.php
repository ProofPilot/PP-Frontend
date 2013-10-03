<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130925204332 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("ALTER TABLE adverse_reaction CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE adverse_reaction_history CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE adverse_reaction_referal CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE affinity CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE appointment CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE appointment_intervention_link CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE appointment_status CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE appointment_type CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE arm CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE arm_intervention_link CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE arm_role CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE arm_team CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE attached_file CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE campaign CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE campaign_type CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE city CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE collector_forum CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE collector_forum_specimen_phase_link CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE collector_forum_test_phase_link CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE communication_channel CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE country CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE courier CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE courier_product CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE disease CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE disease_specimen_link CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE droug CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE history CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE individual CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE individual_title CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE intervention CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE intervention_organization_link CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE intervention_type CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE language CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE location CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE location_organization_link CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE location_type CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE orders CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE organization CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE organization_individual_link CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE organization_specimen_collection_tool_link CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE organization_specimen_link CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE participant CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE participant_arm_link CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE participant_campaign_link CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE participant_communication_channel_link CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE participant_communication_log CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE participant_contact_time CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE participant_contact_time_link CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE participant_droug_link CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE participant_intervention_link CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE participant_level CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE participant_role CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE participant_study_reminder CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE participant_study_reminder_link CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE participant_survey_link CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE participant_timezone CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE placement CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE race CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE recovery_question CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE representative CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE sender CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE sex CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE sex_with CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE site CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE specimen CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE specimen_collection_tool CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE specimen_history CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE specimen_phase CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE specimen_test_link CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE state CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE status CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE study CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE study_organization_link CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE study_organization_role CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE test CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE test_history CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE test_outcome_type CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE test_phase CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE test_preliminar_result CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE test_proccesing_type CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE test_type CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE user CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
		$this->addSql("ALTER TABLE user_role_link CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

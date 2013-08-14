<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130814171639 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_arm_link` 
                DROP FOREIGN KEY `fk_participant_arm_link_participant1`;
                ALTER TABLE `proofpilot`.`participant_arm_link`  
                ADD CONSTRAINT `fk_participant_arm_link_participant1`  
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE CASCADE;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_campaign_link` 
                DROP FOREIGN KEY `fk_participant_campaign_link_participant1`;
                ALTER TABLE `proofpilot`.`participant_campaign_link`
                ADD CONSTRAINT `fk_participant_campaign_link_participant1`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE CASCADE;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_study_reminder_link`
                DROP FOREIGN KEY `FK_participant_study_reminder_link_participant`;
                ALTER TABLE `proofpilot`.`participant_study_reminder_link`
                ADD CONSTRAINT `FK_participant_study_reminder_link_participant`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE CASCADE;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_intervention_link` 
                DROP FOREIGN KEY `fk_participant_intervention_link_participant1`;
                ALTER TABLE `proofpilot`.`participant_intervention_link`
                ADD CONSTRAINT `fk_participant_intervention_link_participant1`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE CASCADE;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_survey_link` 
                DROP FOREIGN KEY `fk_participant_survey_link_participant1`;
                ALTER TABLE `proofpilot`.`participant_survey_link`
                ADD CONSTRAINT `fk_participant_survey_link_participant1`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE CASCADE;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_communication_channel_link`
                DROP FOREIGN KEY `fk_participant_communication_channel_link_participant1`;
                ALTER TABLE `proofpilot`.`participant_communication_channel_link`
                ADD CONSTRAINT `fk_participant_communication_channel_link_participant1`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE CASCADE;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_contact_time_link`
                DROP FOREIGN KEY `FK_participant_contact_time_link_participant`;
                ALTER TABLE `proofpilot`.`participant_contact_time_link`
                ADD CONSTRAINT `FK_participant_contact_time_link_participant`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE CASCADE;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_contact_weekday_link`
                DROP FOREIGN KEY `FK_patricipant_contact_weekdays_participant`;
                ALTER TABLE `proofpilot`.`participant_contact_weekday_link`
                ADD CONSTRAINT `FK_patricipant_contact_weekdays_participant`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE CASCADE;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_droug_link`
                DROP FOREIGN KEY `fk_participant_droug_link_participant1`;
                ALTER TABLE `proofpilot`.`participant_droug_link`
                ADD CONSTRAINT `fk_participant_droug_link_participant1`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE CASCADE;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_study_external_site_link`
                DROP FOREIGN KEY `fk_participant_study_external_site_link_participant1`;
                ALTER TABLE `proofpilot`.`participant_study_external_site_link`
                ADD CONSTRAINT `fk_participant_study_external_site_link_participant1`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE CASCADE;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_study_reminder_link`
                DROP FOREIGN KEY `FK_participant_study_reminder_link_participant`;
                ALTER TABLE `proofpilot`.`participant_study_reminder_link`
                ADD CONSTRAINT `FK_participant_study_reminder_link_participant`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE CASCADE;");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("ALTER TABLE `proofpilot`.`participant_arm_link` 
                DROP FOREIGN KEY `fk_participant_arm_link_participant1`;
                ALTER TABLE `proofpilot`.`participant_arm_link`  
                ADD CONSTRAINT `fk_participant_arm_link_participant1`  
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE NO ACTION;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_campaign_link` 
                DROP FOREIGN KEY `fk_participant_campaign_link_participant1`;
                ALTER TABLE `proofpilot`.`participant_campaign_link`
                ADD CONSTRAINT `fk_participant_campaign_link_participant1`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE NO ACTION;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_study_reminder_link`
                DROP FOREIGN KEY `FK_participant_study_reminder_link_participant`;
                ALTER TABLE `proofpilot`.`participant_study_reminder_link`
                ADD CONSTRAINT `FK_participant_study_reminder_link_participant`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE NO ACTION;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_intervention_link` 
                DROP FOREIGN KEY `fk_participant_intervention_link_participant1`;
                ALTER TABLE `proofpilot`.`participant_intervention_link`
                ADD CONSTRAINT `fk_participant_intervention_link_participant1`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE NO ACTION;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_survey_link` 
                DROP FOREIGN KEY `fk_participant_survey_link_participant1`;
                ALTER TABLE `proofpilot`.`participant_survey_link`
                ADD CONSTRAINT `fk_participant_survey_link_participant1`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE NO ACTION;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_communication_channel_link`
                DROP FOREIGN KEY `fk_participant_communication_channel_link_participant1`;
                ALTER TABLE `proofpilot`.`participant_communication_channel_link`
                ADD CONSTRAINT `fk_participant_communication_channel_link_participant1`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE NO ACTION;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_contact_time_link`
                DROP FOREIGN KEY `FK_participant_contact_time_link_participant`;
                ALTER TABLE `proofpilot`.`participant_contact_time_link`
                ADD CONSTRAINT `FK_participant_contact_time_link_participant`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE NO ACTION;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_contact_weekday_link`
                DROP FOREIGN KEY `FK_patricipant_contact_weekdays_participant`;
                ALTER TABLE `proofpilot`.`participant_contact_weekday_link`
                ADD CONSTRAINT `FK_patricipant_contact_weekdays_participant`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE NO ACTION;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_droug_link`
                DROP FOREIGN KEY `fk_participant_droug_link_participant1`;
                ALTER TABLE `proofpilot`.`participant_droug_link`
                ADD CONSTRAINT `fk_participant_droug_link_participant1`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE NO ACTION;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_study_external_site_link`
                DROP FOREIGN KEY `fk_participant_study_external_site_link_participant1`;
                ALTER TABLE `proofpilot`.`participant_study_external_site_link`
                ADD CONSTRAINT `fk_participant_study_external_site_link_participant1`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE NO ACTION;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_study_reminder_link`
                DROP FOREIGN KEY `FK_participant_study_reminder_link_participant`;
                ALTER TABLE `proofpilot`.`participant_study_reminder_link`
                ADD CONSTRAINT `FK_participant_study_reminder_link_participant`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE NO ACTION;");
    }
}

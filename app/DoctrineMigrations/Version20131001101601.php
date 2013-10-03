<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131001101601 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` = 'Phase3Default') , 
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KAHPhase3TestPackage'), 1, 0);
                INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` ='Phase3Default') , 
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KAHPhase3ReportResults'), 1, 0);
                INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`) VALUES (
                (SELECT `arm_id` FROM `proofpilot`.`arm` WHERE `arm_code` ='Phase3Default') , 
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KAHPhase3FollowUp'), 1, 0);
                UPDATE `proofpilot`.`arm_intervention_link` SET `arm_intervention_link_first_study_task` = 1 WHERE `arm_intervention_link`= 
                (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_code` = 'KAHPhase3Baseline');");

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

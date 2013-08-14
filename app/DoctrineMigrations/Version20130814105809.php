<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130814105809 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`intervention` MODIFY `intervention_name` VARCHAR(100);");
        $this->addSql("INSERT INTO `proofpilot`.`intervention`(`language_id`,`intervention_name`,`intervention_type_id`, `intervention_url`, `sid_id`, `intervention_response_url`, `status_id`) VALUES (1, 'SexPro 3 Month Follow-up Survey', 2, NULL, NULL, NULL, 1);");
        $this->addSql("INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`) VALUES (8, (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_name`='SexPro Baseline Survey') , 1);");
        $this->addSql("INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`) VALUES (8, (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_name`='SexPro 3 Month Follow-up Survey'), 1);");
        $this->addSql("INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`) VALUES (8, (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_name`='SexPro Activity'), 1);");
        $this->addSql("INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`) VALUES (9, (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_name`='SexPro Baseline Survey'), 1);");
        $this->addSql("INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`) VALUES (9, (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_name`='SexPro Activity'), 1);");
        $this->addSql("INSERT INTO `proofpilot`.`arm_intervention_link`(`arm_id`,`intervention_id`,`status_id`) VALUES (9, (SELECT `intervention_id` FROM `proofpilot`.`intervention` WHERE `intervention_name`='SexPro 3 Month Follow-up Survey'), 1);");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`intervention` MODIFY `intervention_name` VARCHAR(45);");
    }
}

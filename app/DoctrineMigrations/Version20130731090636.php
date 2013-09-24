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
class Version20130731090636 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("       
        CREATE  TABLE `proofpilot`.`participant_contact_weekday_link` (
                `participant_contact_weekday_link_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
                `participant_id` INT(11) UNSIGNED NULL ,
                `weekday_id` INT(11) UNSIGNED NULL ,
                PRIMARY KEY (`participant_contact_weekday_link_id`) ,
                INDEX `FK_patricipant_contact_weekdays_participant_idx` (`participant_id` ASC) ,
                CONSTRAINT `FK_patricipant_contact_weekdays_participant`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE NO ACTION
            ON UPDATE NO ACTION);");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_contact_time_link` DROP COLUMN `participant_day_of_week`;
                ");
    }

    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("DROP  TABLE IF EXISTS `proofpilot`.`participant_study_reminder_link`");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_contact_time_link` ADD COLUMN `participant_day_of_week` INT(11) UNSIGNED NULL  AFTER `participant_timezone`;
                ");

    }
}

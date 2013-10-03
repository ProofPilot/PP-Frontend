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
class Version20130906174814 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("DELETE FROM `proofpilot`.`participant_contact_time_link`;
                      ALTER TABLE `proofpilot`.`participant_contact_time_link` DROP FOREIGN KEY `participant_contact_time_link_ibfk_4` ;
                       ALTER TABLE `proofpilot`.`participant_contact_time_link` CHANGE COLUMN `server_contact_time` `server_contact_time` INT(10) UNSIGNED NOT NULL  , CHANGE COLUMN `server_weekday` `server_weekday` INT(11) NOT NULL  , CHANGE COLUMN `participant_weekday` `participant_weekday` INT(11) NOT NULL  , 
                      ADD CONSTRAINT `participant_contact_time_link_ibfk_4`
                      FOREIGN KEY (`server_contact_time` )
                      REFERENCES `proofpilot`.`participant_contact_time` (`participant_contact_times_id` )
                      ON DELETE NO ACTION
                      ON UPDATE NO ACTION;");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

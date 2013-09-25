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
class Version20130912155313 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`participant`CHANGE COLUMN `facebookId` `participant_facebook_id` varchar(255) NULL;
                       ALTER TABLE `proofpilot`.`participant`CHANGE COLUMN `googleId` `participant_google_id` varchar(255) NULL;
                       ALTER TABLE `proofpilot`.`participant`CHANGE COLUMN `education` `participant_education` varchar(255) NULL;
                       ALTER TABLE `proofpilot`.`participant`CHANGE COLUMN `income` `participant_income` int(10) NULL;
                       ALTER TABLE `proofpilot`.`participant`CHANGE COLUMN `age` `participant_age`  int(10) NULL;
                       ALTER TABLE `proofpilot`.`participant`CHANGE COLUMN `location` `participant_location`  varchar(255) NULL;
                       ALTER TABLE `proofpilot`.`participant`CHANGE COLUMN `language` `participant_locale`  varchar(255) NOT NULL DEFAULT 'en';
                       ALTER TABLE `proofpilot`.`participant`CHANGE COLUMN `voice_phone` `participant_voice_phone`  int(10) NULL;
                       ALTER TABLE `proofpilot`.`participant`CHANGE COLUMN `recovery_password_code` `participant_recovery_password_code`  varchar(45) NOT NULL DEFAULT 'Default';");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`participant`CHANGE COLUMN `participant_facebook_id` `facebookId`  varchar(255) NULL;
                ALTER TABLE `proofpilot`.`participant`CHANGE COLUMN `participant_google_id` `googleId` varchar(255) NULL;
                ALTER TABLE `proofpilot`.`participant`CHANGE COLUMN `participant_education` `education` varchar(255) NULL;
                ALTER TABLE `proofpilot`.`participant`CHANGE COLUMN `participant_income` `income` int(10) NULL;
                ALTER TABLE `proofpilot`.`participant`CHANGE COLUMN `participant_age` age`  int(10) NULL;
                ALTER TABLE `proofpilot`.`participant`CHANGE COLUMN `participant_location`  `location` `varchar(255) NULL;
                ALTER TABLE `proofpilot`.`participant`CHANGE COLUMN `participant_locale` `language`  varchar(255) NOT NULL DEFAULT 'en';
                ALTER TABLE `proofpilot`.`participant`CHANGE COLUMN `participant_voice_phone` `voice_phone` int(10) NULL;
                ALTER TABLE `proofpilot`.`participant`CHANGE COLUMN `participant_recovery_password_code` `recovery_password_code` varchar(45) NOT NULL DEFAULT 'Default';");
    }
}

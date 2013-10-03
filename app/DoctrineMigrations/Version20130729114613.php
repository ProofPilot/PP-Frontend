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
class Version20130729114613 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("CREATE TABLE `proofpilot`.`participant_study_reminder_link` (
                      `participant_study_reminder_link_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                      `participant_id` int(11) unsigned NOT NULL,
                      `participant_study_reminder_id` int(11) unsigned NOT NULL,
                      `by_sms` tinyint(4) NOT NULL,
                      `by_email` tinyint(4) NOT NULL,
                      PRIMARY KEY (`participant_study_reminder_link_id`),
                      KEY `FK_participant_study_reminder_link_study_reminder_idx` (`participant_study_reminder_id`),
                      KEY `FK_participant_study_reminder_link_participant_idx` (`participant_id`),
                      CONSTRAINT `FK_participant_study_reminder_link_participant` FOREIGN KEY (`participant_id`) REFERENCES `proofpilot`.`participant` (`participant_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
                      CONSTRAINT `FK_participant_study_reminder_link_study_reminder` FOREIGN KEY (`participant_study_reminder_id`) REFERENCES `proofpilot`.`participant_study_reminder` (`participant_study_reminder_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1");
        
        }
        
        public function down(Schema $schema)
        {
            $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
            $this->addSql("DROP  TABLE IF EXISTS `proofpilot`.`participant_study_reminder_link`");
        
        }
}

<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130729114215 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("CREATE TABLE `proofpilot`.`participant_contact_time_link` (
                      `participant_contact_time_link_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                      `participant_contact_time` int(11) unsigned NOT NULL,
                      `participant_contact_time_start` datetime NOT NULL,
                      `participant_contact_time_end` datetime NOT NULL,
                      `participant_timezone` int(11) unsigned NOT NULL,
                      `participant_day_of_week` int(11) unsigned NOT NULL,
                      `participant_id` int(11) unsigned NOT NULL,
                      PRIMARY KEY (`participant_contact_time_link_id`),
                      KEY `FK_participant_contact_time_link_contact_time_idx` (`participant_contact_time`),
                      KEY `FK_participant_contact_time_link_participant_idx` (`participant_id`),
                      KEY `FL_participant_contact_time_link_timezone_idx` (`participant_timezone`),
                      CONSTRAINT `FL_participant_contact_time_link_timezone` FOREIGN KEY (`participant_timezone`) REFERENCES `proofpilot`.`participant_timezone` (`participant_timezone_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
                      CONSTRAINT `FK_participant_contact_time_link_contact_time` FOREIGN KEY (`participant_contact_time`) REFERENCES `proofpilot`.`participant_contact_time` (`participant_contact_times_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
                      CONSTRAINT `FK_participant_contact_time_link_participant` FOREIGN KEY (`participant_id`) REFERENCES `proofpilot`.`participant` (`participant_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
                        ) ENGINE=InnoDB DEFAULT CHARSET=latin1");
        
        }
        
        public function down(Schema $schema)
        {
            $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
            $this->addSql("DROP  TABLE IF EXISTS `proofpilot`.`participant_contact_time_link`");
        
        }
}

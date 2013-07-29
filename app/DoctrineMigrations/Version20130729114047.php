<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130729114047 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("CREATE TABLE `proofpilot`.`participant_contact_time` (
                      `participant_contact_times_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                      `participant_contact_times_name` varchar(45) DEFAULT NULL,
                       PRIMARY KEY (`participant_contact_times_id`)
                       ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1");
        
        }
        
        public function down(Schema $schema)
        {
            $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
            $this->addSql("DROP  TABLE IF EXISTS `proofpilot`.`participant_contact_time`");
        
        }
}

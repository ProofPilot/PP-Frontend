<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130729113734 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("CREATE TABLE `proofpilot`.`participant_timezone` (
                `participant_timezone_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                `participant_timezone_desc` varchar(45) DEFAULT NULL,
                PRIMARY KEY (`participant_timezone_id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1");

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("DROP  TABLE IF EXISTS `proofpilot`.`participant_timezone`");
    }
}

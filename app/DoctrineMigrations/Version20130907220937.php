<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130907220937 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("
                ALTER TABLE `proofpilot`.`participant_contact_time_link` DROP FOREIGN KEY `participant_contact_time_link_ibfk_4` ;
                ALTER TABLE `proofpilot`.`participant_contact_time_link` DROP COLUMN `server_weekday` , DROP COLUMN `server_contact_time` 
                , DROP INDEX `FK_server_contact_time_link_contact_time_idx` ;
                
                ");

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

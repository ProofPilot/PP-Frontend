<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130828205802 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_campaign_link` DROP FOREIGN KEY `participant_campaign_link_ibfk_1` ;
        ALTER TABLE `proofpilot`.`participant_campaign_link` CHANGE COLUMN `site_id` `site_id` INT(10) UNSIGNED NULL  ,
        ADD CONSTRAINT `participant_campaign_link_ibfk_1`
        FOREIGN KEY (`site_id` )
        REFERENCES `proofpilot`.`site` (`site_id` )
        ON DELETE NO ACTION
        ON UPDATE NO ACTION;");
        
        
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("
        ALTER TABLE `proofpilot`.`participant_campaign_link` DROP FOREIGN KEY `participant_campaign_link_ibfk_1` ;
        ALTER TABLE `proofpilot`.`participant_campaign_link` CHANGE COLUMN `site_id` `site_id` INT(10) UNSIGNED NOT NULL  ,
        ADD CONSTRAINT `participant_campaign_link_ibfk_1`
        FOREIGN KEY (`site_id` )
        REFERENCES `proofpilot`.`site` (`site_id` )
        ON DELETE NO ACTION
        ON UPDATE NO ACTION;");
    }
}

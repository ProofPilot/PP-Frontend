<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140129152609 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `new-proofpilot`.`participant_campaign_link` ADD COLUMN `campaign_site_link_id` INT(10) UNSIGNED NULL,
                       ADD CONSTRAINT `fk_participant_campaign_site_link`
                       FOREIGN KEY (`campaign_site_link_id`) 
                       REFERENCES `new-proofpilot`.`campaign_site_link` (`campaign_site_link_id`) 
                       ON DELETE NO ACTION 
                       ON UPDATE NO ACTION;");
        
        $this->addSql("UPDATE `new-proofpilot`.`participant_campaign_link`
        INNER JOIN `campaign_site_link` on `campaign_site_link`.`campaign_id` =  `participant_campaign_link`.`campaign_id`
        AND  `campaign_site_link`.`site_id` = `participant_campaign_link`.`site_id`
        SET `participant_campaign_link`.`campaign_site_link_id` = `campaign_site_link`.`campaign_site_link_id`");
        

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

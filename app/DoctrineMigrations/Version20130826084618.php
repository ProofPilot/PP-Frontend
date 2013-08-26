<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130826084618 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs

    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("ALTER TABLE `proofpilot`.`participant_campaign_link` ADD COLUMN `site_id` INT(10) UNSIGNED NOT NULL  AFTER `participant_survey_link_uniqid` ,
    	ADD CONSTRAINT `fk_participant_campaign_link_site1`
    	FOREIGN KEY (`site_id` )
    	REFERENCES `proofpilot`.`site` (`site_id` )
    	ON DELETE NO ACTION
    	ON UPDATE NO ACTION
    	, ADD INDEX `fk_participant_campaign_link_site1_idx` (`site_id` ASC)");
    	     	
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    }
}

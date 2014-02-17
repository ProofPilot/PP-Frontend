<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140214183251 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("
    			ALTER TABLE `new-proofpilot`.`study_content` 
				ADD COLUMN `study_join_facebook_button` VARCHAR(45) NULL AFTER `study_join_button_name`,
				ADD COLUMN `study_join_google_button` VARCHAR(45) NULL AFTER `study_join_facebook_button`,
				ADD COLUMN `study_prelaunch_message` VARCHAR(45) NULL AFTER `study_join_google_button`;
    			");

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("
    			ALTER TABLE `new-proofpilot`.`study_content` 
				DROP COLUMN `study_prelaunch_message`,
				DROP COLUMN `study_join_google_button`,
				DROP COLUMN `study_join_facebook_button`;
    			");

    }
}

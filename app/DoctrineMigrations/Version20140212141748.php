<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140212141748 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("
	    				ALTER TABLE `new-proofpilot`.`study_content` 
						ADD COLUMN `study_specific_login_header` VARCHAR(255) NULL AFTER `study_sponsor_by`,
						ADD COLUMN `study_join_button_name` VARCHAR(45) NULL AFTER `study_specific_login_header`;
    				");

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("
		    			ALTER TABLE `new-proofpilot`.`study_content` 
						DROP COLUMN `study_join_button_name`,
						DROP COLUMN `study_specific_login_header`;
    				");

    }
}

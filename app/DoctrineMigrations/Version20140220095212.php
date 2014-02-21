<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140220095212 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("CREATE TABLE study_criteria (
				      	study_id INT UNSIGNED NOT NULL ,
				    	study_criteria_json BLOB NULL ,
				    	PRIMARY KEY (study_id) ,
				    	INDEX fk_study_criteria_study1_idx (study_id ASC) ,
				    	CONSTRAINT fk_study_criteria_study1
				    	FOREIGN KEY (study_id )
				    	REFERENCES study (study_id )
				    	ON DELETE NO ACTION
				    	ON UPDATE NO ACTION)
				    	ENGINE = InnoDB
    					DEFAULT CHARACTER SET = utf8
						COLLATE = utf8_general_ci");
    	
    	
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("DROP TABLE study_criteria");
    }
}

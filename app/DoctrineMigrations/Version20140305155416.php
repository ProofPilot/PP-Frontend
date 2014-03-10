<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140305155416 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("ALTER TABLE intervention_type 
    					ADD COLUMN intervention_type_logo VARCHAR(145) NULL DEFAULT NULL  AFTER intervention_type_name , 
    					ADD COLUMN intervention_type_desc VARCHAR(500) NULL DEFAULT NULL  AFTER intervention_type_logo,
    					ADD COLUMN intervention_type_price FLOAT NULL DEFAULT 0 AFTER intervention_type_desc");
    	
    	$this->addSql("CREATE TABLE IF NOT EXISTS study_intervention_type_link (
						  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
						  intervention_type_id INT(10) UNSIGNED NOT NULL ,
						  study_id INT(10) UNSIGNED NOT NULL ,
						  PRIMARY KEY (id) ,
						  INDEX fk_study_intervention_type_link_intervention_type1_idx (intervention_type_id ASC) ,
						  INDEX fk_study_intervention_type_link_study1_idx (study_id ASC) ,
						  CONSTRAINT fk_study_intervention_type_link_intervention_type1
						    FOREIGN KEY (intervention_type_id )
						    REFERENCES intervention_type (intervention_type_id )
						    ON DELETE NO ACTION
						    ON UPDATE NO ACTION,
						  CONSTRAINT fk_study_intervention_type_link_study1
						    FOREIGN KEY (study_id )
						    REFERENCES study (study_id )
						    ON DELETE NO ACTION
						    ON UPDATE NO ACTION)
						ENGINE = InnoDB
						DEFAULT CHARACTER SET = utf8
						COLLATE = utf8_general_ci");
    	
    	$this->addSql("INSERT INTO study_intervention_type_link (intervention_type_id, study_id) SELECT intervention_type_id, study_id FROM intervention GROUP BY intervention_type_id, study_id");
    	 
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("ALTER TABLE intervention_type
    					DROP COLUMN intervention_type_logo,
    					DROP COLUMN intervention_type_desc,
    					DROP COLUMN intervention_type_price");
    	
    	$this->addSql("DROP TABLE study_intervention_type_link");
    }
}

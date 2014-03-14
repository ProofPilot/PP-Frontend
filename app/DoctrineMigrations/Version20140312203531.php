<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140312203531 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	
    	$this->addSql("CREATE  TABLE IF NOT EXISTS intervention_forum (
						  intervention_forum_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
						  intervention_forum_name VARCHAR(45) NULL DEFAULT NULL ,
						  status_id INT(10) UNSIGNED NOT NULL ,
						  PRIMARY KEY (intervention_forum_id) ,
						  INDEX fk_intervention_forum_status1_idx (status_id ASC) ,
						  CONSTRAINT fk_intervention_forum_status1
						    FOREIGN KEY (status_id )
						    REFERENCES status (status_id )
						    ON DELETE NO ACTION
						    ON UPDATE NO ACTION)
						ENGINE = InnoDB
						DEFAULT CHARACTER SET = utf8
						COLLATE = utf8_general_ci");

    	$this->addSql("INSERT INTO intervention_forum (intervention_forum_id, intervention_forum_name, status_id) VALUES (1, 'Participant Dashboard (home)', 1), (2, 'Study Visit (clinic)', 1), (3, 'Admin Task (participant related)', 1), (4, 'Admin Task', 1), (5, 'Lab', 1)");    	

    	$this->addSql("CREATE  TABLE IF NOT EXISTS intervention_visit (
						  intervention_visit_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
						  intervention_visit_name VARCHAR(45) NULL DEFAULT NULL ,
						  status_id INT(10) UNSIGNED NOT NULL ,
						  study_id INT(10) UNSIGNED NOT NULL ,
						  PRIMARY KEY (intervention_visit_id) ,
						  INDEX fk_intervention_visit_status1_idx (status_id ASC) ,
						  INDEX fk_intervention_visit_study1_idx (study_id ASC) ,
						  CONSTRAINT fk_intervention_visit_status1
						    FOREIGN KEY (status_id )
						    REFERENCES status (status_id )
						    ON DELETE NO ACTION
						    ON UPDATE NO ACTION,
						  CONSTRAINT fk_intervention_visit_study1
						    FOREIGN KEY (study_id )
						    REFERENCES study (study_id )
						    ON DELETE NO ACTION
						    ON UPDATE NO ACTION)
						ENGINE = InnoDB
						DEFAULT CHARACTER SET = utf8
						COLLATE = utf8_general_ci");
    	
    	$this->addSql("ALTER TABLE intervention ADD COLUMN intervention_notes VARCHAR(2000) NULL DEFAULT NULL  AFTER intervention_incentive_amount , 
    					ADD COLUMN intervention_forum_id INT(10) UNSIGNED NULL  AFTER intervention_notes , 
    					ADD COLUMN intervention_visit_id INT(10) UNSIGNED NULL  AFTER intervention_forum_id ,
						  ADD CONSTRAINT fk_intervention_intervention_forum1
						  FOREIGN KEY (intervention_forum_id )
						  REFERENCES intervention_forum (intervention_forum_id )
						  ON DELETE NO ACTION
						  ON UPDATE NO ACTION,
						  ADD CONSTRAINT fk_intervention_intervention_visit1
						  FOREIGN KEY (intervention_visit_id )
						  REFERENCES intervention_visit (intervention_visit_id )
						  ON DELETE NO ACTION
						  ON UPDATE NO ACTION
						, ADD INDEX fk_intervention_intervention_forum1_idx (intervention_forum_id ASC)
						, ADD INDEX fk_intervention_intervention_visit1_idx (intervention_visit_id ASC)");
    	
    	$this->addSql("UPDATE intervention SET intervention_forum_id = '1'");
    	
    	
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	
    	$this->addSql("ALTER TABLE intervention DROP COLUMN intervention_notes");
    	$this->addSql("ALTER TABLE intervention DROP COLUMN intervention_forum_id");
    	$this->addSql("ALTER TABLE intervention DROP COLUMN intervention_visit_id");
    	$this->addSql("DROP TABLE intervention_forum");
    	$this->addSql("DROP TABLE intervention_visit");
    	
    }
}

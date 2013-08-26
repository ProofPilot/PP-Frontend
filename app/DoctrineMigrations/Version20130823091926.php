<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130823091926 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("ALTER TABLE intervention ADD COLUMN study_id INT(10) UNSIGNED NOT NULL AFTER intervention_code");
    	
    	//Adding the current StudyId before to set the Constraint
    	
    	$this->addSql("update intervention set study_id = '2' where intervention_id = '3'");
    	$this->addSql("update intervention set study_id = '1' where intervention_id = '4'");
    	$this->addSql("update intervention set study_id = '7' where intervention_id = '7'");
    	$this->addSql("update intervention set study_id = '7' where intervention_id = '7'");
    	$this->addSql("update intervention set study_id = '8' where intervention_id = '10'");
    	$this->addSql("update intervention set study_id = '2' where intervention_id = '16'");
    	$this->addSql("update intervention set study_id = '2' where intervention_id = '1'");
    	$this->addSql("update intervention set study_id = '1' where intervention_id = '2'");
    	$this->addSql("update intervention set study_id = '2' where intervention_id = '5'");
    	$this->addSql("update intervention set study_id = '7' where intervention_id = '6'");
    	$this->addSql("update intervention set study_id = '7' where intervention_id = '6'");
    	$this->addSql("update intervention set study_id = '7' where intervention_id = '8'");
    	$this->addSql("update intervention set study_id = '7' where intervention_id = '8'");
    	$this->addSql("update intervention set study_id = '12' where intervention_id = '9'");
    	$this->addSql("update intervention set study_id = '8' where intervention_id = '11'");
    	$this->addSql("update intervention set study_id = '8' where intervention_id = '11'");
    	$this->addSql("update intervention set study_id = '8' where intervention_id = '12'");
    	$this->addSql("update intervention set study_id = '8' where intervention_id = '12'");
    	$this->addSql("update intervention set study_id = '8' where intervention_id = '13'");
    	$this->addSql("update intervention set study_id = '8' where intervention_id = '13'");
    	$this->addSql("update intervention set study_id = '8' where intervention_id = '14'");
    	$this->addSql("update intervention set study_id = '8' where intervention_id = '14'");
    	$this->addSql("update intervention set study_id = '6' where intervention_id = '15'");

    	$this->addSql("ALTER TABLE intervention ADD CONSTRAINT fk_intervention_study1 FOREIGN KEY (study_id ) 
    				   REFERENCES proofpilot.study (study_id )
    				   ON DELETE NO ACTION ON UPDATE NO ACTION,
    				   ADD INDEX fk_intervention_study1_idx (study_id ASC)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    }
}

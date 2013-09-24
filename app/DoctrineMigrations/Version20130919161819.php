<?php
/*
 * This is part of the ProofPilot package.
*
* (c)2012-2013 Cyclogram, Inc, West Hollywood, CA <crew@proofpilot.com>
* ALL RIGHTS RESERVED
*
* This software is provided by the copyright holders to Manila Consulting for use on the
* Center for Disease Control's Evaluation of Rapid HIV Self-Testing among MSM in High
* Prevalence Cities until 2016 or the project is completed.
*
* Any unauthorized use, modification or resale is not permitted without expressed permission
* from the copyright holders.
*
* KnowatHome branding, URL, study logic, survey instruments, and resulting data are not part
* of this copyright and remain the property of the prime contractor.
*
*/
namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130919161819 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("ALTER TABLE proofpilot.participant CHANGE COLUMN participant_incentive_balance participant_incentive_balance FLOAT(10) UNSIGNED NOT NULL DEFAULT 0");
    	$this->addSql("ALTER TABLE proofpilot.intervention ADD COLUMN intervention_incentive_amount FLOAT(10) UNSIGNED NOT NULL DEFAULT 0  AFTER study_id");
    	
    	$this->addSql("CREATE  TABLE IF NOT EXISTS proofpilot.incentive_type (
		  incentive_type_id INT UNSIGNED NOT NULL AUTO_INCREMENT ,
		  incentive_type_name VARCHAR(145) NOT NULL ,
		  status_id INT UNSIGNED NOT NULL ,
		  PRIMARY KEY (incentive_type_id) ,
		  INDEX fk_incentive_type_status1_idx (status_id ASC) ,
		  CONSTRAINT fk_incentive_type_status1
		    FOREIGN KEY (status_id )
		    REFERENCES proofpilot.status (status_id )
		    ON DELETE NO ACTION
		    ON UPDATE NO ACTION)
		ENGINE = InnoDB");
    	
    	$this->addSql("CREATE  TABLE IF NOT EXISTS proofpilot.incentive (
		  incentive_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
		  participant_id INT UNSIGNED NOT NULL ,
		  incentive_datetime DATETIME NOT NULL ,
		  incentive_datetime_approved DATETIME NULL ,
		  incentive_datetime_processed DATETIME NULL ,
		  incentive_amount FLOAT UNSIGNED NOT NULL DEFAULT 0 ,
		  fulfillment_by VARCHAR(255) NULL ,
		  fulfillment_confirmation_number VARCHAR(45) NULL ,
		  incentive_type_id INT UNSIGNED NOT NULL ,
		  status_id INT UNSIGNED NOT NULL ,
		  intervention_intervention_id INT UNSIGNED NOT NULL ,
		  intervention_language_id INT UNSIGNED NOT NULL ,
		  PRIMARY KEY (incentive_id) ,
		  INDEX fk_incentive_incentive_type1_idx (incentive_type_id ASC) ,
		  INDEX fk_incentive_status1_idx (status_id ASC) ,
		  INDEX fk_incentive_participant1_idx (participant_id ASC) ,
		  INDEX fk_incentive_intervention1_idx (intervention_intervention_id ASC, intervention_language_id ASC) ,
		  CONSTRAINT fk_incentive_incentive_type1
		    FOREIGN KEY (incentive_type_id )
		    REFERENCES proofpilot.incentive_type (incentive_type_id )
		    ON DELETE NO ACTION
		    ON UPDATE NO ACTION,
		  CONSTRAINT fk_incentive_status1
		    FOREIGN KEY (status_id )
		    REFERENCES proofpilot.status (status_id )
		    ON DELETE NO ACTION
		    ON UPDATE NO ACTION,
		  CONSTRAINT fk_incentive_participant1
		    FOREIGN KEY (participant_id )
		    REFERENCES proofpilot.participant (participant_id )
		    ON DELETE NO ACTION
		    ON UPDATE NO ACTION,
		  CONSTRAINT fk_incentive_intervention1
		    FOREIGN KEY (intervention_intervention_id , intervention_language_id )
		    REFERENCES proofpilot.intervention (intervention_id , language_id )
		    ON DELETE NO ACTION
		    ON UPDATE NO ACTION)
		ENGINE = InnoDB");
    	
    	$this->addSql("INSERT INTO status (status_id, status_name) VALUES (25, 'Pending Approval'), (26, 'Aprooved'), (27, 'Proccesed')");
    	$this->addSql("INSERT INTO incentive_type (incentive_type_id, incentive_type_name, status_id) VALUES (1, 'Amazon Gift Card', 1), (2, 'Paypal Gift Card', 1), (3, 'iTunes Gift Card', 1)");
    	 
    	
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    	$this->addSql("ALTER TABLE proofpilot.participant CHANGE COLUMN participant_incentive_balance participant_incentive_balance FLOAT(10) NOT NULL DEFAULT 0");
    	$this->addSql("ALTER TABLE proofpilot.intervention DROP COLUMN intervention_incentive_amount");
    	$this->addSql("DROP TABLE proofpilot.incentive");
    	$this->addSql("DROP TABLE proofpilot.incentive_type");
    	$this->addSql("DELETE FROM status WHERE status_id IN (25,26,27)");

    }
}

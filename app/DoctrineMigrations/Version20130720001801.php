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
class Version20130720001801 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
		$this->addSql("ALTER TABLE proofpilot.stydy_survey_link CHANGE COLUMN stydy_survey_link_id study_survey_link_id BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT, 
						ADD COLUMN study_survey_link_is_elegible SMALLINT(5) UNSIGNED NULL DEFAULT 0  AFTER survey_qid_name , 
						RENAME TO  proofpilot.study_survey_link");
		
		$this->addSql("ALTER TABLE proofpilot.participant_survey_link ADD COLUMN participant_survey_link_elegibility SMALLINT(1) UNSIGNED NULL DEFAULT 0  AFTER participant_survey_link_uniqid");
		
		$this->addSql("CREATE  TABLE IF NOT EXISTS proofpilot.study_language (
		  study_language_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
		  study_id INT(10) UNSIGNED NOT NULL ,
		  language_id INT(10) UNSIGNED NOT NULL ,
		  PRIMARY KEY (study_language_id) ,
		  INDEX fk_study_language_study1_idx (study_id ASC) ,
		  INDEX fk_study_language_language1_idx (language_id ASC) ,
		  CONSTRAINT fk_study_language_study1
		    FOREIGN KEY (study_id )
		    REFERENCES proofpilot.study (study_id )
		    ON DELETE NO ACTION
		    ON UPDATE NO ACTION,
		  CONSTRAINT fk_study_language_language1
		    FOREIGN KEY (language_id )
		    REFERENCES proofpilot.language (language_id )
		    ON DELETE NO ACTION
		    ON UPDATE NO ACTION)
		ENGINE = InnoDB");

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE DROP COLUMN study_survey_link_is_elegible, 
						RENAME TO  proofpilot.stydy_survey_link");
        $this->addSql("ALTER TABLE proofpilot.participant_survey_link DROP COLUMN participant_survey_link_elegibility");
        $this->addSql("DROP TABLE proofpilot.study_language");
    }
}

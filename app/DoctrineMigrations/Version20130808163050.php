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
class Version20130808163050 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("CREATE TABLE proofpilot.participant_study_external_site_link ( participant_study_external_site_link_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, participant_id INT(10) UNSIGNED NOT NULL, study_id INT(10) UNSIGNED NOT NULL, external_site_userid VARCHAR(255) NULL DEFAULT NULL, PRIMARY KEY (participant_study_external_site_link_id), INDEX fk_participant_study_external_site_link_participant1_idx (participant_id ASC), INDEX fk_participant_study_external_site_link_study1_idx (study_id ASC), CONSTRAINT fk_participant_study_external_site_link_participant1 FOREIGN KEY (participant_id ) REFERENCES proofpilot.participant (participant_id ) ON DELETE NO ACTION ON UPDATE NO ACTION, CONSTRAINT fk_participant_study_external_site_link_study1 FOREIGN KEY (study_id ) REFERENCES proofpilot.study (study_id ) ON DELETE NO ACTION ON UPDATE NO ACTION) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8");
    	
    	
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("DROP TABLE proofpilot.participant_study_external_site_link");
    	 
    }
}

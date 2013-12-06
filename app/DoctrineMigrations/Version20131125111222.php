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

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131125111222 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("CREATE TABLE IF NOT EXISTS proofpilot.participant_queue (
						  participant_queue_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
						  participant_id INT UNSIGNED NOT NULL,
						  participant_queue_date DATETIME NOT NULL,
						  participant_queue_type_id SMALLINT UNSIGNED NOT NULL DEFAULT 0,
						  PRIMARY KEY (participant_queue_id),
						  INDEX fk_participant_queue_participant1_idx (participant_id ASC),
						  CONSTRAINT fk_participant_queue_participant1
						    FOREIGN KEY (participant_id)
						    REFERENCES proofpilot.participant (participant_id)
						    ON DELETE NO ACTION
						    ON UPDATE NO ACTION)
						ENGINE = InnoDB");

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

    }
}

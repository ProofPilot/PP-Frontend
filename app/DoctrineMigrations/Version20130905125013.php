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
class Version20130905125013 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("ALTER TABLE proofpilot.participant_contact_time ADD COLUMN participant_contact_times_range_start time NULL AFTER participant_contact_times_name;
    	         ALTER TABLE proofpilot.participant_contact_time ADD COLUMN participant_contact_times_range_end time NULL AFTER participant_contact_times_range_start;");
    	        $this->addSql("UPDATE proofpilot.participant_contact_time SET participant_contact_times_range_start = '05:00:00', participant_contact_times_range_end = '08:00:00' WHERE participant_contact_times_id=1;
    	                UPDATE proofpilot.participant_contact_time SET participant_contact_times_range_start = '08:00:00', participant_contact_times_range_end = '12:00:00' WHERE participant_contact_times_id=2;
    	                UPDATE proofpilot.participant_contact_time SET participant_contact_times_range_start = '12:00:00', participant_contact_times_range_end = '17:00:00' WHERE participant_contact_times_id=3;
    	                UPDATE proofpilot.participant_contact_time SET participant_contact_times_range_start = '17:00:00', participant_contact_times_range_end = '21:00:00' WHERE participant_contact_times_id=4;
    	                UPDATE proofpilot.participant_contact_time SET participant_contact_times_range_start = '21:00:00', participant_contact_times_range_end = '24:00:00' WHERE participant_contact_times_id=5;
    	                UPDATE proofpilot.participant_contact_time SET participant_contact_times_range_start = '24:00:00', participant_contact_times_range_end = '05:00:00' WHERE participant_contact_times_id=6;");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("ALTER TABLE proofpilot.participant_contact_time DROP COLUMN participant_contact_times_range_start;
    	               ALTER TABLE proofpilot.participant_contact_time DROP COLUMN participant_contact_times_range_end");
    }
}

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
class Version20130815163034 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("UPDATE `proofpilot`.`intervention` 
                SET `intervention_url`='http://limesurvey.dev1.proofpilot.net/index.php/survey/index/sid/865791/lang/en', 
                `sid_id`='865791' WHERE `intervention_name`='SexPro Baseline Survey' and`language_id`='1';");
        $this->addSql("UPDATE `proofpilot`.`intervention` SET `intervention_url`='http://sexprodev.dev1.proofpilot.net/' 
                WHERE `intervention_name`='SexPro Activity' and`language_id`='1'");
    }

    public function down(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

    }
}

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
class Version20130711112246 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("CREATE  TABLE IF NOT EXISTS `proofpilot`.`version` (
                          `version_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
                          `version_app` VARCHAR(50) NOT NULL ,
                          `version_number` SMALLINT(6) NOT NULL ,
                          PRIMARY KEY (`version_id`) )
                        ENGINE = InnoDB
                        DEFAULT CHARACTER SET = latin1
                        COLLATE = latin1_swedish_ci");

    }

    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("DROP  TABLE IF EXISTS `proofpilot`.`version`");

    }
}

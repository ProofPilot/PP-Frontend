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
class Version20130710235611 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("ALTER TABLE `proofpilot`.`intervention` ADD COLUMN `language_id` INT(10) UNSIGNED NOT NULL DEFAULT 1 AFTER `intervention_id`
        ,ADD CONSTRAINT `fk_intervention_language1`
          FOREIGN KEY (`language_id` )
          REFERENCES `proofpilot`.`language` (`language_id` )
          ON DELETE NO ACTION
          ON UPDATE NO ACTION
        , DROP PRIMARY KEY 
        , ADD PRIMARY KEY (`intervention_id`, `language_id`)
        , ADD INDEX `fk_intervention_language1_idx` (`language_id` ASC) ");
    }

    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("ALTER TABLE `proofpilot`.`intervention` DROP FOREIGN KEY `fk_intervention_language1`;
        ALTER TABLE `proofpilot`.`intervention` DROP COLUMN `language_id`
        , DROP PRIMARY KEY
        , ADD PRIMARY KEY (`intervention_id`)
        , DROP INDEX `fk_intervention_language1_idx`;");

    }
}

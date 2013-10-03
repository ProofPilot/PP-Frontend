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
class Version20130812143458 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("CREATE  TABLE `proofpilot`.`static_blocks` (
                `block_id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
                `block_name` VARCHAR(45) NULL ,
                `language` INT UNSIGNED NOT NULL ,
                `block_content` TEXT NULL ,
                KEY(`block_id`) ,
                PRIMARY KEY (`block_name`, `language`) ,
                INDEX `fk_static_blocks_languages_idx` (`language` ASC) ,
                CONSTRAINT `fk_static_blocks_languages`
                FOREIGN KEY (`language` )
                REFERENCES `proofpilot`.`language` (`language_id` )
                ON DELETE NO ACTION
            ON UPDATE NO ACTION);");
    }

    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("DROP  TABLE IF EXISTS `proofpilot`.`static_blocks`");

    }
}

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
class Version20130808181045 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`participant` ADD COLUMN `education`  varchar(255) NULL AFTER `city`,
                                                              ADD COLUMN `income`  int(10) NULL AFTER `education`,
                                                              ADD COLUMN `age`  int(10) NULL AFTER `income`,
                                                              MODIFY COLUMN `country_id`  int(10) UNSIGNED NULL AFTER `participant_zipcode`,
                                                              MODIFY COLUMN `state_id`  int(10) UNSIGNED NULL AFTER `country_id`,
                                                              MODIFY COLUMN `city_id`  int(10) UNSIGNED NULL AFTER `state_id`,
                                                              MODIFY COLUMN `sex_id`  int(10) UNSIGNED NULL AFTER `city_id`,
                                                              MODIFY COLUMN `race_id`  int(10) UNSIGNED NULL AFTER `sex_id`;");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`participant` DROP COLUMN `education`,
                                                              DROP COLUMN `income`,
                                                              DROP COLUMN `age`,
                                                              MODIFY COLUMN `country_id`  int(10) UNSIGNED NOT NULL AFTER `participant_zipcode`,
                                                              MODIFY COLUMN `state_id`  int(10) UNSIGNED NOT NULL AFTER `country_id`,
                                                              MODIFY COLUMN `city_id`  int(10) UNSIGNED NOT NULL AFTER `state_id`,
                                                              MODIFY COLUMN `sex_id`  int(10) UNSIGNED NOT NULL AFTER `city_id`,
                                                              MODIFY COLUMN `race_id`  int(10) UNSIGNED NOT NULL AFTER `sex_id`;");
    }
}

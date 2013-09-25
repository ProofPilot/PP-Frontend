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
class Version20130808164916 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("INSERT INTO `proofpilot`.`arm`(`arm_name`,`arm_quota`,`arm_ceilling`, `arm_description`, `study_id`, `status_id`) VALUES ('SexPro3Month', 100, NULL,  NULL, 7, 1);
                       INSERT INTO `proofpilot`.`arm`(`arm_name`,`arm_quota`,`arm_ceilling`, `arm_description`, `study_id`, `status_id`) VALUES ('SexProBaseLine', 100, NULL, NULL, 7, 1);");
        $this->addSql("INSERT INTO `proofpilot`.`intervention`(`language_id`,`intervention_name`,`intervention_type_id`, `intervention_url`, `sid_id`, `intervention_response_url`, `status_id`) VALUES (1, 'SexPro Baseline Survey',2, 'http://limesurvey.dev1.proofpilot.net/index.php/survey/index/sid/393626/lang/en', 468727, NULL, 1);
                       INSERT INTO `proofpilot`.`intervention`(`language_id`,`intervention_name`,`intervention_type_id`, `intervention_url`, `sid_id`, `intervention_response_url`, `status_id`) VALUES (1, 'SexPro Activity', 1, NULL, NULL, NULL, 1);");

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}

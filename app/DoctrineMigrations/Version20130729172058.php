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
class Version20130729172058 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("INSERT INTO `proofpilot`.`participant_timezone` VALUES (1, 'EST New York, USA -5'),
                (2, 'CST Chicago, USA -6'), (3, 'MST Denver, USA -7'), (4, 'PST Los Angeles, USA -8'),
                (5, 'AST Anchorage, USA -9'), (6, 'HAT Honolulu, USA -10'), (7, 'BST Brasilia, Brazil -4'),
                (8, 'PET Lima, Peru -5'), (9, 'GMT London, UK 0');");
        
        $this->addSql("INSERT INTO `proofpilot`.`participant_study_reminder` VALUES (1, 'reminder_study_task'), 
                (2, 'reminder_orders'), (3, 'reminder_other_studies');");
        
        $this->addSql("INSERT INTO `proofpilot`.`participant_contact_time` VALUES (1, 'time_early_am'), (2, 'time_morning'),
                (3, 'time_afternoon'),(4, 'time_early_evening'), (5, 'time_night'),(6, 'time_late_night');");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

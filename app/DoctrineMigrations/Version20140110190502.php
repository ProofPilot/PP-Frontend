<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140110190502 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO `new-proofpilot`.`intervention`
                (`language_id`,`intervention_name`,`intervention_type_id`,`intervention_url`,`sid_id`,`intervention_response_url`,`status_id`,`intervention_title`,`intervention_descripton`,`intervention_code`,`study_id`,`intervention_incentive_amount`)
                VALUES ((SELECT `language_id` FROM `new-proofpilot`.`language` WHERE `locale` = 'en'),'Pledgereferral',(SELECT `intervention_type_id` FROM `new-proofpilot`.`intervention_type` WHERE `intervention_type_name` = 'Referral'),null,123,null,1,'Pledge Referral','Pledge Referral description', 'Pledgereferral',(SELECT `study_id` FROM `new-proofpilot`.`study` WHERE `study_code` = 'newhiv'),0);");
        
        $this->addSql("INSERT INTO `new-proofpilot`.`arm_intervention_link` (`arm_id`,`intervention_id`,`status_id`,`arm_intervention_link_first_study_task`) 
                        VALUES ((SELECT `arm_id` FROM `new-proofpilot`.`arm` WHERE `arm_code` =  'AFormative'),(SELECT `intervention_id` FROM `new-proofpilot`.`intervention` WHERE `intervention_code` = 'Pledgereferral'),1,1);");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140124155610 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO `new-proofpilot`.`intervention`
                (`language_id`,`intervention_name`,`intervention_type_id`,`intervention_url`,`sid_id`,`intervention_response_url`,`status_id`,`intervention_title`,`intervention_descripton`,`intervention_code`,`study_id`,`intervention_incentive_amount`,`intervention_expiration_period`,`intervention_expiration_date`)
                VALUES ((SELECT `language_id` FROM `new-proofpilot`.`language` WHERE `locale` = 'en'),'SexproAboutMe',(SELECT `intervention_type_id` FROM `new-proofpilot`.`intervention_type` WHERE `intervention_type_name` = 'About Me Info'),null,123,null,1,'Sexpro About Me','Pledge Referral description', 'Sexproaboutme',(SELECT `study_id` FROM `new-proofpilot`.`study` WHERE `study_code` = 'sexpro'),0,null,null);");
        $this->addSql("INSERT INTO `new-proofpilot`.`intervention`
                (`language_id`,`intervention_name`,`intervention_type_id`,`intervention_url`,`sid_id`,`intervention_response_url`,`status_id`,`intervention_title`,`intervention_descripton`,`intervention_code`,`study_id`,`intervention_incentive_amount`,`intervention_expiration_period`,`intervention_expiration_date`)
                VALUES ((SELECT `language_id` FROM `new-proofpilot`.`language` WHERE `locale` = 'en'),'SexproShipping',(SELECT `intervention_type_id` FROM `new-proofpilot`.`intervention_type` WHERE `intervention_type_name` = 'Shipping Info'),null,123,null,1,'Sexpro shipping','Sexpro shipping description', 'Sexproshipping',(SELECT `study_id` FROM `new-proofpilot`.`study` WHERE `study_code` = 'sexpro'),0,null,null);");
        $this->addSql("INSERT INTO `new-proofpilot`.`intervention`
                (`language_id`,`intervention_name`,`intervention_type_id`,`intervention_url`,`sid_id`,`intervention_response_url`,`status_id`,`intervention_title`,`intervention_descripton`,`intervention_code`,`study_id`,`intervention_incentive_amount`,`intervention_expiration_period`,`intervention_expiration_date`)
                VALUES ((SELECT `language_id` FROM `new-proofpilot`.`language` WHERE `locale` = 'en'),'SexproPhone',(SELECT `intervention_type_id` FROM `new-proofpilot`.`intervention_type` WHERE `intervention_type_name` = 'Confirm Mobile Phone'),null,123,null,1,'Sexpro Phone','Sexpro Phone description', 'Sexprophone',(SELECT `study_id` FROM `new-proofpilot`.`study` WHERE `study_code` = 'sexpro'),0,null,null);");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

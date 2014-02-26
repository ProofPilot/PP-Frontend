<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140226103649 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("
                INSERT INTO `new-proofpilot`.`arm_intervention_link`
                (`arm_id`,`intervention_id`,`status_id`, `arm_intervention_link_first_study_task`)
                VALUES
                ((SELECT arm_id FROM `new-proofpilot`.arm where arm_code LIKE 'BAsELINEONCE%'),
                (SELECT intervention_id FROM `new-proofpilot`.intervention where intervention_code LIKE 'BaseFull%' and language_id = 1),1,1),
                
                ((SELECT arm_id FROM `new-proofpilot`.arm where arm_code LIKE 'BAsELINEONCE%'),
                (SELECT intervention_id FROM `new-proofpilot`.intervention where intervention_code LIKE 'REFER' and language_id = 1),1,0),
                
                ((SELECT arm_id FROM `new-proofpilot`.arm where arm_code LIKE 'BAsELINEONCE%'),
                (SELECT intervention_id FROM `new-proofpilot`.intervention where intervention_code LIKE 'WEEK1%'and language_id = 1),1,0),
                
                ((SELECT arm_id FROM `new-proofpilot`.arm where arm_code LIKE 'BAsELINEONCE%'),
                (SELECT intervention_id FROM `new-proofpilot`.intervention where intervention_code LIKE 'WEEK2%'and language_id = 1),1,0),
                
                ((SELECT arm_id FROM `new-proofpilot`.arm where arm_code LIKE 'BAsELINEONCE%'),
                (SELECT intervention_id FROM `new-proofpilot`.intervention where intervention_code LIKE 'WEEK3%'and language_id = 1),1,0),
                
                ((SELECT arm_id FROM `new-proofpilot`.arm where arm_code LIKE 'BAsELINEONCE%'),
                (SELECT intervention_id FROM `new-proofpilot`.intervention where intervention_code LIKE 'WEEK4%'and language_id = 1),1,0),
                
                ((SELECT arm_id FROM `new-proofpilot`.arm where arm_code LIKE 'BAsELINEONCE%'),
                (SELECT intervention_id FROM `new-proofpilot`.intervention where intervention_code LIKE 'WEEK5%'and language_id = 1),1,0),
                
                ((SELECT arm_id FROM `new-proofpilot`.arm where arm_code LIKE 'BAsELINEONCE%'),
                (SELECT intervention_id FROM `new-proofpilot`.intervention where intervention_code LIKE 'WEEK6%'and language_id = 1),1,0),
                
                ((SELECT arm_id FROM `new-proofpilot`.arm where arm_code LIKE 'BAsELINEONCE%'),
                (SELECT intervention_id FROM `new-proofpilot`.intervention where intervention_code LIKE 'REFER2%'and language_id = 1),1,0),
                
                ((SELECT arm_id FROM `new-proofpilot`.arm where arm_code LIKE 'BAsELINEONCE%'),
                (SELECT intervention_id FROM `new-proofpilot`.intervention where intervention_code LIKE 'HUFF1%'and language_id = 1),1,0),
                
                ((SELECT arm_id FROM `new-proofpilot`.arm where arm_code LIKE 'BAsELINEONCE%'),
                (SELECT intervention_id FROM `new-proofpilot`.intervention where intervention_code LIKE 'HUFF2%'and language_id = 1),1,0),
                
                ((SELECT arm_id FROM `new-proofpilot`.arm where arm_code LIKE 'BAsELINEONCE%'),
                (SELECT intervention_id FROM `new-proofpilot`.intervention where intervention_code LIKE 'HUFF3%'and language_id = 1),1,0),
                
                ((SELECT arm_id FROM `new-proofpilot`.arm where arm_code LIKE 'BAsELINEONCE%'),
                (SELECT intervention_id FROM `new-proofpilot`.intervention where intervention_code LIKE 'HUFF4%'and language_id = 1),1,0),
                
                ((SELECT arm_id FROM `new-proofpilot`.arm where arm_code LIKE 'BAsELINEONCE%'),
                (SELECT intervention_id FROM `new-proofpilot`.intervention where intervention_code LIKE 'HUFF5%'and language_id = 1),1,0),
                
                ((SELECT arm_id FROM `new-proofpilot`.arm where arm_code LIKE 'BAsELINEONCE%'),
                (SELECT intervention_id FROM `new-proofpilot`.intervention where intervention_code LIKE 'HUFF6%'and language_id = 1),1,0);
                ");

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

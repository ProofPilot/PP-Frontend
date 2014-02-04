<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140204111050 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("INSERT INTO `new-proofpilot`.`intervention`
									(`language_id`,
									`intervention_name`,
									`intervention_type_id`,
									`intervention_url`,
									`sid_id`,
									`intervention_response_url`,
									`status_id`,
									`intervention_title`,
									`intervention_descripton`,
									`intervention_code`,
									`study_id`,
									`intervention_incentive_amount`,
									`intervention_expiration_period`,
									`intervention_expiration_date`)
									VALUES
									((SELECT language_id FROM `new-proofpilot`.language where language_name = 'English'),
									'Video intervention',
									(SELECT intervention_type_id FROM `new-proofpilot`.intervention_type where intervention_type_name = 'Video'),
									'http://www.youtube.com/embed/Ow-vyZnlgE8',
									'0',
									NULL,
									(SELECT status_id FROM `new-proofpilot`.status where status_name = 'Active'),
									'It is a video intervention',
									'Watch this video',
									'VideoIntervention',
									(SELECT study_id FROM `new-proofpilot`.study where study_code = 'sexpro'),
									'0',
									NULL,
									NULL);");

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

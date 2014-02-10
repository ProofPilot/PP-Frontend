<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140210162821 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("
						INSERT INTO `new-proofpilot`.`location_organization_link`
						(`location_id`,
						`organization_id`)
						VALUES
						((SELECT location_id FROM `new-proofpilot`.location where location_name LIKE 'Sunset Plaza Dental%'),
						(SELECT organization_id FROM `new-proofpilot`.organization where organization_name LIKE 'A Research Institution%')),
						((SELECT location_id FROM `new-proofpilot`.location where location_name LIKE 'Drug Rehabilitation Center in West Hollywood%'),
						(SELECT organization_id FROM `new-proofpilot`.organization where organization_name LIKE 'A Research Institution%')),
						((SELECT location_id FROM `new-proofpilot`.location where location_name LIKE 'Stone Skin Care%'),
						(SELECT organization_id FROM `new-proofpilot`.organization where organization_name LIKE 'A Research Institution%')),
						((SELECT location_id FROM `new-proofpilot`.location where location_name LIKE 'Jessica Nail Clinic%'),
						(SELECT organization_id FROM `new-proofpilot`.organization where organization_name LIKE 'A Research Institution%')),
						((SELECT location_id FROM `new-proofpilot`.location where location_name LIKE 'Back to Total Health%'),
						(SELECT organization_id FROM `new-proofpilot`.organization where organization_name LIKE 'A Research Institution%')),
						((SELECT location_id FROM `new-proofpilot`.location where location_name LIKE 'Sunset Acupuncture - META CLINIC%'),
						(SELECT organization_id FROM `new-proofpilot`.organization where organization_name LIKE 'A Research Institution%')),
						((SELECT location_id FROM `new-proofpilot`.location where location_name LIKE 'Saban Community Clinic - Beverly Health Cente%'),
						(SELECT organization_id FROM `new-proofpilot`.organization where organization_name LIKE 'A Research Institution%')),
						((SELECT location_id FROM `new-proofpilot`.location where location_name LIKE 'James Guay%'),
						(SELECT organization_id FROM `new-proofpilot`.organization where organization_name LIKE 'A Research Institution%'));
    			");

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

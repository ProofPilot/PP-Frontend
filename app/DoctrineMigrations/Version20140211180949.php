<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140211180949 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("CREATE TABLE `location_site_link` (
          `location_site_link_id` INT NOT NULL AUTO_INCREMENT,
          `location_id` INT NULL,
          `site_id` INT UNSIGNED NULL,
          PRIMARY KEY (`location_site_link_id`),
          INDEX `fk_location_site_link_location_idx` (`location_id` ASC),
          INDEX `fk_location_site_link_site_idx` (`site_id` ASC),
          CONSTRAINT `fk_location_site_link_location`
            FOREIGN KEY (`location_id`)
            REFERENCES `new-proofpilot`.`location` (`location_id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION,
          CONSTRAINT `fk_location_site_link_site`
            FOREIGN KEY (`site_id`)
            REFERENCES `new-proofpilot`.`site` (`site_id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION);");
        $this->addSql("DROP TABLE `location_organization_link` ");
        
        $this->addSql("
            INSERT INTO `location_site_link`
            (`location_id`,
            `site_id`)
            VALUES
            ((SELECT location_id FROM location where location_name LIKE 'Sunset Plaza Dental%'),
            (SELECT site_id FROM site where site_name LIKE 'Sexpro Default%')),
            ((SELECT location_id FROM location where location_name LIKE 'Drug Rehabilitation Center in West Hollywood%'),
            (SELECT site_id FROM site where site_name LIKE 'Sexpro Default%')),
            ((SELECT location_id FROM location where location_name LIKE 'Stone Skin Care%'),
            (SELECT site_id FROM site where site_name LIKE 'Sexpro Default%')),
            ((SELECT location_id FROM location where location_name LIKE 'Jessica Nail Clinic%'),
            (SELECT site_id FROM site where site_name LIKE 'Sexpro Default%')),
            ((SELECT location_id FROM location where location_name LIKE 'Back to Total Health%'),
            (SELECT site_id FROM site where site_name LIKE 'Sexpro UCSF%')),
            ((SELECT location_id FROM location where location_name LIKE 'Sunset Acupuncture - META CLINIC%'),
            (SELECT site_id FROM site where site_name LIKE 'Sexpro UCSF%')),
            ((SELECT location_id FROM location where location_name LIKE 'Saban Community Clinic - Beverly Health Cente%'),
            (SELECT site_id FROM site where site_name LIKE 'Sexpro UCSF%')),
            ((SELECT location_id FROM location where location_name LIKE 'James Guay%'),
            (SELECT site_id FROM site where site_name LIKE 'Sexpro UCSF%'));
        ");
        
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

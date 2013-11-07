<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131107180926 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("UPDATE `proofpilot`.`site` SET `site_default` = 0 WHERE `site_name` = 'King of Condoms Social Media Default';");
                
        $this->addSql("INSERT INTO `proofpilot`.`site`(`site_name`, `site_url`,`organization_id`,`status_id`,`site_default`)
                      VALUES ('King of Condoms', NULL, (SELECT `organization_id` FROM `proofpilot`.`organization` WHERE `organization_name` = 'University of Kentucky'), 1,1);");
        
        $this->addSql("INSERT INTO `proofpilot`.`campaign_site_link`(`campaign_id`, `site_id`)
                      VALUES ((SELECT `campaign_id` FROM `proofpilot`.`campaign` WHERE `campaign_name` = 'KOC ONLINE'),
                              (SELECT `site_id` FROM `proofpilot`.`site` WHERE `site_name` = 'King of Condoms'));");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

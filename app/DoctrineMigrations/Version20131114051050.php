<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131114051050 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO `proofpilot`.`user_role` (`user_role_name`, `status_id`, `user_order`, `user_parent_role_id`) 
                VALUES ('ROLE_REPORT_USER',1,1,9);");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("DELETE FROM `proofpilot`.`user_role` WHERE user_role_name = 'ROLE_REPORT_USER';");
    }
}

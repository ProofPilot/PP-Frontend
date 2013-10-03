<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131002194639 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql('UPDATE `proofpilot`.`incentive_type` SET `incentive_type_name` = \'None\' where `incentive_type_name` = \'iTunes Gift Card\'');
        $this->addSql('INSERT INTO `proofpilot`.`test_type` (`test_type_name`, `status_id`) VALUES(\'Your Test Kit\', 1)');

    }
    

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql('UPDATE `proofpilot`.`incentive_type` SET `incentive_type_name` = \'iTunes Gift Card\' where `incentive_type_name` = \'iNone\'');
    }
}

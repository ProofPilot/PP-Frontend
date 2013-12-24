<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131224110632 extends AbstractMigration
{
    public function up(Schema $schema)
    {
      // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("INSERT INTO `new-proofpilot`.`intervention_type`(`intervention_type_name`, `status_id`) VALUES ('Referral', 1)");

    }

    public function down(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs

    }
}

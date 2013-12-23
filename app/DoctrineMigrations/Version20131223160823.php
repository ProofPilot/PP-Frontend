<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131223160823 extends AbstractMigration
{
    public function up(Schema $schema)
    {
      // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("INSERT INTO `new-proofpilot`.`status`(`status_name`) VALUES ('Dismiss')");

    }

    public function down(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs

    }
}

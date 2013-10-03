<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130924175801 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`incentive`
                DROP FOREIGN KEY `fk_incentive_participant1`;
                ALTER TABLE `proofpilot`.`incentive`
                ADD CONSTRAINT `fk_incentive_participant1`
                FOREIGN KEY (`participant_id`)
                REFERENCES `proofpilot`.`participant` (`participant_id`)
                ON DELETE CASCADE;");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130830172622 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`intervention` 
                    DROP INDEX `intervention_code_UNIQUE` 
                    , ADD UNIQUE INDEX `intervention_code_UNIQUE` USING BTREE (`intervention_code` ASC, `language_id` ASC) ;");
    }

    public function down(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`intervention` 
                DROP INDEX `intervention_code_UNIQUE` 
                , ADD UNIQUE INDEX `intervention_code_UNIQUE` USING BTREE (`intervention_code` ASC) ;");
    }
}

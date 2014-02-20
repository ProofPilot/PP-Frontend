<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140220115725 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE participant_intervention_link ADD COLUMN promo_code_assigned TINYINT DEFAULT 0;");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

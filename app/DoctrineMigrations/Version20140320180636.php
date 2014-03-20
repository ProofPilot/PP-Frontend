<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140320180636 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("
                ALTER TABLE `new-proofpilot`.`study_content`
                ADD COLUMN `study_wistia_video` VARCHAR(255) NULL
                ");
    
    }
    
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("
                ALTER TABLE `new-proofpilot`.`study_content`
                DROP COLUMN `study_wistia_video`
                ");
    
    }
}

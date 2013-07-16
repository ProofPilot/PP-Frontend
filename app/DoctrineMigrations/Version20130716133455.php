<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130716133455 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`language` ADD COLUMN `locale` VARCHAR(10) NOT NULL  AFTER `status_id`");
        $this->addSql("INSERT INTO `proofpilot`.`language`(`language_name`,`locale`) VALUES ('Português', 'pt')");
        $this->addSql("INSERT INTO `proofpilot`.`language`(`language_name`,`locale`) VALUES ('Français', 'fr')");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`language` ADD COLUMN `locale` VARCHAR(10) NOT NULL  AFTER `status_id`");
        $this->addSql("INSERT INTO `proofpilot`.`language`(`language_name`,`locale`) VALUES ('Português', 'pt')");
        $this->addSql("INSERT INTO `proofpilot`.`language`(`language_name`,`locale`) VALUES ('Français', 'fr')");
    }
}

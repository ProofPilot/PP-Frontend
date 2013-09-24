<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130924105446 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`participant`ADD UNIQUE INDEX `participant_username_UNIQUE` (`participant_username`),
        ADD UNIQUE INDEX `participant_mobile_number_UNIQUE` (`participant_mobile_number`),
        ADD UNIQUE INDEX `participant_appreciation_email_UNIQUE`(`participant_appreciation_email`);");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_timezone` ADD UNIQUE INDEX `participant_timezone_name_UNIQUE` (`participant_timezone_name`);");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_survey_link` ADD UNIQUE INDEX `save_id_UNIQUE` (`save_id`);");
        
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`participant` DROP INDEX `participant_username_UNIQUE`;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant` DROP INDEX `participant_mobile_number_UNIQUE`;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant` DROP INDEX `participant_appreciation_email_UNIQUE`;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_timezone` DROP INDEX `participant_timezone_name_UNIQUE`;");
        $this->addSql("ALTER TABLE `proofpilot`.`participant_survey_link` DROP INDEX `save_id_UNIQUE`;");
    }
}

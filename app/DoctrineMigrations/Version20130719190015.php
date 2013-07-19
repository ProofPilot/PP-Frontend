<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130719190015 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`study_content`
        MODIFY COLUMN `study_whats_involved`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `study_about`,
        MODIFY COLUMN `study_requirements`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `study_whats_involved`,
        MODIFY COLUMN `study_privacy`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `study_requirements`,
        MODIFY COLUMN `study_consent_introduction`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL AFTER `study_consent_image`");

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`study_content` 
                MODIFY COLUMN `study_whats_involved`  VARCHAR(2000) NULL DEFAULT NULL,
                MODIFY COLUMN `study_requirements`  VARCHAR(2000) NULL DEFAULT NULL,
                MODIFY COLUMN `study_privacy`  VARCHAR(2000) NULL DEFAULT NULL,
                MODIFY COLUMN `study_consent_introduction`  VARCHAR(2000) NULL DEFAULT NULL");

    }
}

<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130910184253 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`adverse_reaction`
                DROP FOREIGN KEY `adverse_reaction_ibfk_2`;
                ALTER TABLE `proofpilot`.`participant_arm_link`
                ADD CONSTRAINT `adverse_reaction_ibfk_2`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE CASCADE;");
        $this->addSql("ALTER TABLE `proofpilot`.`orders`
                DROP FOREIGN KEY `orders_ibfk_4`;
                ALTER TABLE `proofpilot`.`orders`
                ADD CONSTRAINT `orders_ibfk_4`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE CASCADE;");
        $this->addSql("ALTER TABLE `proofpilot`.`appointment`
                DROP FOREIGN KEY `appointment_ibfk_5`;
                ALTER TABLE `proofpilot`.`appointment`
                ADD CONSTRAINT `appointment_ibfk_5`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE CASCADE;");
        $this->addSql("ALTER TABLE `proofpilot`.`sex_with`
                DROP FOREIGN KEY `sex_with_ibfk_1`;
                ALTER TABLE `proofpilot`.`sex_with`
                ADD CONSTRAINT `sex_with_ibfk_1`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE CASCADE;");
    }
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

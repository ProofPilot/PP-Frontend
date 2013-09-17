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
                DROP FOREIGN KEY `fk_adverse_reaction_participant1`;
                ALTER TABLE `proofpilot`.`adverse_reaction`
                ADD CONSTRAINT `fk_adverse_reaction_participant1`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE CASCADE;");
        $this->addSql("ALTER TABLE `proofpilot`.`order_specimen_link`
                DROP FOREIGN KEY `fk_order_specimen_link_orders1`;
                ALTER TABLE `proofpilot`.`order_specimen_link`
                ADD CONSTRAINT `fk_order_specimen_link_orders1`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE CASCADE;");
        $this->addSql("ALTER TABLE `proofpilot`.`orders`
                DROP FOREIGN KEY `fk_order_participant1`;
                ALTER TABLE `proofpilot`.`orders`
                ADD CONSTRAINT `fk_order_participant1`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE CASCADE;");
        $this->addSql("ALTER TABLE `proofpilot`.`appointment`
                DROP FOREIGN KEY `fk_appointment_participant1`;
                ALTER TABLE `proofpilot`.`appointment`
                ADD CONSTRAINT `fk_appointment_participant1`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE CASCADE;");
        $this->addSql("ALTER TABLE `proofpilot`.`sex_with`
                DROP FOREIGN KEY `fk_sex_with_participant1`;
                ALTER TABLE `proofpilot`.`sex_with`
                ADD CONSTRAINT `fk_sex_with_participant1`
                FOREIGN KEY (`participant_id` )
                REFERENCES `proofpilot`.`participant` (`participant_id` )
                ON DELETE CASCADE;");
    }
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

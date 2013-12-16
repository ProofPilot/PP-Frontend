<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131213124626 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("CREATE  TABLE IF NOT EXISTS `new-proofpilot`.`participant_race_link` (
                `participant_race_link_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                `participant_id` INT(10) UNSIGNED NOT NULL ,
                `race_id` INT(10) UNSIGNED NOT NULL ,
                PRIMARY KEY (`participant_race_link_id`),
                KEY `FK_participant_race_link_participant_idx` (`participant_id`),
                KEY `FK_participant_race_link_race_idx` (`race_id`),
                
                CONSTRAINT `FK_participant_race_link_participant` 
                FOREIGN KEY (`participant_id`) 
                REFERENCES `new-proofpilot`.`participant` (`participant_id`) 
                ON DELETE CASCADE ON 
                UPDATE RESTRICT,
                
                CONSTRAINT `FK_participant_race_link_race` 
                FOREIGN KEY (`race_id`) 
                REFERENCES `new-proofpilot`.`race` (`race_id`) 
                ON DELETE NO ACTION 
                ON UPDATE NO ACTION)
                ENGINE = InnoDB");
        
        $this->addSql("ALTER TABLE `proofpilot`.`participant` DROP FOREIGN KEY `fk_participant_race1`;
                       ALTER TABLE `new-proofpilot`.`participant` DROP COLUMN `race_id`;");
    }
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

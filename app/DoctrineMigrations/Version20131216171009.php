<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131216171009 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("ALTER TABLE `new-proofpilot`.`participant` ADD COLUMN `participant_basic_information` TINYINT NOT NULL ;");
        
        $this->addSql("UPDATE `new-proofpilot`.`participant` SET `participant_basic_information` = 0 ;");
        
        

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140122134847 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("CREATE TABLE participant_queue (participant_queue_id bigint(20) unsigned NOT NULL AUTO_INCREMENT, participant_id int(10) unsigned NOT NULL, participant_queue_date datetime NOT NULL, participant_queue_type_id smallint(5) unsigned NOT NULL DEFAULT '0', PRIMARY KEY (participant_queue_id), KEY fk_participant_queue_participant1_idx (participant_id), CONSTRAINT fk_participant_queue_participant1 FOREIGN KEY (participant_id) REFERENCES participant (participant_id) ON DELETE NO ACTION ON UPDATE NO ACTION ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

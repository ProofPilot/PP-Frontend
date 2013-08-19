<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130814144921 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("CREATE  TABLE IF NOT EXISTS proofpilot.intervention_message_table (
					  intervention_message_table_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
					  intervention_id INT(10) UNSIGNED NOT NULL ,
					  intervention_language_id INT(10) UNSIGNED NOT NULL ,
					  message_id BIGINT(19) UNSIGNED NOT NULL ,
					  message_language_id INT(10) UNSIGNED NOT NULL ,
					  status_id INT(10) UNSIGNED NOT NULL ,
					  PRIMARY KEY (intervention_message_table_id) ,
					  INDEX fk_intervention_message_table_intervention1_idx (intervention_id ASC, intervention_language_id ASC) ,
					  INDEX fk_intervention_message_table_message1_idx (message_id ASC, message_language_id ASC) ,
					  INDEX fk_intervention_message_table_status1_idx (status_id ASC) ,
					  CONSTRAINT fk_intervention_message_table_intervention1
					    FOREIGN KEY (intervention_id , intervention_language_id )
					    REFERENCES proofpilot.intervention (intervention_id , language_id )
					    ON DELETE NO ACTION
					    ON UPDATE NO ACTION,
					  CONSTRAINT fk_intervention_message_table_message1
					    FOREIGN KEY (message_id , message_language_id )
					    REFERENCES proofpilot.message (message_id , language_id )
					    ON DELETE NO ACTION
					    ON UPDATE NO ACTION,
					  CONSTRAINT fk_intervention_message_table_status1
					    FOREIGN KEY (status_id )
					    REFERENCES proofpilot.status (status_id )
					    ON DELETE NO ACTION
					    ON UPDATE NO ACTION)
					ENGINE = InnoDB
					DEFAULT CHARACTER SET = utf8");
    	 
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("DROP TABLE proofpilot.intervention_message_table");
    	 
    }
}

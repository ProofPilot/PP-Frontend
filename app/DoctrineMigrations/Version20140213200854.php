<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140213200854 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	
    	$this->addSql("CREATE  TABLE IF NOT EXISTS promo_code (
						  promo_code_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
						  promo_code_retailer VARCHAR(500) NOT NULL ,
						  promo_code_expiration DATETIME NULL ,
						  promo_code_issued INT UNSIGNED NULL DEFAULT 0 ,
						  promo_code_unused INT UNSIGNED NULL DEFAULT 0 ,
						  PRIMARY KEY (promo_code_id) )
						ENGINE = InnoDB
    					DEFAULT CHARACTER SET = utf8
						COLLATE = utf8_general_ci");
    	
    	$this->addSql("CREATE  TABLE IF NOT EXISTS study_promo_code_link (
						  study_promo_code_link_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
						  promo_code_id BIGINT UNSIGNED NOT NULL ,
						  study_id INT UNSIGNED NOT NULL ,
						  PRIMARY KEY (study_promo_code_link_id) ,
						  INDEX fk_study_promo_code_link_promo_code1_idx (promo_code_id ASC) ,
						  INDEX fk_study_promo_code_link_study1_idx (study_id ASC) ,
						  CONSTRAINT fk_study_promo_code_link_promo_code1
						    FOREIGN KEY (promo_code_id )
						    REFERENCES promo_code (promo_code_id )
						    ON DELETE NO ACTION
						    ON UPDATE NO ACTION,
						  CONSTRAINT fk_study_promo_code_link_study1
						    FOREIGN KEY (study_id )
						    REFERENCES study (study_id )
						    ON DELETE NO ACTION
						    ON UPDATE NO ACTION)
						ENGINE = InnoDB
	    				DEFAULT CHARACTER SET = utf8
						COLLATE = utf8_general_ci");
    	
    	$this->addSql("CREATE  TABLE IF NOT EXISTS promo_code_intervention_link (
						  promo_code_intervention_link_id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
						  promo_code_id BIGINT UNSIGNED NOT NULL ,
						  intervention_id INT UNSIGNED NOT NULL ,
						  PRIMARY KEY (promo_code_intervention_link_id) ,
						  INDEX fk_promo_code_intervention_link_promo_code1_idx (promo_code_id ASC) ,
						  INDEX fk_promo_code_intervention_link_intervention1_idx (intervention_id ASC) ,
						  CONSTRAINT fk_promo_code_intervention_link_promo_code1
						    FOREIGN KEY (promo_code_id )
						    REFERENCES promo_code (promo_code_id )
						    ON DELETE NO ACTION
						    ON UPDATE NO ACTION,
						  CONSTRAINT fk_promo_code_intervention_link_intervention1
						    FOREIGN KEY (intervention_id )
						    REFERENCES intervention (intervention_id )
						    ON DELETE NO ACTION
						    ON UPDATE NO ACTION)
						ENGINE = InnoDB
    					DEFAULT CHARACTER SET = utf8
						COLLATE = utf8_general_ci");
    	 
    	
    	$this->addSql("CREATE  TABLE IF NOT EXISTS code (
						  code_id BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT ,
						  code_value VARCHAR(45) NULL DEFAULT NULL ,
						  code_redeemed_by_participant_id INT(10) UNSIGNED NULL DEFAULT NULL ,
						  code_redeemed_datetime DATETIME NULL DEFAULT NULL ,
						  promo_code_id BIGINT(19) UNSIGNED NOT NULL ,
						  status_id INT(10) UNSIGNED NOT NULL DEFAULT 1 ,
						  PRIMARY KEY (code_id) ,
						  INDEX fk_code_promo_code1_idx (promo_code_id ASC) ,
						  INDEX fk_code_status1_idx (status_id ASC) ,
						  INDEX fk_code_participant1_idx (code_redeemed_by_participant_id ASC) ,
						  CONSTRAINT fk_code_promo_code1
						    FOREIGN KEY (promo_code_id )
						    REFERENCES promo_code (promo_code_id )
						    ON DELETE NO ACTION
						    ON UPDATE NO ACTION,
						  CONSTRAINT fk_code_status1
						    FOREIGN KEY (status_id )
						    REFERENCES status (status_id )
						    ON DELETE NO ACTION
						    ON UPDATE NO ACTION,
						  CONSTRAINT fk_code_participant1
						    FOREIGN KEY (code_redeemed_by_participant_id )
						    REFERENCES participant (participant_id )
						    ON DELETE NO ACTION
						    ON UPDATE NO ACTION)
						ENGINE = InnoDB
						DEFAULT CHARACTER SET = utf8
						COLLATE = utf8_general_ci");
    	
    	$this->addSql("CREATE  TABLE IF NOT EXISTS promo_code_content (
						  promo_code_id BIGINT UNSIGNED NOT NULL ,
						  language_id INT UNSIGNED NOT NULL ,
						  promo_code_content_title VARCHAR(255) NULL ,
						  promo_code_content_unlock_message VARCHAR(2000) NULL ,
						  promo_code_content_url_for_unlock VARCHAR(500) NULL ,
						  promo_code_content_unlock_share_msg VARCHAR(2000) NULL ,
						  PRIMARY KEY (promo_code_id, language_id) ,
						  CONSTRAINT fk_promo_code_content_promo_code1
						    FOREIGN KEY (promo_code_id )
						    REFERENCES promo_code (promo_code_id )
						    ON DELETE NO ACTION
						    ON UPDATE NO ACTION)
						ENGINE = InnoDB
						DEFAULT CHARACTER SET = utf8
						COLLATE = utf8_general_ci");
    	
    	$this->addSql("DROP TABLE study_promo_code");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    	$this->addSql("DROP TABLE promo_code_intervention_link");
    	$this->addSql("DROP TABLE promo_code_content");
    	$this->addSql("DROP TABLE code");
    	$this->addSql("DROP TABLE study_promo_code_link");
    	$this->addSql("DROP TABLE promo_code");
    	$this->addSql("CREATE TABLE IF NOT EXISTS study_promo_code (id INT NOT NULL, PRIMARY KEY (id)) ENGINE = InnoDB");
    }
}

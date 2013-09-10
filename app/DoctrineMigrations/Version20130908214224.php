<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130908214224 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs

    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	
    	$this->addSql("CREATE  TABLE IF NOT EXISTS proofpilot.rule_group (
    	rule_group_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    	rule_group_name VARCHAR(145) NOT NULL ,
    	rule_group_order INT(10) UNSIGNED NOT NULL ,
    	study_id INT(10) UNSIGNED NOT NULL ,
    	PRIMARY KEY (rule_group_id) ,
    	INDEX fk_rule_group_study1_idx (study_id ASC) ,
    	CONSTRAINT fk_rule_group_study1
    	FOREIGN KEY (study_id )
    	REFERENCES proofpilot.study (study_id )
    	ON DELETE NO ACTION
    	ON UPDATE NO ACTION)
    	ENGINE = InnoDB
    	DEFAULT CHARACTER SET = utf8");
    	
    	
    	
    	$this->addSql("CREATE  TABLE IF NOT EXISTS proofpilot.rule_wait (
    	rule_wait_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
    	rule_wait_name VARCHAR(45) NULL DEFAULT NULL ,
    	rule_wait_mysql_interval VARCHAR(20) NOT NULL ,
    	PRIMARY KEY (rule_wait_id) )
    	ENGINE = InnoDB
    	DEFAULT CHARACTER SET = utf8");
    	
    	$this->addSql("CREATE  TABLE IF NOT EXISTS proofpilot.rule (
    	rule_id BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT ,
    	rule_group_id INT(10) UNSIGNED NOT NULL ,
    	rule_order INT(10) UNSIGNED NOT NULL ,
    	rule_name VARCHAR(245) NOT NULL ,
    	rule_description VARCHAR(2000) NULL DEFAULT NULL ,
    	rule_if TEXT NULL DEFAULT NULL ,
    	rule_then TEXT NULL DEFAULT NULL ,
    	rule_wait_id INT(10) UNSIGNED NOT NULL ,
    	rule_wait_time INT(11) NULL DEFAULT NULL ,
    	PRIMARY KEY (rule_id) ,
    	INDEX fk_rule_rule_group1_idx (rule_group_id ASC) ,
    	INDEX fk_rule_rule_wait1_idx (rule_wait_id ASC) ,
    	CONSTRAINT fk_rule_rule_group1
    	FOREIGN KEY (rule_group_id )
    	REFERENCES proofpilot.rule_group (rule_group_id )
    	ON DELETE NO ACTION
    	ON UPDATE NO ACTION,
    	CONSTRAINT fk_rule_rule_wait1
    	FOREIGN KEY (rule_wait_id )
    	REFERENCES proofpilot.rule_wait (rule_wait_id )
    	ON DELETE NO ACTION
    	ON UPDATE NO ACTION)
    	ENGINE = InnoDB
    	DEFAULT CHARACTER SET = utf8");
    	
    	
    	$this->addSql("CREATE  TABLE IF NOT EXISTS proofpilot.rule_arm_link (
    	rule_arm_link_id BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT ,
    	rule_id BIGINT(19) UNSIGNED NOT NULL ,
    	arm_id INT(10) UNSIGNED NOT NULL ,
    	PRIMARY KEY (rule_arm_link_id) ,
    	INDEX fk_rule_arm_link_rule1_idx (rule_id ASC) ,
    	INDEX fk_rule_arm_link_arm1_idx (arm_id ASC) ,
    	CONSTRAINT fk_rule_arm_link_rule1
    	FOREIGN KEY (rule_id )
    	REFERENCES proofpilot.rule (rule_id )
    	ON DELETE NO ACTION
    	ON UPDATE NO ACTION,
    	CONSTRAINT fk_rule_arm_link_arm1
    	FOREIGN KEY (arm_id )
    	REFERENCES proofpilot.arm (arm_id )
    	ON DELETE NO ACTION
    	ON UPDATE NO ACTION)
    	ENGINE = InnoDB
    	DEFAULT CHARACTER SET = utf8");
    	
    	$this->addSql("CREATE  TABLE IF NOT EXISTS proofpilot.rule_settings (
    	rule_settings_id BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT ,
    	rule_id BIGINT(19) UNSIGNED NOT NULL ,
    	rule_settings_has_do_it_now_messaging TINYINT(3) UNSIGNED NOT NULL DEFAULT 0 ,
    	rule_should_be_noted_as_future_activity TINYINT(3) UNSIGNED NOT NULL DEFAULT 0 ,
    	rule_settings_results_in_a_proctoned_activity TINYINT(3) UNSIGNED NOT NULL DEFAULT 0 ,
    	PRIMARY KEY (rule_settings_id) ,
    	INDEX fk_rule_settings_rule1_idx (rule_id ASC) ,
    	CONSTRAINT fk_rule_settings_rule1
    	FOREIGN KEY (rule_id )
    	REFERENCES proofpilot.rule (rule_id )
    	ON DELETE NO ACTION
    	ON UPDATE NO ACTION)
    	ENGINE = InnoDB
    	DEFAULT CHARACTER SET = utf8");
    	
    	
    	
    	$this->addSql("INSERT INTO rule_wait (rule_wait_id, rule_wait_name, rule_wait_mysql_interval) VALUES (1, 'Minute', 'minute'), (2, 'Hours', 'hour'), (3, 'Days', 'day'), (4, 'Weeks', 'week'), (5, 'Months', 'month'), (6, 'Years', 'year');");
    	
    	
    	 
    	
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

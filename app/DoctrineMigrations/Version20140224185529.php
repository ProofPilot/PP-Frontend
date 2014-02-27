<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140224185529 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE participant ADD COLUMN participant_aboutme_data TEXT NULL;");
        
        $this->addSql("UPDATE participant SET participant_aboutme_data = 
                       CONCAT('{\"age\":',COALESCE(participant_age, 'null'),',',
			                  '\"sex\":', COALESCE(sex_id, 'null'),',',
			                  '\"race\":', CASE WHEN race_id IS NULL THEN CONCAT('\"race\":','null' ) ELSE CONCAT('\"race\":','[',race_id,']') END,',',
			                  '\"grade\":',COALESCE(grade_level_id, 'null'),',',
			                  '\"sex_with\":',COALESCE(participant_interested, 'null'),',',
			                  '\"industry\":',COALESCE(industry_id, 'null'),',',
			                  '\"marital\":',COALESCE(marital_status_id, 'null'),',',
			                  '\"children\":',COALESCE(participant_children, 'null'),',',
			                  '\"income\":',COALESCE(participant_income, 'null'),',',
			                  '\"country\":',COALESCE(country_id, 'null'),',',
			                  '\"zipcode\":',CASE participant_zipcode WHEN ''THEN 'null' ELSE participant_zipcode END,',',
			                  '\"phone\":',COALESCE(participant_mobile_number, 'null'),',',
			                  '\"mailing_address\":',COALESCE(CONCAT('\"',participant_address1,'\"'), 'null'),'}')");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("UPDATE participant SET participant_aboutme_data = null");
    }
}

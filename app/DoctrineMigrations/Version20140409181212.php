<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140409181212 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("
                UPDATE `new-proofpilot`.`study` SET `study_intervention_start` = '{\"interventions\":[
                {\"period\":7, \"from_registration\" : true, \"parentIntervention\": null, \"interventionCode\": \"WEEK1\", \"armCode\": \"BAsELINEONCE\"},
                {\"period\":7, \"from_registration\" : true, \"parentIntervention\": null,\"interventionCode\": \"REFER2\", \"armCode\": \"BAsELINEONCE\"},
                {\"period\":10, \"from_registration\" : true, \"parentIntervention\": null,\"interventionCode\": \"HUFF1\", \"armCode\": \"BAsELINEONCE\"},
                {\"period\":14, \"from_registration\" : true, \"parentIntervention\": null,\"interventionCode\": \"WEEK2\", \"armCode\": \"BAsELINEONCE\"},
                {\"period\":17, \"from_registration\" : true, \"parentIntervention\": null,\"interventionCode\": \"HUFF2\", \"armCode\": \"BAsELINEONCE\"},
                {\"period\":21, \"from_registration\" : true, \"parentIntervention\": null,\"interventionCode\": \"WEEK3\", \"armCode\": \"BAsELINEONCE\"},
                {\"period\":25, \"from_registration\" : true, \"parentIntervention\": null,\"interventionCode\": \"HUFF3\", \"armCode\": \"BAsELINEONCE\"},
                {\"period\":28, \"from_registration\" : true, \"parentIntervention\": null,\"interventionCode\": \"WEEK4\", \"armCode\": \"BAsELINEONCE\"},
                {\"period\":30, \"from_registration\" : true, \"parentIntervention\": null,\"interventionCode\": \"HUFF4\", \"armCode\": \"BAsELINEONCE\"},
                {\"period\":35, \"from_registration\" : true, \"parentIntervention\": null,\"interventionCode\": \"WEEK5\", \"armCode\": \"BAsELINEONCE\"},
                {\"period\":38, \"from_registration\" : true, \"parentIntervention\": null,\"interventionCode\": \"HUFF5\", \"armCode\": \"BAsELINEONCE\"},
                {\"period\":42, \"from_registration\" : true, \"parentIntervention\": null,\"interventionCode\": \"WEEK6\", \"armCode\": \"BAsELINEONCE\"},
                {\"period\":45, \"from_registration\" : true, \"parentIntervention\": null,\"interventionCode\": \"HUFF6\", \"armCode\": \"BAsELINEONCE\"}
                ]}' WHERE `study_code` LIKE 'datingtoday%';
                ");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

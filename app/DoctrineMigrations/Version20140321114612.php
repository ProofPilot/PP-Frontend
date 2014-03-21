<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140321114612 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("
                ALTER TABLE `new-proofpilot`.`study`
                ADD COLUMN `study_intervention_start`  TEXT NULL;
            				");
        
        $this->addSql("
                UPDATE `new-proofpilot`.`study` SET `study_intervention_start` = '{\"interventions\":[
                                                                                        {\"period\":7, \"from_registration\" : true, \"parentIntervention\": null, \"interventionCode\": \"WEEK1\", \"armCode\": \"BAsELINEONCE\"},
                                                                                        {\"period\":7, \"from_registration\" : true, \"parentIntervention\": null,\"interventionCode\": \"REFER2\", \"armCode\": \"BAsELINEONCE\"},
                                                                                        {\"period\":10, \"from_registration\" : true, \"parentIntervention\": null,\"interventionCode\": \"HUFF1\", \"armCode\": \"BAsELINEONCE\"},
                                                                                        {\"period\":14, \"from_registration\" : true, \"parentIntervention\": null,\"interventionCode\": \"WEEK2\", \"armCode\": \"BAsELINEONCE\"},
                                                                                        {\"period\":14, \"from_registration\" : true, \"parentIntervention\": null,\"interventionCode\": \"HUFF2\", \"armCode\": \"BAsELINEONCE\"},
                                                                                        {\"period\":14, \"from_registration\" : true, \"parentIntervention\": null,\"interventionCode\": \"WEEK3\", \"armCode\": \"BAsELINEONCE\"},
                                                                                        {\"period\":14, \"from_registration\" : true, \"parentIntervention\": null,\"interventionCode\": \"HUFF3\", \"armCode\": \"BAsELINEONCE\"},
                                                                                        {\"period\":14, \"from_registration\" : true, \"parentIntervention\": null,\"interventionCode\": \"WEEK4\", \"armCode\": \"BAsELINEONCE\"},
                                                                                        {\"period\":14, \"from_registration\" : true, \"parentIntervention\": null,\"interventionCode\": \"HUFF4\", \"armCode\": \"BAsELINEONCE\"},
                                                                                        {\"period\":14, \"from_registration\" : true, \"parentIntervention\": null,\"interventionCode\": \"WEEK5\", \"armCode\": \"BAsELINEONCE\"},
                                                                                        {\"period\":14, \"from_registration\" : true, \"parentIntervention\": null,\"interventionCode\": \"HUFF5\", \"armCode\": \"BAsELINEONCE\"},
                                                                                        {\"period\":14, \"from_registration\" : true, \"parentIntervention\": null,\"interventionCode\": \"WEEK6\", \"armCode\": \"BAsELINEONCE\"},
                                                                                        {\"period\":14, \"from_registration\" : true, \"parentIntervention\": null,\"interventionCode\": \"HUFF6\", \"armCode\": \"BAsELINEONCE\"}
                                                                                  ]}' WHERE `study_code` LIKE 'datingtoday%';
                UPDATE `new-proofpilot`.`study` SET `study_intervention_start` = '{\"interventions\":[
                                                                                        {\"period\":1, \"from_registration\" : true, \"parentIntervention\": null, \"interventionCode\": \"KOCTechnologyUseSurvey\", \"armCode\": \"KOCCondomTrainingArm\"},
                                                                                        {\"period\":1, \"from_registration\" : true, \"parentIntervention\": null, \"interventionCode\": \"KOCTechnologyUseSurvey\", \"armCode\": \"KOCNoTrainingArm\"},
                                                                                        {\"period\":1, \"from_registration\" : true, \"parentIntervention\": null, \"interventionCode\": \"KOCTechnologyUseSurvey\", \"armCode\": \"KOCOnlineOnlyArm\"},
                                                                                        {\"period\":3, \"from_registration\" : false, \"parentIntervention\": \"KOCTechnologyUseSurvey\", \"interventionCode\": \"KOCCondomPick-UpSurvey\", \"armCode\": \"KOCCondomTrainingArm\"},
                                                                                        {\"period\":3, \"from_registration\" : false, \"parentIntervention\": \"KOCTechnologyUseSurvey\", \"interventionCode\": \"KOCCondomPick-UpSurvey\", \"armCode\": \"KOCNoTrainingArm\"},
                                                                                        {\"period\":3, \"from_registration\" : false, \"parentIntervention\": \"KOCTechnologyUseSurvey\", \"interventionCode\": \"KOCCondomPick-UpSurvey\", \"armCode\": \"KOCOnlineOnlyArm\"},
                                                                                        {\"period\":30, \"from_registration\" : true, \"parentIntervention\": null, \"interventionCode\": \"KOCFollow-UpSurvey\", \"armCode\": \"KOCCondomTrainingArm\"},
                                                                                        {\"period\":30, \"from_registration\" : true, \"parentIntervention\": null, \"interventionCode\": \"KOCFollow-UpSurvey\", \"armCode\": \"KOCNoTrainingArm\"},
                                                                                        {\"period\":30, \"from_registration\" : true, \"parentIntervention\": null, \"interventionCode\": \"KOCFollow-UpSurvey\", \"armCode\": \"KOCOnlineOnlyArm\"}
                                                                                   ]}' WHERE `study_code` LIKE 'koc%';
                UPDATE `new-proofpilot`.`study` SET `study_intervention_start` = '{\"interventions\":[
                                                                                        {\"period\":14, \"from_registration\" : true, \"parentIntervention\": null, \"interventionCode\": \"Pledge\", \"armCode\": \"Apledge\"}
                                                                                   ]}' WHERE `study_code` LIKE 'pledgetotest%';
                ");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

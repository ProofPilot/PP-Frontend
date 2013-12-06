<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131206103945 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `new_proofpilot`.`study` ADD COLUMN `register_proccess` TINYINT NOT NULL AFTER `study_code`;");
        
        $this->addSql("CREATE  TABLE IF NOT EXISTS `new_proofpilot`.`grade_level` (
                `grade_level_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                `grade_level_name` VARCHAR(50) NOT NULL ,
                PRIMARY KEY (`grade_level_id`))
                ENGINE = InnoDB");
        $this->addSql("CREATE  TABLE IF NOT EXISTS `new_proofpilot`.`industry` (
                `industry_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                `industry_name` VARCHAR(50) NOT NULL ,
                PRIMARY KEY (`industry_id`))
                ENGINE = InnoDB");
        $this->addSql("CREATE  TABLE IF NOT EXISTS `new_proofpilot`.`currency` (
                `currency_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                `country_id` INT(10) UNSIGNED NULL, 
                `currency_name` VARCHAR(50) NULL ,
                PRIMARY KEY (`currency_id`))
                ENGINE = InnoDB");
        $this->addSql("CREATE  TABLE IF NOT EXISTS `new_proofpilot`.`marital_status` (
                `marital_status_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                `marital_status_name` VARCHAR(50) NOT NULL ,
                PRIMARY KEY (`marital_status_id`))
                ENGINE = InnoDB");
        
        $this->addSql("INSERT INTO `new_proofpilot`.`grade_level`
                       (`grade_level_name`)
                VALUES ('Elementary School'),('Some Highschool'), ('High school'), ('Associates or Professional School'), 
                       ('Some College'), ('College'), ('Graduate School'), ('PhD');");

        
        $this->addSql("INSERT INTO `new_proofpilot`.`industry`
                       (`industry_name`)
                VALUES ('Agriculture, Forestry, and Fishing'), ('Arts, Entertainment & Media'), ('Education'),
                       ('Construction, Oil&Gas, Mining'), ('Finance & Insurance'), ('Government & Public Administration'),
                       ('Health Care and Social Assistance'), (' Professional, Scientific, and Technical Services'), ('Real Estate'),
                       ('Restaurant, Hospitality & Travel'), ('Retail & Wholesale Trade'), ('Transportation & Warehousing'),
                       ('Technology');");
        
        $this->addSql("INSERT INTO `new_proofpilot`.`currency`
                       (`country_id`, `currency_name`)
                VALUES ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'US'),'US Dollar'),
                 ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'AF'),'Afghani'),
                 ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'AX'),'Euro'),
                 ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'AL'),'Lek'),
                 ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'DZ'),'Algerian Dinar'),
                 ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'AS'),'US Dollar'),
                 ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'UD'),'Euro'),
                 ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'AO'),'Kwanza'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'AI'),'East Caribbean Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'AQ'), NULL),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'US'),'East Caribbean Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'AR'),'Argentine Peso'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'AM'),'Armenian Dram'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'AW'),'Aruban Florin'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'AU'),'Australian Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'AT'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'AZ'),'Azerbaijanian Manat'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'BS'),'Bahamian Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'BH'),'Bahraini Dinar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'BD'),'Taka'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'BB'),'Barbados Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'BY'),'Belarusian Ruble'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'BE'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'BZ'),'Belize Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'BJ'),'CFA Franc BCEAO'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'BM'),'Bermudian Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'BT'),'Ngultrum'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'BO'),'Boliviano'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'BQ'),'US Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'BA'),'Convertiable Marks'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'BW'),'Pula'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'BV'),'Norwegian Krone'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'BR'),'Brazilian Real'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'Io'),'US Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'BN'),'Brunei Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'BG'),'Bulgarian Lev'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'BF'),'CFA Franc BCEAO'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'BI'),'Burundi Franc'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'KH'),'Riel'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'CM'),'CFA Franc BCEAC'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'CA'),'Canadian Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'CV'),'Cape Verde Escudo'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'KY'),'Cayman Islands Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'CF'),'CFA Franc BCEAC'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'TD'),'CFA Franc BCEAC'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'CL'),'Chilean Peso'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'CN'),'Yan Renminbi'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'CX'),'Australian Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'CC'),'Australian Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'CO'),'Colombian Peso'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'KM'),'Comoro Franc'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'CG'),'CFA Franc BCEAC'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'CD'),'Franc Congolais'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'CK'),'New Zealand Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'CR'),'Costa Rican Colon'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'СI'),'CFA Franc BCEAO'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'HR'),'Croatian Kuna'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'СU'),'Cuban Peso'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'СW'),'Netherlands Antillean Guilder'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'СY'),'Cyprus Pound'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'СZ'),'Czech Koruna'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'DK'),'Danish Krone'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'СJ'),'Djibouti Franc'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'DM'),'East Caribbean Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'DO'),'Dominican Peso'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'EC'),'US DOllar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'EG'),'Egyptian Pound'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'SV'),'El Salvador Colon'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'GQ'),'CFA Franc BCEAC'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'ER'),'Nakfa'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'EE'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'ET'),'Ethiopian Birr'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'FK'),'Falkland Islands Pound'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'FO'),'Danish Krone'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'FJ'),'Fiji Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'FI'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'FR'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'GF'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'PF'),'CFP Franc'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'TF'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'GA'),'CFA Franc BCEAC'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'GM'),'Dalasi'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'GE'),'Lari'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'DE'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'GH'),'Ghana Cedi'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'GI'),'Gibraltar Pound'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'GR'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'GL'),'Danish Krone'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'GD'),'East Karibean Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'GP'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'GU'),'US Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'GT'),'Quetzal'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'GG'),'Pound Sterling'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'GN'),'Guinea Franc'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'GW'),'Guinea-Bissau Peso'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'GY'),'Guyana Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'HT'),'Gourde'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'HM'),'Australian Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'VA'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'HN'),'Lempira'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'HK'),'Hong Kong Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'HU'),'Forint'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'IS'),'Icelnad Krona'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'IN'),'Indian Rupee'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'ID'),'Rupiah'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'IR'),'Iranian Rial'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'IQ'),'Iraqi Dinar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'IE'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'IM'),'Pound Sterling'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'IL'),'New Israeli Sheqel'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'IT'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'JM'),'Jamaican Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'JP'),'Yen'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'JE'),'Pound Sterling'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'JO'),'Jordanian Dinar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'KZ'),'Tenge'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'KE'),'Kenyan Shilling'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'KI'),'Australian Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'KP'),'North Korean Won'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'KR'),'Won'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'KW'),'Kuwaiti Dianr'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'KG'),'Som'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'LA'),'Kip'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'LV'),'Latvian Lats'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'LB'),'Lebanese Pound'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'LS'),'Loti'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'LR'),'Liberian Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'LY'),'Libyan Dinar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'LI'),'Swiss Franc'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'LT'),'Lithuanian Litas'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'LU'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'MO'),'Pataca'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'MK'),'Denar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'MG'),'Malagasy Ariary'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'MW'),'Kwacha'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'MY'),'Malaysian Ringgit'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'MV'),'Rufiyaa'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'ML'),'CFA Franc BCEAO'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'MT'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'MH'),'US Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'MQ'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'MR'),'Ouguiya'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'MU'),'Mauritius Rupee'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'YT'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'MX'),'Mexican Peso'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'FM'),'US Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'MD'),'Moldovan Leu'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'MC'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'MN'),'Tugrik'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'ME'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'MS'),'East Carribean Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'MA'),'Moroccan Dirtham'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'MZ'),'Mozambique Metical'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'MM'),'Kyat'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'NA'),'Namibian Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'NR'),'Australian Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'NP'),'Nepalese Rupee'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'NL'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'NC'),'CFP Franc'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'NZ'),'New Zealand Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'NI'),'Cordoba Oro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'NE'),'CFA Franc BCEAO'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'NG'),'Naira'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'NU'),'New Zealand Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'NF'),'Australian Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'MP'),'US Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'NO'),'Norwegian Krone'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'OM'),'Omani Rial'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'PK'),'Pakistan Rupee'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'PW'),'US DOllar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'PS'), NULL),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'PA'),'Balboa'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'PG'),'Kina'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'PY'),'Guarani'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'PE'),'Nuevo Sol'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'PH'),'Philippine Peso'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'PN'),'New Zealand Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'PL'),'Zloty'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'PT'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'PR'),'US Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'QA'),'Qatari Rial'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'RE'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'RO'),'New Romanian Leu'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'RU'),'Russian Ruble'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'RW'), 'Rwanda Franc'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'BL'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'SH'),'Saint Helena Pound'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'KN'),'East Caribbean Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'LC'),'East Caribbean Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'MF'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'PM'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'VC'),'East Caribean Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'WS'),'Tala'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'SM'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'ST'),'Dobra'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'SA'),'Saudi Riyal'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'SN'),'CFA Franc BCEAO'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'RS'),'Serbian Dinar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'SC'),'Seychelles Rupee'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'SL'),'Leone'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'SG'),'Singapore Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'SX'),'Netherlands Antillean Guilder'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'SK'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'SI'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'SB'),'Solomon Islands Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'SO'),'Somali Shilling'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'ZA'),'Rand'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'GS'), NULL),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'SS'),'South Sudnese Pound'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'ES'),'Euro'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'LK'),'Sri Lanka Rupee'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'SD'),'Sudanese Pound'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'SR'),'Surinam Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'SJ'),'Norwegian Krone'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'Z'),'Lilangeni'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = ''),'Swedish Krona'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'CH'),'Swiss Franc'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'SY'),'Syrian Pound'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'TW'),'New Taiwan Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'TJ'),'Somoni'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'TZ'),'Tanzanian Shilling'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'TH'),'Baht'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'TL'),'US Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'TG'),'CFA Franc BCEAO'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'TK'),'New Zealand Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'TO'),'Paanga'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'TT'),'Trinidad and Tobago Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'TG'),'CFA Franc BCEAO'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'TN'),'Tunisian Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'TR'),'New Turkish Lira'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'TM'),'Turkmenistan New Manat'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'TC'),'US DOllar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'TV'),'Australian Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'UG'),'Uganda Shilling'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'UA'),'Htyvnia'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'AE'),'UAE Dirham'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'GB'),'Pound Sterling'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'UM'),'US Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'UY'),'Peso Uruguayo'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'UZ'),'Uzbekistan Sum'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'VU'),'Vatu'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'VE'),'Bolivar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'VN'),'Dong'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'VG'),'US Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'VI'),'US Dollar'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'WF'),'CFP Franc'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'EH'),'Moroccan Dirtham'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'YE'),'Yemeni Rial'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'ZM'),'Kwacha'),
                ((SELECT `country_id` FROM `new_proofpilot`.`country` WHERE `country_code` = 'ZW'),'Zimbabwe Dollar')
                ;");
        
        $this->addSql("INSERT INTO `new_proofpilot`.`marital_status`
                       (`marital_status_name`)
                VALUES ('Married'), ('Single'), ('In a relationship but not married'),
                       ('In a relationship'), ('Engaded'), ('In an open relationship'), ('it\'s complicated'), ('Separated'), ('Divorced'),
                       ('Widowed');");
        
        $this->addSql("ALTER TABLE `new_proofpilot`.`participant` ADD COLUMN `grade_level_id` INT(10) UNSIGNED NULL AFTER `participant_language`,
                       ADD CONSTRAINT `fk_particpant_grade_level`
                       FOREIGN KEY (`grade_level_id`) 
                       REFERENCES `new_proofpilot`.`grade_level` (`grade_level_id`) 
                       ON DELETE NO ACTION 
                       ON UPDATE NO ACTION;");
        $this->addSql("ALTER TABLE `new_proofpilot`.`participant` ADD COLUMN `industry_id` INT(10) UNSIGNED NULL AFTER `grade_level_id`,
                       ADD CONSTRAINT `fk_particpant_industry`
                       FOREIGN KEY (`industry_id`) 
                       REFERENCES `new_proofpilot`.`industry` (`industry_id`) 
                       ON DELETE NO ACTION 
                       ON UPDATE NO ACTION;");
        $this->addSql("ALTER TABLE `new_proofpilot`.`participant` ADD COLUMN `currency_id`  INT(10) UNSIGNED NULL AFTER `industry_id`,
                       ADD CONSTRAINT `fk_particpant_currency`
                       FOREIGN KEY (`currency_id`) 
                       REFERENCES `new_proofpilot`.`currency` (`currency_id`) 
                       ON DELETE NO ACTION 
                       ON UPDATE NO ACTION;");
        $this->addSql("ALTER TABLE `new_proofpilot`.`participant` ADD COLUMN `marital_status_id` INT(10) UNSIGNED NULL AFTER `currency_id`,
                       ADD CONSTRAINT `fk_particpant_marital_status`
                       FOREIGN KEY (`marital_status_id`) 
                       REFERENCES `new_proofpilot`.`marital_status` (`marital_status_id`) 
                       ON DELETE NO ACTION 
                       ON UPDATE NO ACTION;");
        $this->addSql("ALTER TABLE `new_proofpilot`.`participant` ADD COLUMN `participant_annual_income` INT NULL AFTER `marital_status_id`;");
        $this->addSql("ALTER TABLE `new_proofpilot`.`participant` ADD COLUMN `participant_children` INT NULL AFTER `participant_annual_income`;");
        

        
    }
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `new_proofpilot`.`study` DROP COLUMN `study_code` ;");
        
        $this->addSql("DROP  TABLE IF EXISTS `proofpilot`.`grade_level`");
        $this->addSql("DROP  TABLE IF EXISTS `proofpilot`.`industry`");
        $this->addSql("DROP  TABLE IF EXISTS `proofpilot`.`currency`");
        $this->addSql("DROP  TABLE IF EXISTS `proofpilot`.`marital_status`");
      
        $this->addSql("ALTER TABLE `new_proofpilot`.`participant` DROP COLUMN `grade_level`;");
        $this->addSql("ALTER TABLE `new_proofpilot`.`participant` DROP COLUMN `industry`;");
        $this->addSql("ALTER TABLE `new_proofpilot`.`participant` DROP COLUMN `currency`;");
        $this->addSql("ALTER TABLE `new_proofpilot`.`participant` DROP COLUMN `marital_status`;");
        $this->addSql("ALTER TABLE `new_proofpilot`.`participant` DROP COLUMN `participant_annual_income`;");
        $this->addSql("ALTER TABLE `new_proofpilot`.`participant` DROP COLUMN `participant_children`;");
    }
}

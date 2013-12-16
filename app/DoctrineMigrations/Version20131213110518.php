<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131213110518 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("DROP  TABLE IF EXISTS `new-proofpilot`.`currency`");
        
        $this->addSql("CREATE  TABLE IF NOT EXISTS `new-proofpilot`.`currency` (
                `currency_code` VARCHAR(10) NOT NULL,
                `currency_name` VARCHAR(50) NULL ,
                `currency_symbol` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
                PRIMARY KEY (`currency_code`))
                ENGINE = InnoDB");
        
        $this->addSql("INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Albania Lek','ALL',N'Lek');
                       INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Afghanistan Afghani','AFN',N'؋');
                       INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Argentina Peso','ARS',N'$');
                       INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Aruba Guilder','AWG',N'ƒ');
                       INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Australia Dollar','AUD',N'$');
                       INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Azerbaijan New Manat','AZN',N'ман');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Bahamas Dollar','BSD',N'$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Barbados Dollar','BBD',N'$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Belarus Ruble','BYR',N'p.');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Belize Dollar','BZD',N'BZ$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Bermuda Dollar','BMD',N'$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Bolivia Boliviano','BOB',N'\$b');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Bosnia and Herzegovina Convertible Marka','BAM',N'KM');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Botswana Pula','BWP',N'P');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Bulgaria Lev','BGN',N'лв');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Brazil Real','BRL',N'R$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Brunei Darussalam Dollar','BND',N'$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Cambodia Riel','KHR',N'៛');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Canada Dollar','CAD',N'$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Cayman Islands Dollar','KYD',N'$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Chile Peso','CLP',N'$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('China Yuan Renminbi','CNY',N'¥');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Colombia Peso','COP',N'$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Costa Rica Colon','CRC',N'₡');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Croatia Kuna','HRK',N'kn');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Cuba Peso','CUP',N'₱');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Czech Republic Koruna','CZK',N'Kč');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Denmark Krone','DKK',N'kr');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Dominican Republic Peso','DOP',N'RD$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('East Caribbean Dollar','XCD',N'$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Egypt Pound','EGP',N'£');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('El Salvador Colon','SVC',N'$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Estonia Kroon','EEK',N'kr');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Euro Member Countries','EUR',N'€');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Falkland Islands (Malvinas) Pound','FKP',N'£');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Fiji Dollar','FJD',N'$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Ghana Cedis','GHC',N'¢');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Gibraltar Pound','GIP',N'£');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Guatemala Quetzal','GTQ',N'Q');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Guernsey Pound','GGP',N'£');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Guyana Dollar','GYD',N'$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Honduras Lempira','HNL',N'L');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Hong Kong Dollar','HKD',N'$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Hungary Forint','HUF',N'Ft');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Iceland Krona','ISK',N'kr');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('India Rupee','INR',NULL);
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Indonesia Rupiah','IDR',N'Rp');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Iran Rial','IRR',N'﷼');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Isle of Man Pound','IMP',N'£');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Israel Shekel','ILS',N'₪');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Jamaica Dollar','JMD',N'J$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Japan Yen','JPY',N'¥');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Jersey Pound','JEP',N'£');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Kazakhstan Tenge','KZT',N'лв');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Korea (North) Won','KPW',N'₩');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Korea (South) Won','KRW',N'₩');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Kyrgyzstan Som','KGS',N'лв');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Laos Kip','LAK',N'₭');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Latvia Lat','LVL',N'Ls');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Lebanon Pound','LBP',N'£');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Liberia Dollar','LRD',N'$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Lithuania Litas','LTL',N'Lt');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Macedonia Denar','MKD',N'ден');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Malaysia Ringgit','MYR',N'RM');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Mauritius Rupee','MUR',N'₨');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Mexico Peso','MXN',N'$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Mongolia Tughrik','MNT',N'₮');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Mozambique Metical','MZN',N'MT');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Namibia Dollar','NAD',N'$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Nepal Rupee','NPR',N'₨');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Netherlands Antilles Guilder','ANG',N'ƒ');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('New Zealand Dollar','NZD',N'$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Nicaragua Cordoba','NIO',N'C$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Nigeria Naira','NGN',N'₦');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Norway Krone','NOK',N'kr');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Oman Rial','OMR',N'﷼');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Pakistan Rupee','PKR',N'₨');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Panama Balboa','PAB',N'B/.');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Paraguay Guarani','PYG',N'Gs');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Peru Nuevo Sol','PEN',N'S/.');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Philippines Peso','PHP',N'₱');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Poland Zloty','PLN',N'zł');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Qatar Riyal','QAR',N'﷼');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Romania New Leu','RON',N'lei');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Russia Ruble','RUB',N'руб');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Saint Helena Pound','SHP',N'£');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Saudi Arabia Riyal','SAR',N'﷼');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Serbia Dinar','RSD',N'Дин.');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Seychelles Rupee','SCR',N'₨');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Singapore Dollar','SGD',N'$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Solomon Islands Dollar','SBD',N'$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Somalia Shilling','SOS',N'S');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('South Africa Rand','ZAR',N'R');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Sri Lanka Rupee','LKR',N'₨');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Sweden Krona','SEK',N'kr');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Switzerland Franc','CHF',N'CHF');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Suriname Dollar','SRD',N'$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Syria Pound','SYP',N'£');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Taiwan New Dollar','TWD',N'NT$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Thailand Baht','THB',N'฿');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Trinidad and Tobago Dollar','TTD',N'TT$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Turkey Lira','TRY',NULL);
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Turkey Lira','TRL',N'₤');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Tuvalu Dollar','TVD',N'$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Ukraine Hryvna','UAH',N'₴');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('United Kingdom Pound','GBP',N'£');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('United States Dollar','USD',N'$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Uruguay Peso','UYU',N'\$U');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Uzbekistan Som','UZS',N'лв');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Venezuela Bolivar','VEF',N'Bs');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Viet Nam Dong','VND',N'₫');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Yemen Rial','YER',N'﷼');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Zimbabwe Dollar','ZWD',N'Z$');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Algerian Dinar','DZD',N'د.ج');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Armenia Dram','AMD',N'֏');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Bahraini dinar','BHD',N'.د.ب');
                        INSERT INTO `new-proofpilot`.`currency` (`currency_name`,`currency_code`,`currency_symbol`) VALUES ('Bangladeshi taka','BDT',N'৳');");
    
        $this->addSql("ALTER TABLE `new-proofpilot`.`country` ADD COLUMN `currency_code` VARCHAR(10) NULL AFTER `dialing_code`,
                ADD CONSTRAINT `fk_country_currency_code`
                FOREIGN KEY (`currency_code`)
                REFERENCES `new-proofpilot`.`currency` (`currency_code`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION;");
        
        $this->addSql("UPDATE `new-proofpilot`.`country` SET `currency_code` = 'NZD' WHERE `country_code` LIKE '%NZ';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'NZD' WHERE `country_code` LIKE '%CK';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'NZD' WHERE `country_code` LIKE '%NU';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'NZD' WHERE `country_code` LIKE '%PN';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'NZD' WHERE `country_code` LIKE '%TK';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'AUD' WHERE `country_code` LIKE '%AU';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'AUD' WHERE `country_code` LIKE '%CX';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'AUD' WHERE `country_code` LIKE '%CC';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'AUD' WHERE `country_code` LIKE '%HM';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'AUD' WHERE `country_code` LIKE '%KI';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'AUD' WHERE `country_code` LIKE '%NR';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'AUD' WHERE `country_code` LIKE '%NF';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'AUD' WHERE `country_code` LIKE '%TV';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%AS';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%AD';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%AT';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%BE';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%FI';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%FR';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%GF';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%TF';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%DE';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%GR';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%GP';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%IE';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%IT';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%LU';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%MQ';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%YT';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%MC';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%NL';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%PT';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%RE';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%WS';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%SM';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%SI';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%ES';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%VA';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'GBP' WHERE `country_code` LIKE '%GS';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'GBP' WHERE `country_code` LIKE '%GB';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'GBP' WHERE `country_code` LIKE '%JE';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'USD' WHERE `country_code` LIKE '%IO';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'USD' WHERE `country_code` LIKE '%GU';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'USD' WHERE `country_code` LIKE '%MH';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'USD' WHERE `country_code` LIKE '%FM';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'USD' WHERE `country_code` LIKE '%MP';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'USD' WHERE `country_code` LIKE '%PW';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'USD' WHERE `country_code` LIKE '%PR';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'USD' WHERE `country_code` LIKE '%TC';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'USD' WHERE `country_code` LIKE '%US';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'USD' WHERE `country_code` LIKE '%UM';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'USD' WHERE `country_code` LIKE '%VG';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'USD' WHERE `country_code` LIKE '%VI';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'HKD' WHERE `country_code` LIKE '%HK';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'CAD' WHERE `country_code` LIKE '%CA';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'JPY' WHERE `country_code` LIKE '%JP';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'AFN' WHERE `country_code` LIKE '%AF';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'ALL' WHERE `country_code` LIKE '%AL';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'DZD' WHERE `country_code` LIKE '%DZ';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'XCD' WHERE `country_code` LIKE '%AI';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'XCD' WHERE `country_code` LIKE '%AG';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'XCD' WHERE `country_code` LIKE '%DM';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'XCD' WHERE `country_code` LIKE '%GD';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'XCD' WHERE `country_code` LIKE '%MS';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'XCD' WHERE `country_code` LIKE '%KN';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'XCD' WHERE `country_code` LIKE '%LC';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'XCD' WHERE `country_code` LIKE '%VC';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'ARS' WHERE `country_code` LIKE '%AR';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'AMD' WHERE `country_code` LIKE '%AM';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'ANG' WHERE `country_code` LIKE '%AW';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'ANG' WHERE `country_code` LIKE '%AN';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'AZN' WHERE `country_code` LIKE '%AZ';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'BSD' WHERE `country_code` LIKE '%BS';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'BHD' WHERE `country_code` LIKE '%BH';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'BDT' WHERE `country_code` LIKE '%BD';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'BBD' WHERE `country_code` LIKE '%BB';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'BYR' WHERE `country_code` LIKE '%BY';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'BZD' WHERE `country_code` LIKE '%BZ';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'BMD' WHERE `country_code` LIKE '%BM';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'INR' WHERE `country_code` LIKE '%BT';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'INR' WHERE `country_code` LIKE '%IN';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'BOB' WHERE `country_code` LIKE '%BO';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'BWP' WHERE `country_code` LIKE '%BW';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'NOK' WHERE `country_code` LIKE '%BV';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'NOK' WHERE `country_code` LIKE '%NO';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'NOK' WHERE `country_code` LIKE '%SJ';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'BRL' WHERE `country_code` LIKE '%BR';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'BND' WHERE `country_code` LIKE '%BN';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'BGN' WHERE `country_code` LIKE '%BG';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'KHR' WHERE `country_code` LIKE '%KH';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'KYD' WHERE `country_code` LIKE '%KY';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'CLP' WHERE `country_code` LIKE '%CL';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'CNY' WHERE `country_code` LIKE '%CN';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'COP' WHERE `country_code` LIKE '%CO';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'CRC' WHERE `country_code` LIKE '%CR';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'HRK' WHERE `country_code` LIKE '%HR';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'CUP' WHERE `country_code` LIKE '%CU';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'CZK' WHERE `country_code` LIKE '%CZ';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'DKK' WHERE `country_code` LIKE '%DK';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'DKK' WHERE `country_code` LIKE '%FO';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'DKK' WHERE `country_code` LIKE '%GL';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'DOP' WHERE `country_code` LIKE '%DO';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'IDR' WHERE `country_code` LIKE '%TP';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'IDR' WHERE `country_code` LIKE '%ID';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EGP' WHERE `country_code` LIKE '%EG';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'SVC' WHERE `country_code` LIKE '%SV';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EEK' WHERE `country_code` LIKE '%EE';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'FKP' WHERE `country_code` LIKE '%FK';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'FJD' WHERE `country_code` LIKE '%FJ';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'GIP' WHERE `country_code` LIKE '%GI';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'GTQ' WHERE `country_code` LIKE '%GT';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'GYD' WHERE `country_code` LIKE '%GY';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'HNL' WHERE `country_code` LIKE '%HN';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'HUF' WHERE `country_code` LIKE '%HU';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'ISK' WHERE `country_code` LIKE '%IS';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'IRR' WHERE `country_code` LIKE '%IR';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'ILS' WHERE `country_code` LIKE '%IL';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'JMD' WHERE `country_code` LIKE '%JM';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'KZT' WHERE `country_code` LIKE '%KZ';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'KPW' WHERE `country_code` LIKE '%KP';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'KRW' WHERE `country_code` LIKE '%KR';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'KGS' WHERE `country_code` LIKE '%KG';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'LAK' WHERE `country_code` LIKE '%LA';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'LVL' WHERE `country_code` LIKE '%LV';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'LBP' WHERE `country_code` LIKE '%LB';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'LRD' WHERE `country_code` LIKE '%LR';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'CHF' WHERE `country_code` LIKE '%LI';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'CHF' WHERE `country_code` LIKE '%CH';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'LTL' WHERE `country_code` LIKE '%LT';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'MKD' WHERE `country_code` LIKE '%MK';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'MYR' WHERE `country_code` LIKE '%MY';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'MUR' WHERE `country_code` LIKE '%MU';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'MXN' WHERE `country_code` LIKE '%MX';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'MNT' WHERE `country_code` LIKE '%MN';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'MZN' WHERE `country_code` LIKE '%MZ';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'NAD' WHERE `country_code` LIKE '%NA';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'NPR' WHERE `country_code` LIKE '%NP';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'NIO' WHERE `country_code` LIKE '%NI';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'NGN' WHERE `country_code` LIKE '%NG';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'OMR' WHERE `country_code` LIKE '%OM';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'PKR' WHERE `country_code` LIKE '%PK';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'PAB' WHERE `country_code` LIKE '%PA';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'PYG' WHERE `country_code` LIKE '%PY';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'PEN' WHERE `country_code` LIKE '%PE';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'PHP' WHERE `country_code` LIKE '%PH';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'PLN' WHERE `country_code` LIKE '%PL';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'QAR' WHERE `country_code` LIKE '%QA';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'RON' WHERE `country_code` LIKE '%RO';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'RUB' WHERE `country_code` LIKE '%RU';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'SAR' WHERE `country_code` LIKE '%SA';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'SCR' WHERE `country_code` LIKE '%SC';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'SGD' WHERE `country_code` LIKE '%SG';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'SBD' WHERE `country_code` LIKE '%SB';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'SOS' WHERE `country_code` LIKE '%SO';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'ZAR' WHERE `country_code` LIKE '%ZA';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'LKR' WHERE `country_code` LIKE '%LK';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'SRD' WHERE `country_code` LIKE '%SR';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'SZL' WHERE `country_code` LIKE '%SZ';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'SEK' WHERE `country_code` LIKE '%SE';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'SYP' WHERE `country_code` LIKE '%SY';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'TWD' WHERE `country_code` LIKE '%TW';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'THB' WHERE `country_code` LIKE '%TH';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'TTD' WHERE `country_code` LIKE '%TT';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'TRY' WHERE `country_code` LIKE '%TR';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'UAH' WHERE `country_code` LIKE '%UA';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'UYU' WHERE `country_code` LIKE '%UY';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'UZS' WHERE `country_code` LIKE '%UZ';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'VEF' WHERE `country_code` LIKE '%VE';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'VND' WHERE `country_code` LIKE '%VN';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'YER' WHERE `country_code` LIKE '%YE';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'ZWD' WHERE `country_code` LIKE '%ZW';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%AX';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'BAM' WHERE `country_code` LIKE '%BA';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'GGP' WHERE `country_code` LIKE '%GG';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'GBP' WHERE `country_code` LIKE '%IM';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'LAK' WHERE `country_code` LIKE '%LA';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%ME';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%BL';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'GBP' WHERE `country_code` LIKE '%SH';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'ANG' WHERE `country_code` LIKE '%MF';
                UPDATE `new-proofpilot`.`country` SET `currency_code` = 'EUR' WHERE `country_code` LIKE '%PM';"
                );
    }
    
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}

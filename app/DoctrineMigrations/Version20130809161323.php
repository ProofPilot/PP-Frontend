<?php
/*
* This is part of the ProofPilot package.
*
* (c)2012-2013 Cyclogram, Inc, West Hollywood, CA <crew@proofpilot.com>
* ALL RIGHTS RESERVED
*
* This software is provided by the copyright holders to Manila Consulting for use on the
* Center for Disease Control's Evaluation of Rapid HIV Self-Testing among MSM in High
* Prevalence Cities until 2016 or the project is completed.
*
* Any unauthorized use, modification or resale is not permitted without expressed permission
* from the copyright holders.
*
* KnowatHome branding, URL, study logic, survey instruments, and resulting data are not part
* of this copyright and remain the property of the prime contractor.
*
*/

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20130809161323 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`country` ADD COLUMN `dialing_code`  varchar(255) NULL AFTER `country_code`;");
        $this->addSql("UPDATE `proofpilot`.`country` SET `dialing_code` = 1 WHERE `country_id`=1;");
        $this->addSql("INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('AFGHANISTAN','AF');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('ALAND ISLANDS','AX');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('ALBANIA','AL');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('ALGERIA','DZ');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('AMERICAN SAMOA','AS');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('ANDORRA','AD');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('ANGOLA','AO');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('ANGUILLA','AI');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('ANTARCTICA','AQ');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('ANTIGUA AND BARBUDA','AG');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('ARGENTINA','AR');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('ARMENIA','AM');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('ARUBA','AW');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('AUSTRALIA','AU');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('AUSTRIA','AT');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('AZERBAIJAN','AZ');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('BAHAMAS','BS');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('BAHRAIN','BH');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('BANGLADESH','BD');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('BARBADOS','BB');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('BELARUS','BY');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('BELGIUM','BE');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('BELIZE','BZ');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('BENIN','BJ');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('BERMUDA','BM');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('BHUTAN','BT');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('BOLIVIA','BO');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('BONAIRE','BQ');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('BOSNIA AND HERZEGOVINA','BA');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('BOTSWANA','BW');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('BOUVET ISLAND','BV');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`,`dialing_code`) VALUES ('BRAZIL','BR','55');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('BRITISH INDIAN OCEAN TERRITORY','IO');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('BRUNEI DARFSALAM','BN');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('BULGARIA','BG');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('BURKINA FASO','BF');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('BURUNDI','BI');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('CAMBODIA','KH');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('CAMEROON','CM');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('CANADA','CA');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('CAPE VERDE','CV');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('CAYMAN ISLANDS','KY');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('CENTRAL AFRICAN REPUBLIC','CF');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('CHAD','TD');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('CHILE','CL');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('CHINA','CN');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('CHRISTMAS ISLAND','CX');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('COCOS (KEELING) ISLANDS','CC');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('COLOMBIA','CO');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('COMOROS','KM');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('CONGO','CG');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('CONGO, THE DEMOCRATIC REPUBLIC OF THE','CD');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('COOK ISLANDS','CK');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`, `dialing_code`) VALUES ('COSTA RICA','CR', 506);
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('CÔTE D\'IVOIRE','CI');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('CROATIA','HR');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('CUBA','CU');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('CURAÇAO','CW');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('CYPRUS','CY');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('CZECH REPUBLIC','CZ');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('DENMARK','DK');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('DJIBOUTI','DJ');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('DOMINICA','DM');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('DOMINICAN REPUBLIC','DO');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('ECUADOR','EC');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('EGYPT','EG');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('EL SALVADOR','SV');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('EQUATORIAL GUINEA','GQ');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('ERITREA','ER');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('ESTONIA','EE');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('ETHIOPIA','ET');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('FALKLAND ISLANDS (MALVINAS)','FK');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('FAROE ISLANDS','FO');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('FIJI','FJ');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('FINLAND','FI');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`, `dialing_code`) VALUES ('FRANCE','FR', 33);
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('FRENCH GUIANA','GF');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('FRENCH POLYNESIA','PF');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('FRENCH SOUTHERN TERRITORIES','TF');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('GABON','GA');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('GAMBIA','GM');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('GEORGIA','GE');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('GERMANY','DE');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('GHANA','GH');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('GIBRALTAR','GI');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('GREECE','GR');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('GREENLAND','GL');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('GRENADA','GD');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('GUADELOUPE','GP');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('GUAM','GU');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('GUATEMALA','GT');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('GUERNSEY','GG');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('GUINEA','GN');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('GUINEA-BISSAU','GW');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('GUYANA','GY');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('HAITI','HT');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('HEARD ISLAND AND MCDONALD ISLANDS','HM');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('HOLY SEE (VATICAN CITY STATE)','VA');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('HONDURAS','HN');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('HONG KONG','HK');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('HUNGARY','HU');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('ICELAND','IS');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('INDIA','IN');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('INDONESIA','ID');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('IRAN, ISLAMIC REPUBLIC OF','IR');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('IRAQ','IQ');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('IRELAND','IE');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('ISLE OF MAN','IM');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('ISRAEL','IL');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('ITALY','IT');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('JAMAICA','JM');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('JAPAN','JP');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('JERSEY','JE');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('JORDAN','JO');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('KAZAKHSTAN','KZ');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('KENYA','KE');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('KIRIBATI','KI');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF','KP');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('KOREA, REPUBLIC OF','KR');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('KUWAIT','KW');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('KYRGYZSTAN','KG');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('LAO PEOPLE\'S DEMOCRATIC REPUBLIC','LA');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('LATVIA','LV');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('LEBANON','LB');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('LESOTHO','LS');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('LIBERIA','LR');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('LIBYA','LY');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('LIECHTENSTEIN','LI');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('LITHUANIA','LT');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('LUXEMBOURG','LU');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('MACAO','MO');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF','MK');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('MADAGASCAR','MG');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('MALAWI','MW');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('MALAYSIA','MY');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('MALDIVES','MV');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('MALI','ML');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('MALTA','MT');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('MARSHALL ISLANDS','MH');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('MARTINIQUE','MQ');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('MAURITANIA','MR');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('MAURITIUS','MU');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('MAYOTTE','YT');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`,`dialing_code`) VALUES ('MEXICO','MX',52);
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('MICRONESIA, FEDERATED STATES OF','FM');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('MOLDOVA, REPUBLIC OF','MD');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('MONACO','MC');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('MONGOLIA','MN');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('MONTENEGRO','ME');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('MONTSERRAT','MS');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('MOROCCO','MA');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('MOZAMBIQUE','MZ');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('MYANMAR','MM');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('NAMIBIA','NA');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('NAURU','NR');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('NEPAL','NP');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('NETHERLANDS','NL');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('NEW CALEDONIA','NC');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('NEW ZEALAND','NZ');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('NICARAGUA','NI');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('NIGER','NE');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('NIGERIA','NG');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('NIUE','NU');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('NORFOLK ISLAND','NF');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('NORTHERN MARIANA ISLANDS','MP');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('NORWAY','NO');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('OMAN','OM');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('PAKISTAN','PK');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('PALAU','PW');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('PALESTINE, STATE OF','PS');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('PANAMA','PA');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('PAPUA NEW GUINEA','PG');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('PARAGUAY','PY');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('PERU','PE');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('PHILIPPINES','PH');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('PITCAIRN','PN');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('POLAND','PL');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`, `dialing_code`) VALUES ('PORTUGAL','PT', 351);
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('PUERTO RICO','PR');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('QATAR','QA');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('RÉUNION','RE');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('ROMANIA','RO');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('RUSSIAN FEDERATION','RU');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('RWANDA','RW');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SAINT BARTHÉLEMY','BL');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SAINT HELENA, ASCENSION AND TRISTAN DA CUNHA','SH');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SAINT KITTS AND NEVIS','KN');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SAINT LUCIA','LC');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SAINT MARTIN (FRENCH PART)','MF');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SAINT PIERRE AND MIQUELON','PM');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SAINT VINCENT AND THE GRENADINES','VC');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SAMOA','WS');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SAN MARINO','SM');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SAO TOME AND PRINCIPE','ST');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SAUDI ARABIA','SA');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SENEGAL','SN');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SERBIA','RS');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SEYCHELLES','SC');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SIERRA LEONE','SL');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SINGAPORE','SG');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SINT MAARTEN (DUTCH PART)','SX');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SLOVAKIA','SK');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SLOVENIA','SI');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SOLOMON ISLANDS','SB');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SOMALIA','SO');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SOUTH AFRICA','ZA');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS','GS');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SOUTH SUDAN','SS');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`, `dialing_code`) VALUES ('SPAIN','ES', 34);
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SRI LANKA','LK');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SUDAN','SD');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SURINAME','SR');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SVALBARD AND JAN MAYEN','SJ');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SWAZILAND','Z');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SWEDEN;SE','');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SWITZERLAND','CH');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('SYRIAN ARAB REPUBLIC','SY');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('TAIWAN, PROVINCE OF CHINA','TW');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('TAJIKISTAN','TJ');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('TANZANIA, UNITED REPUBLIC OF','TZ');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('THAILAND','TH');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('TIMOR-LESTE','TL');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('TOGO','TG');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('TOKELAU','TK');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('TONGA','TO');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('TRINIDAD AND TOBAGO','TT');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('TUNISIA','TN');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('TURKEY','TR');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('TURKMENISTAN','TM');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('TURKS AND CAICOS ISLANDS','TC');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('TUVALU','TV');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('UGANDA','UG');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`, `dialing_code`) VALUES ('UKRAINE','UA', 380);
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('UNITED ARAB EMIRATES','AE');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('UNITED KINGDOM','GB');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('UNITED STATES MINOR OUTLYING ISLANDS','UM');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('URUGUAY','UY');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('UZBEKISTAN','UZ');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('VANUATU','VU');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('VENEZUELA, BOLIVARIAN REPUBLIC OF','VE');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('VIET NAM','VN');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('VIRGIN ISLANDS, BRITISH','VG');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('VIRGIN ISLANDS, U.S.','VI');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('WALLIS AND FUTUNA','WF');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('WESTERN SAHARA','EH');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('YEMEN','YE');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('ZAMBIA','ZM');
                INSERT INTO `proofpilot`.`country`(`country_name`,`country_code`) VALUES ('ZIMBABWE','ZW');");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("ALTER TABLE `proofpilot`.`country` DROP COLUMN `dialing_code`;");
    }
}

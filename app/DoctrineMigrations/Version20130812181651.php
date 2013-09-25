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
class Version20130812181651 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        $this->addSql("UPDATE `proofpilot`.`country` SET `dialing_code` = 1 WHERE `country_code`='US';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 93 WHERE `country_code`='AF';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 355 WHERE `country_code`='AL';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 213 WHERE `country_code`='DZ';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 1 WHERE `country_code`='AS';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 376 WHERE `country_code`='AD';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 244 WHERE `country_code`='AO';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 1 WHERE `country_code`='AI';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 672 WHERE `country_code`='AQ';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 1 WHERE `country_code`='AG';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 54 WHERE `country_code`='AR';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 374 WHERE `country_code`='AM';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 297 WHERE `country_code`='AW';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 61 WHERE `country_code`='AU';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 43 WHERE `country_code`='AT';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 994 WHERE `country_code`='AZ';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 1 WHERE `country_code`='BS';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 973 WHERE `country_code`='BH';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 880 WHERE `country_code`='BD';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 1 WHERE `country_code`='BB';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 375 WHERE `country_code`='BY';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 32 WHERE `country_code`='BE';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 501 WHERE `country_code`='BZ';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 229 WHERE `country_code`='BJ';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 1 WHERE `country_code`='BM';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 975 WHERE `country_code`='BT';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 591 WHERE `country_code`='BO';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 387 WHERE `country_code`='BA';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 276 WHERE `country_code`='BW';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 55 WHERE `country_code`='BR';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 973 WHERE `country_code`='BN';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 359 WHERE `country_code`='BG';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 226 WHERE `country_code`='BF';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 257 WHERE `country_code`='BI';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 855 WHERE `country_code`='KH';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 237 WHERE `country_code`='CM';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 1 WHERE `country_code`='CA';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 238 WHERE `country_code`='CV';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 1 WHERE `country_code`='KY';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 236 WHERE `country_code`='CF';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 235 WHERE `country_code`='TD';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 56 WHERE `country_code`='CL';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 68 WHERE `country_code`='CN';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 61 WHERE `country_code`='CX';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 57 WHERE `country_code`='CO';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 269 WHERE `country_code`='KM';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 682 WHERE `country_code`='CK';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 506 WHERE `country_code`='CR';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 226 WHERE `country_code`='CI';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 385 WHERE `country_code`='HR';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 53 WHERE `country_code`='CU';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 357 WHERE `country_code`='CY';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 420 WHERE `country_code`='CZ';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 45 WHERE `country_code`='DK';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 253 WHERE `country_code`='DJ';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 1 WHERE `country_code`='DM';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 809 WHERE `country_code`='DO';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 593 WHERE `country_code`='EC';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 20 WHERE `country_code`='EG';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 503 WHERE `country_code`='SV';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 240 WHERE `country_code`='GQ';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 291 WHERE `country_code`='ER';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 372 WHERE `country_code`='EE';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 251 WHERE `country_code`='ET';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 500 WHERE `country_code`='FK';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 298 WHERE `country_code`='FO';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 679 WHERE `country_code`='FJ';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 358 WHERE `country_code`='FI';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 33 WHERE `country_code`='FR';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 689 WHERE `country_code`='PF';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 241 WHERE `country_code`='GA';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 220 WHERE `country_code`='GM';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 995 WHERE `country_code`='GE';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 49 WHERE `country_code`='DE';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 233 WHERE `country_code`='GH';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 350 WHERE `country_code`='GI';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 30 WHERE `country_code`='GR';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 299 WHERE `country_code`='GL';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 1 WHERE `country_code`='GD';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 1 WHERE `country_code`='GP';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 1 WHERE `country_code`='GU';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 502 WHERE `country_code`='GT';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 592 WHERE `country_code`='GY';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 509 WHERE `country_code`='HT';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 39 WHERE `country_code`='VA';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 504 WHERE `country_code`='HN';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 852 WHERE `country_code`='HK';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 36 WHERE `country_code`='HU';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 354 WHERE `country_code`='IS';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 91 WHERE `country_code`='IN';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 62 WHERE `country_code`='ID';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 98 WHERE `country_code`='IR';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 964 WHERE `country_code`='IQ';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 353 WHERE `country_code`='IE';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 44 WHERE `country_code`='IM';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 972 WHERE `country_code`='IL';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 39 WHERE `country_code`='IT';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 1 WHERE `country_code`='JM';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 81 WHERE `country_code`='JP';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 962 WHERE `country_code`='JO';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 7 WHERE `country_code`='KZ';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 254 WHERE `country_code`='KE';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 986 WHERE `country_code`='KI';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 950 WHERE `country_code`='KP';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 82 WHERE `country_code`='KR';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 965 WHERE `country_code`='KW';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 996 WHERE `country_code`='KG';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 865 WHERE `country_code`='LA';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 371 WHERE `country_code`='LV';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 961 WHERE `country_code`='LB';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 266 WHERE `country_code`='LS';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 231 WHERE `country_code`='LR';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 218 WHERE `country_code`='LY';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 423 WHERE `country_code`='LI';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 370 WHERE `country_code`='LT';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 352 WHERE `country_code`='LU';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 853 WHERE `country_code`='MO';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 389 WHERE `country_code`='MK';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 960 WHERE `country_code`='MY';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 960 WHERE `country_code`='MV';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 223 WHERE `country_code`='MT';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 52 WHERE `country_code`='MX';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 1 WHERE `country_code`='MS';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 212 WHERE `country_code`='MA';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 977 WHERE `country_code`='NP';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 31 WHERE `country_code`='NL';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 64 WHERE `country_code`='NZ';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 505 WHERE `country_code`='NI';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 227 WHERE `country_code`='NE';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 234 WHERE `country_code`='NG';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 47 WHERE `country_code`='NO';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 92 WHERE `country_code`='PK';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 507 WHERE `country_code`='PA';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 51 WHERE `country_code`='PE';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 63 WHERE `country_code`='PH';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 48 WHERE `country_code`='PL';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 351 WHERE `country_code`='PT';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 1 WHERE `country_code`='PR';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 40 WHERE `country_code`='RO';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 7 WHERE `country_code`='RU';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 250 WHERE `country_code`='RW';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 290 WHERE `country_code`='SH';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 1 WHERE `country_code`='KN';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 1 WHERE `country_code`='LC';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 1 WHERE `country_code`='MF';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 508 WHERE `country_code`='PM';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 966 WHERE `country_code`='SA';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 381 WHERE `country_code`='RS';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 421 WHERE `country_code`='SK';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 386 WHERE `country_code`='SI';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 27 WHERE `country_code`='ZA';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 34 WHERE `country_code`='ES';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 41 WHERE `country_code`='CH';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 992 WHERE `country_code`='TJ';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 66 WHERE `country_code`='TH';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 1 WHERE `country_code`='TT';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 90 WHERE `country_code`='TR';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 380 WHERE `country_code`='UA';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 971 WHERE `country_code`='AE';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 44 WHERE `country_code`='GB';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 1 WHERE `country_code`='UM';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 598 WHERE `country_code`='UY';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 58 WHERE `country_code`='VE';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 84 WHERE `country_code`='VN';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 1 WHERE `country_code`='VG';
                        UPDATE `proofpilot`.`country` SET `dialing_code` = 1 WHERE `country_code`='VI';");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

    }
}

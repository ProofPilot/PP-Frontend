<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131008133859 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("INSERT INTO device (device_udid, device_token, device_desc, device_used, study_id, status_id) VALUES ('c5fafdea-d135-4a68-9ee4-4e2ec084a10d', NULL, 'Ross', 0, 1, 1)");
    	$this->addSql("INSERT INTO device (device_udid, device_token, device_desc, device_used, study_id, status_id) VALUES ('a9536c95-cb0b-48e9-9d5a-a2df1ccb382a', NULL, 'Dmytro', 0, 1, 1)");
    	$this->addSql("INSERT INTO device (device_udid, device_token, device_desc, device_used, study_id, status_id) VALUES ('97ce163f-9df8-4fc5-aa31-f179cf6a1f0a', NULL, 'Ernesto', 0, 1, 1)");
    	$this->addSql("INSERT INTO device (device_udid, device_token, device_desc, device_used, study_id, status_id) VALUES ('175ce358-65b9-4f95-b2ee-a07f120d0268', NULL, 'Jose Pablo', 0, 1, 1)");
    	$this->addSql("INSERT INTO device (device_udid, device_token, device_desc, device_used, study_id, status_id) VALUES ('10133379-2398-4aa9-ba03-45374759b0bd', NULL, 'Mike', 0, 1, 1)");

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
    	$this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
    	$this->addSql("DELETE FROM device WHERE device_udid IN ('c5fafdea-d135-4a68-9ee4-4e2ec084a10d','a9536c95-cb0b-48e9-9d5a-a2df1ccb382a','97ce163f-9df8-4fc5-aa31-f179cf6a1f0a','175ce358-65b9-4f95-b2ee-a07f120d0268')");
    }
}

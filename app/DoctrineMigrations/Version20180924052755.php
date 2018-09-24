<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180924052755 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE User ADD status VARCHAR(20) DEFAULT NULL, CHANGE last_update_date_time last_update_date_time DATETIME NOT NULL, CHANGE created_date_time created_date_time DATETIME NOT NULL');
        $this->addSql('ALTER TABLE UserPhone CHANGE last_update_date_time last_update_date_time DATETIME NOT NULL, CHANGE created_date_time created_date_time DATETIME NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E9116C85BB827337 ON revenue (year)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E9116C851C81E107 ON revenue (quarter)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E9116C85E9116C85 ON revenue (revenue)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE User DROP status, CHANGE last_update_date_time last_update_date_time DATETIME DEFAULT NULL, CHANGE created_date_time created_date_time DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE UserPhone CHANGE last_update_date_time last_update_date_time DATETIME DEFAULT NULL, CHANGE created_date_time created_date_time DATETIME DEFAULT NULL');
        $this->addSql('DROP INDEX UNIQ_E9116C85BB827337 ON revenue');
        $this->addSql('DROP INDEX UNIQ_E9116C851C81E107 ON revenue');
        $this->addSql('DROP INDEX UNIQ_E9116C85E9116C85 ON revenue');
    }
}

<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180921092421 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE TwilioLog (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, phone VARCHAR(20) DEFAULT NULL, otp VARCHAR(20) DEFAULT NULL, last_update_date_time DATETIME NOT NULL, created_date_time DATETIME NOT NULL, INDEX IDX_B16E5F14A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE User (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, last VARCHAR(255) NOT NULL, otp VARCHAR(20) DEFAULT NULL, last_update_date_time DATETIME NOT NULL, created_date_time DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE UserPhone (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, phone VARCHAR(20) DEFAULT NULL, status VARCHAR(20) DEFAULT NULL, last_update_date_time DATETIME NOT NULL, created_date_time DATETIME NOT NULL, INDEX IDX_20DB06A8A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE TwilioLog ADD CONSTRAINT FK_B16E5F14A76ED395 FOREIGN KEY (user_id) REFERENCES User (id)');
        $this->addSql('ALTER TABLE UserPhone ADD CONSTRAINT FK_20DB06A8A76ED395 FOREIGN KEY (user_id) REFERENCES User (id)');
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

        $this->addSql('ALTER TABLE TwilioLog DROP FOREIGN KEY FK_B16E5F14A76ED395');
        $this->addSql('ALTER TABLE UserPhone DROP FOREIGN KEY FK_20DB06A8A76ED395');
        $this->addSql('DROP TABLE TwilioLog');
        $this->addSql('DROP TABLE User');
        $this->addSql('DROP TABLE UserPhone');
        $this->addSql('DROP INDEX UNIQ_E9116C85BB827337 ON revenue');
        $this->addSql('DROP INDEX UNIQ_E9116C851C81E107 ON revenue');
        $this->addSql('DROP INDEX UNIQ_E9116C85E9116C85 ON revenue');
    }
}

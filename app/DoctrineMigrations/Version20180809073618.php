<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180809073618 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, fk_productLineType VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_line_types (id INT AUTO_INCREMENT NOT NULL, fk_productLine INT NOT NULL, fk_productType INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE revenue (id INT AUTO_INCREMENT NOT NULL, fk_products INT NOT NULL, fk_retailerCountry INT NOT NULL, fk_retailerType INT NOT NULL, fk_orderMode INT NOT NULL, year SMALLINT NOT NULL, quarter SMALLINT NOT NULL, revenue VARCHAR(255) NOT NULL, quantity INT NOT NULL, grossMargin VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E9116C85BB827337 (year), UNIQUE INDEX UNIQ_E9116C851C81E107 (quarter), UNIQUE INDEX UNIQ_E9116C85E9116C85 (revenue), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_line_types');
        $this->addSql('DROP TABLE revenue');
    }
}

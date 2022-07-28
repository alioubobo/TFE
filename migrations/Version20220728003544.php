<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220728003544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Suppression de la table Favorites';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favorites_coaches DROP FOREIGN KEY FK_7EC99F5E84DDC6B4');
        $this->addSql('ALTER TABLE favorites_customers DROP FOREIGN KEY FK_BD8210D184DDC6B4');
        $this->addSql('CREATE TABLE coaches_customers (coaches_id INT NOT NULL, customers_id INT NOT NULL, INDEX IDX_1AC682E0A9600977 (coaches_id), INDEX IDX_1AC682E0C3568B40 (customers_id), PRIMARY KEY(coaches_id, customers_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coaches_customers ADD CONSTRAINT FK_1AC682E0A9600977 FOREIGN KEY (coaches_id) REFERENCES coaches (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coaches_customers ADD CONSTRAINT FK_1AC682E0C3568B40 FOREIGN KEY (customers_id) REFERENCES customers (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE favorites');
        $this->addSql('DROP TABLE favorites_coaches');
        $this->addSql('DROP TABLE favorites_customers');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favorites (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE favorites_coaches (favorites_id INT NOT NULL, coaches_id INT NOT NULL, INDEX IDX_7EC99F5EA9600977 (coaches_id), INDEX IDX_7EC99F5E84DDC6B4 (favorites_id), PRIMARY KEY(favorites_id, coaches_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE favorites_customers (favorites_id INT NOT NULL, customers_id INT NOT NULL, INDEX IDX_BD8210D1C3568B40 (customers_id), INDEX IDX_BD8210D184DDC6B4 (favorites_id), PRIMARY KEY(favorites_id, customers_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE favorites_coaches ADD CONSTRAINT FK_7EC99F5EA9600977 FOREIGN KEY (coaches_id) REFERENCES coaches (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorites_coaches ADD CONSTRAINT FK_7EC99F5E84DDC6B4 FOREIGN KEY (favorites_id) REFERENCES favorites (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorites_customers ADD CONSTRAINT FK_BD8210D1C3568B40 FOREIGN KEY (customers_id) REFERENCES customers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorites_customers ADD CONSTRAINT FK_BD8210D184DDC6B4 FOREIGN KEY (favorites_id) REFERENCES favorites (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE coaches_customers');
    }
}

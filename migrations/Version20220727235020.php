<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220727235020 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Création des relations entre les tables de la DB';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favorites (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favorites_coaches (favorites_id INT NOT NULL, coaches_id INT NOT NULL, INDEX IDX_7EC99F5E84DDC6B4 (favorites_id), INDEX IDX_7EC99F5EA9600977 (coaches_id), PRIMARY KEY(favorites_id, coaches_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favorites_customers (favorites_id INT NOT NULL, customers_id INT NOT NULL, INDEX IDX_BD8210D184DDC6B4 (favorites_id), INDEX IDX_BD8210D1C3568B40 (customers_id), PRIMARY KEY(favorites_id, customers_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistics (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, number_of_visits INT NOT NULL, visit_page INT NOT NULL, INDEX IDX_E2D38B22A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favorites_coaches ADD CONSTRAINT FK_7EC99F5E84DDC6B4 FOREIGN KEY (favorites_id) REFERENCES favorites (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorites_coaches ADD CONSTRAINT FK_7EC99F5EA9600977 FOREIGN KEY (coaches_id) REFERENCES coaches (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorites_customers ADD CONSTRAINT FK_BD8210D184DDC6B4 FOREIGN KEY (favorites_id) REFERENCES favorites (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorites_customers ADD CONSTRAINT FK_BD8210D1C3568B40 FOREIGN KEY (customers_id) REFERENCES customers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE statistics ADD CONSTRAINT FK_E2D38B22A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('DROP TABLE statistcs');
        $this->addSql('ALTER TABLE appointments ADD coach_id INT NOT NULL, ADD customer_id INT NOT NULL');
        $this->addSql('ALTER TABLE appointments ADD CONSTRAINT FK_6A41727A3C105691 FOREIGN KEY (coach_id) REFERENCES coaches (id)');
        $this->addSql('ALTER TABLE appointments ADD CONSTRAINT FK_6A41727A9395C3F3 FOREIGN KEY (customer_id) REFERENCES customers (id)');
        $this->addSql('CREATE INDEX IDX_6A41727A3C105691 ON appointments (coach_id)');
        $this->addSql('CREATE INDEX IDX_6A41727A9395C3F3 ON appointments (customer_id)');
        $this->addSql('ALTER TABLE coaches_lang ADD coach_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE coaches_lang ADD CONSTRAINT FK_41C66C013C105691 FOREIGN KEY (coach_id) REFERENCES coaches (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_41C66C013C105691 ON coaches_lang (coach_id)');
        $this->addSql('ALTER TABLE comments ADD coach_id INT DEFAULT NULL, ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A3C105691 FOREIGN KEY (coach_id) REFERENCES coaches (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A9395C3F3 FOREIGN KEY (customer_id) REFERENCES customers (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A3C105691 ON comments (coach_id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A9395C3F3 ON comments (customer_id)');
        $this->addSql('ALTER TABLE comments_lang ADD comment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comments_lang ADD CONSTRAINT FK_B5D8A9C5F8697D13 FOREIGN KEY (comment_id) REFERENCES comments (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B5D8A9C5F8697D13 ON comments_lang (comment_id)');
        $this->addSql('ALTER TABLE images ADD coach_id INT DEFAULT NULL, ADD training_id INT DEFAULT NULL, ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A3C105691 FOREIGN KEY (coach_id) REFERENCES coaches (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6ABEFD98D1 FOREIGN KEY (training_id) REFERENCES trainings (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A9395C3F3 FOREIGN KEY (customer_id) REFERENCES customers (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E01FBE6A3C105691 ON images (coach_id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6ABEFD98D1 ON images (training_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E01FBE6A9395C3F3 ON images (customer_id)');
        $this->addSql('ALTER TABLE languages ADD promotions_lang_id INT DEFAULT NULL, ADD comments_lang_id INT DEFAULT NULL, ADD coaches_lang_id INT DEFAULT NULL, ADD trainings_lang_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE languages ADD CONSTRAINT FK_A0D15379DDF80B2A FOREIGN KEY (promotions_lang_id) REFERENCES promotions_lang (id)');
        $this->addSql('ALTER TABLE languages ADD CONSTRAINT FK_A0D153796E8CC68 FOREIGN KEY (comments_lang_id) REFERENCES comments_lang (id)');
        $this->addSql('ALTER TABLE languages ADD CONSTRAINT FK_A0D15379DCCCEC68 FOREIGN KEY (coaches_lang_id) REFERENCES coaches_lang (id)');
        $this->addSql('ALTER TABLE languages ADD CONSTRAINT FK_A0D15379FCC9BCF9 FOREIGN KEY (trainings_lang_id) REFERENCES trainings_lang (id)');
        $this->addSql('CREATE INDEX IDX_A0D15379DDF80B2A ON languages (promotions_lang_id)');
        $this->addSql('CREATE INDEX IDX_A0D153796E8CC68 ON languages (comments_lang_id)');
        $this->addSql('CREATE INDEX IDX_A0D15379DCCCEC68 ON languages (coaches_lang_id)');
        $this->addSql('CREATE INDEX IDX_A0D15379FCC9BCF9 ON languages (trainings_lang_id)');
        $this->addSql('ALTER TABLE pdf ADD training_id INT DEFAULT NULL, ADD promotion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pdf ADD CONSTRAINT FK_EF0DB8CBEFD98D1 FOREIGN KEY (training_id) REFERENCES trainings (id)');
        $this->addSql('ALTER TABLE pdf ADD CONSTRAINT FK_EF0DB8C139DF194 FOREIGN KEY (promotion_id) REFERENCES promotions (id)');
        $this->addSql('CREATE INDEX IDX_EF0DB8CBEFD98D1 ON pdf (training_id)');
        $this->addSql('CREATE INDEX IDX_EF0DB8C139DF194 ON pdf (promotion_id)');
        $this->addSql('ALTER TABLE promotions ADD training_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE promotions ADD CONSTRAINT FK_EA1B3034BEFD98D1 FOREIGN KEY (training_id) REFERENCES trainings (id)');
        $this->addSql('CREATE INDEX IDX_EA1B3034BEFD98D1 ON promotions (training_id)');
        $this->addSql('ALTER TABLE promotions_lang ADD promotion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE promotions_lang ADD CONSTRAINT FK_7C444569139DF194 FOREIGN KEY (promotion_id) REFERENCES promotions (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7C444569139DF194 ON promotions_lang (promotion_id)');
        $this->addSql('ALTER TABLE trainings ADD coache_id INT NOT NULL');
        $this->addSql('ALTER TABLE trainings ADD CONSTRAINT FK_66DC4330153706E2 FOREIGN KEY (coache_id) REFERENCES coaches (id)');
        $this->addSql('CREATE INDEX IDX_66DC4330153706E2 ON trainings (coache_id)');
        $this->addSql('ALTER TABLE trainings_lang ADD training_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trainings_lang ADD CONSTRAINT FK_F398BB59BEFD98D1 FOREIGN KEY (training_id) REFERENCES trainings (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F398BB59BEFD98D1 ON trainings_lang (training_id)');
        $this->addSql('ALTER TABLE users ADD postal_code_id INT DEFAULT NULL, ADD municipality_id INT DEFAULT NULL, ADD coach_id INT DEFAULT NULL, ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9BDBA6A61 FOREIGN KEY (postal_code_id) REFERENCES postal_codes (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9AE6F181C FOREIGN KEY (municipality_id) REFERENCES municipalities (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E93C105691 FOREIGN KEY (coach_id) REFERENCES coaches (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E99395C3F3 FOREIGN KEY (customer_id) REFERENCES customers (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9BDBA6A61 ON users (postal_code_id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9AE6F181C ON users (municipality_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E93C105691 ON users (coach_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E99395C3F3 ON users (customer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favorites_coaches DROP FOREIGN KEY FK_7EC99F5E84DDC6B4');
        $this->addSql('ALTER TABLE favorites_customers DROP FOREIGN KEY FK_BD8210D184DDC6B4');
        $this->addSql('CREATE TABLE statistcs (id INT AUTO_INCREMENT NOT NULL, number_of_visits INT NOT NULL, visit_page INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE favorites');
        $this->addSql('DROP TABLE favorites_coaches');
        $this->addSql('DROP TABLE favorites_customers');
        $this->addSql('DROP TABLE statistics');
        $this->addSql('ALTER TABLE appointments DROP FOREIGN KEY FK_6A41727A3C105691');
        $this->addSql('ALTER TABLE appointments DROP FOREIGN KEY FK_6A41727A9395C3F3');
        $this->addSql('DROP INDEX IDX_6A41727A3C105691 ON appointments');
        $this->addSql('DROP INDEX IDX_6A41727A9395C3F3 ON appointments');
        $this->addSql('ALTER TABLE appointments DROP coach_id, DROP customer_id');
        $this->addSql('ALTER TABLE coaches_lang DROP FOREIGN KEY FK_41C66C013C105691');
        $this->addSql('DROP INDEX UNIQ_41C66C013C105691 ON coaches_lang');
        $this->addSql('ALTER TABLE coaches_lang DROP coach_id');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A3C105691');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A9395C3F3');
        $this->addSql('DROP INDEX IDX_5F9E962A3C105691 ON comments');
        $this->addSql('DROP INDEX IDX_5F9E962A9395C3F3 ON comments');
        $this->addSql('ALTER TABLE comments DROP coach_id, DROP customer_id');
        $this->addSql('ALTER TABLE comments_lang DROP FOREIGN KEY FK_B5D8A9C5F8697D13');
        $this->addSql('DROP INDEX UNIQ_B5D8A9C5F8697D13 ON comments_lang');
        $this->addSql('ALTER TABLE comments_lang DROP comment_id');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A3C105691');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6ABEFD98D1');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A9395C3F3');
        $this->addSql('DROP INDEX UNIQ_E01FBE6A3C105691 ON images');
        $this->addSql('DROP INDEX IDX_E01FBE6ABEFD98D1 ON images');
        $this->addSql('DROP INDEX UNIQ_E01FBE6A9395C3F3 ON images');
        $this->addSql('ALTER TABLE images DROP coach_id, DROP training_id, DROP customer_id');
        $this->addSql('ALTER TABLE languages DROP FOREIGN KEY FK_A0D15379DDF80B2A');
        $this->addSql('ALTER TABLE languages DROP FOREIGN KEY FK_A0D153796E8CC68');
        $this->addSql('ALTER TABLE languages DROP FOREIGN KEY FK_A0D15379DCCCEC68');
        $this->addSql('ALTER TABLE languages DROP FOREIGN KEY FK_A0D15379FCC9BCF9');
        $this->addSql('DROP INDEX IDX_A0D15379DDF80B2A ON languages');
        $this->addSql('DROP INDEX IDX_A0D153796E8CC68 ON languages');
        $this->addSql('DROP INDEX IDX_A0D15379DCCCEC68 ON languages');
        $this->addSql('DROP INDEX IDX_A0D15379FCC9BCF9 ON languages');
        $this->addSql('ALTER TABLE languages DROP promotions_lang_id, DROP comments_lang_id, DROP coaches_lang_id, DROP trainings_lang_id');
        $this->addSql('ALTER TABLE pdf DROP FOREIGN KEY FK_EF0DB8CBEFD98D1');
        $this->addSql('ALTER TABLE pdf DROP FOREIGN KEY FK_EF0DB8C139DF194');
        $this->addSql('DROP INDEX IDX_EF0DB8CBEFD98D1 ON pdf');
        $this->addSql('DROP INDEX IDX_EF0DB8C139DF194 ON pdf');
        $this->addSql('ALTER TABLE pdf DROP training_id, DROP promotion_id');
        $this->addSql('ALTER TABLE promotions DROP FOREIGN KEY FK_EA1B3034BEFD98D1');
        $this->addSql('DROP INDEX IDX_EA1B3034BEFD98D1 ON promotions');
        $this->addSql('ALTER TABLE promotions DROP training_id');
        $this->addSql('ALTER TABLE promotions_lang DROP FOREIGN KEY FK_7C444569139DF194');
        $this->addSql('DROP INDEX UNIQ_7C444569139DF194 ON promotions_lang');
        $this->addSql('ALTER TABLE promotions_lang DROP promotion_id');
        $this->addSql('ALTER TABLE trainings DROP FOREIGN KEY FK_66DC4330153706E2');
        $this->addSql('DROP INDEX IDX_66DC4330153706E2 ON trainings');
        $this->addSql('ALTER TABLE trainings DROP coache_id');
        $this->addSql('ALTER TABLE trainings_lang DROP FOREIGN KEY FK_F398BB59BEFD98D1');
        $this->addSql('DROP INDEX UNIQ_F398BB59BEFD98D1 ON trainings_lang');
        $this->addSql('ALTER TABLE trainings_lang DROP training_id');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9BDBA6A61');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9AE6F181C');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E93C105691');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E99395C3F3');
        $this->addSql('DROP INDEX IDX_1483A5E9BDBA6A61 ON users');
        $this->addSql('DROP INDEX IDX_1483A5E9AE6F181C ON users');
        $this->addSql('DROP INDEX UNIQ_1483A5E93C105691 ON users');
        $this->addSql('DROP INDEX UNIQ_1483A5E99395C3F3 ON users');
        $this->addSql('ALTER TABLE users DROP postal_code_id, DROP municipality_id, DROP coach_id, DROP customer_id');
    }
}

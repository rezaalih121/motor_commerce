<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221219143012 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, numero INT DEFAULT NULL, rur VARCHAR(255) DEFAULT NULL, cp VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, compliment VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, INDEX IDX_D4E6F81A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cmd (id INT AUTO_INCREMENT NOT NULL, panier_id INT DEFAULT NULL, user_id INT DEFAULT NULL, address_fact_id INT DEFAULT NULL, address_liv_id INT DEFAULT NULL, c_date DATE DEFAULT NULL, c_total_price DOUBLE PRECISION DEFAULT NULL, payee TINYINT(1) DEFAULT NULL, retrait TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_2F5C1CC0F77D927C (panier_id), INDEX IDX_2F5C1CC0A76ED395 (user_id), INDEX IDX_2F5C1CC04E88ABB2 (address_fact_id), INDEX IDX_2F5C1CC0B6DB1D63 (address_liv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE motos (id INT AUTO_INCREMENT NOT NULL, marque_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, kilometre INT DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, date_imat DATE DEFAULT NULL, power DOUBLE PRECISION DEFAULT NULL, INDEX IDX_BC5434D64827B9B2 (marque_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE motos_panier (id INT AUTO_INCREMENT NOT NULL, motos_id INT DEFAULT NULL, panier_id INT DEFAULT NULL, quntity INT DEFAULT NULL, total_price DOUBLE PRECISION DEFAULT NULL, INDEX IDX_1030019C3869EA14 (motos_id), INDEX IDX_1030019CF77D927C (panier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, p_date DATE DEFAULT NULL, total_price DOUBLE PRECISION DEFAULT NULL, INDEX IDX_24CC0DF2A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photos (id INT AUTO_INCREMENT NOT NULL, motos_id INT DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, INDEX IDX_876E0D93869EA14 (motos_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cmd ADD CONSTRAINT FK_2F5C1CC0F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('ALTER TABLE cmd ADD CONSTRAINT FK_2F5C1CC0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cmd ADD CONSTRAINT FK_2F5C1CC04E88ABB2 FOREIGN KEY (address_fact_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE cmd ADD CONSTRAINT FK_2F5C1CC0B6DB1D63 FOREIGN KEY (address_liv_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE motos ADD CONSTRAINT FK_BC5434D64827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE motos_panier ADD CONSTRAINT FK_1030019C3869EA14 FOREIGN KEY (motos_id) REFERENCES motos (id)');
        $this->addSql('ALTER TABLE motos_panier ADD CONSTRAINT FK_1030019CF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D93869EA14 FOREIGN KEY (motos_id) REFERENCES motos (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81A76ED395');
        $this->addSql('ALTER TABLE cmd DROP FOREIGN KEY FK_2F5C1CC0F77D927C');
        $this->addSql('ALTER TABLE cmd DROP FOREIGN KEY FK_2F5C1CC0A76ED395');
        $this->addSql('ALTER TABLE cmd DROP FOREIGN KEY FK_2F5C1CC04E88ABB2');
        $this->addSql('ALTER TABLE cmd DROP FOREIGN KEY FK_2F5C1CC0B6DB1D63');
        $this->addSql('ALTER TABLE motos DROP FOREIGN KEY FK_BC5434D64827B9B2');
        $this->addSql('ALTER TABLE motos_panier DROP FOREIGN KEY FK_1030019C3869EA14');
        $this->addSql('ALTER TABLE motos_panier DROP FOREIGN KEY FK_1030019CF77D927C');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF2A76ED395');
        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D93869EA14');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE cmd');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE motos');
        $this->addSql('DROP TABLE motos_panier');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE photos');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
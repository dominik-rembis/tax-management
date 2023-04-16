<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220604120918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, nip VARCHAR(255) NOT NULL, regon VARCHAR(255) DEFAULT NULL, comments VARCHAR(150) DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', street VARCHAR(30) NOT NULL, zip_code VARCHAR(6) NOT NULL, city VARCHAR(30) NOT NULL, country VARCHAR(30) NOT NULL, iban VARCHAR(2) NOT NULL, number VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice_data (id INT AUTO_INCREMENT NOT NULL, seller_id INT DEFAULT NULL, buyer_id INT DEFAULT NULL, number VARCHAR(255) NOT NULL, payment_deadline DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', payment_method VARCHAR(255) NOT NULL, execute_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', comments VARCHAR(150) DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', release_place VARCHAR(50) NOT NULL, release_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_AF36910696901F54 (number), INDEX IDX_AF3691068DE820D9 (seller_id), INDEX IDX_AF3691066C755722 (buyer_id), INDEX IDX_AF36910696901F54 (number), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice_item (id INT AUTO_INCREMENT NOT NULL, invoice_data_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, net_amount DOUBLE PRECISION NOT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_1DDE477BC52C97EF (invoice_data_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permission (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_E04992AA5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_data (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, surname VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(96) NOT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_permission (user_id INT NOT NULL, permission_id INT NOT NULL, INDEX IDX_472E5446A76ED395 (user_id), INDEX IDX_472E5446FED90CCA (permission_id), PRIMARY KEY(user_id, permission_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE invoice_data ADD CONSTRAINT FK_AF3691068DE820D9 FOREIGN KEY (seller_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE invoice_data ADD CONSTRAINT FK_AF3691066C755722 FOREIGN KEY (buyer_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE invoice_item ADD CONSTRAINT FK_1DDE477BC52C97EF FOREIGN KEY (invoice_data_id) REFERENCES invoice_data (id)');
        $this->addSql('ALTER TABLE user_permission ADD CONSTRAINT FK_472E5446A76ED395 FOREIGN KEY (user_id) REFERENCES user_data (id)');
        $this->addSql('ALTER TABLE user_permission ADD CONSTRAINT FK_472E5446FED90CCA FOREIGN KEY (permission_id) REFERENCES permission (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE invoice_data DROP FOREIGN KEY FK_AF3691068DE820D9');
        $this->addSql('ALTER TABLE invoice_data DROP FOREIGN KEY FK_AF3691066C755722');
        $this->addSql('ALTER TABLE invoice_item DROP FOREIGN KEY FK_1DDE477BC52C97EF');
        $this->addSql('ALTER TABLE user_permission DROP FOREIGN KEY FK_472E5446FED90CCA');
        $this->addSql('ALTER TABLE user_permission DROP FOREIGN KEY FK_472E5446A76ED395');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE invoice_data');
        $this->addSql('DROP TABLE invoice_item');
        $this->addSql('DROP TABLE permission');
        $this->addSql('DROP TABLE user_data');
        $this->addSql('DROP TABLE user_permission');
    }
}

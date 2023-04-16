<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230416085725 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE company CHANGE city city VARCHAR(30) NOT NULL, CHANGE country country VARCHAR(30) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE company CHANGE city city VARCHAR(50) NOT NULL, CHANGE country country VARCHAR(2) NOT NULL');
    }
}

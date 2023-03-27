<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230323165316 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nutrition CHANGE carbohydrates carbohydrates DOUBLE PRECISION NOT NULL, CHANGE protein protein DOUBLE PRECISION NOT NULL, CHANGE fat fat DOUBLE PRECISION NOT NULL, CHANGE calories calories DOUBLE PRECISION NOT NULL, CHANGE sugar sugar DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nutrition CHANGE carbohydrates carbohydrates INT NOT NULL, CHANGE protein protein INT NOT NULL, CHANGE fat fat INT NOT NULL, CHANGE calories calories INT NOT NULL, CHANGE sugar sugar INT NOT NULL');
    }
}

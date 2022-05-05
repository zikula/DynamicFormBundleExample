<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220415171830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question ADD labels TEXT NOT NULL');
        $this->addSql('ALTER TABLE question ADD form_type TEXT NOT NULL');
        $this->addSql('ALTER TABLE question ADD form_options TEXT NOT NULL');
        $this->addSql('ALTER TABLE question ADD weight INT NOT NULL');
        $this->addSql('ALTER TABLE question ADD active BOOLEAN NOT NULL');
        $this->addSql('COMMENT ON COLUMN question.labels IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN question.form_options IS \'(DC2Type:array)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE question DROP labels');
        $this->addSql('ALTER TABLE question DROP form_type');
        $this->addSql('ALTER TABLE question DROP form_options');
        $this->addSql('ALTER TABLE question DROP weight');
        $this->addSql('ALTER TABLE question DROP active');
    }
}

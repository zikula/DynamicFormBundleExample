<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220428194026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE survey_question');
        $this->addSql('ALTER TABLE question ADD survey_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EB3FE509D FOREIGN KEY (survey_id) REFERENCES survey (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_B6F7494EB3FE509D ON question (survey_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE survey_question (survey_id INT NOT NULL, question_id INT NOT NULL, PRIMARY KEY(survey_id, question_id))');
        $this->addSql('CREATE INDEX idx_ea000f691e27f6bf ON survey_question (question_id)');
        $this->addSql('CREATE INDEX idx_ea000f69b3fe509d ON survey_question (survey_id)');
        $this->addSql('ALTER TABLE survey_question ADD CONSTRAINT fk_ea000f69b3fe509d FOREIGN KEY (survey_id) REFERENCES survey (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE survey_question ADD CONSTRAINT fk_ea000f691e27f6bf FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE question DROP CONSTRAINT FK_B6F7494EB3FE509D');
        $this->addSql('DROP INDEX IDX_B6F7494EB3FE509D');
        $this->addSql('ALTER TABLE question DROP survey_id');
    }
}

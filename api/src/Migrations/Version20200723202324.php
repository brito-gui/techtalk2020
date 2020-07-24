<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200723202324 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE book (id UUID NOT NULL, isbn VARCHAR(255) DEFAULT NULL, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, page_count INT DEFAULT NULL, author VARCHAR(255) NOT NULL, published BOOLEAN NOT NULL, publication_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN book.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE review (id UUID NOT NULL, book_id UUID NOT NULL, rating SMALLINT NOT NULL, body TEXT NOT NULL, author VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_794381C616A2B381 ON review (book_id)');
        $this->addSql('COMMENT ON COLUMN review.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN review.book_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C616A2B381 FOREIGN KEY (book_id) REFERENCES book (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE review DROP CONSTRAINT FK_794381C616A2B381');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE review');
    }
}

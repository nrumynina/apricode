<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220428180111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE developer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE developer (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE video_game ADD developer_id INT NOT NULL');
        $this->addSql('ALTER TABLE video_game RENAME COLUMN developer TO status');
        $this->addSql('ALTER TABLE video_game ADD CONSTRAINT FK_24BC6C5064DD9267 FOREIGN KEY (developer_id) REFERENCES developer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_24BC6C5064DD9267 ON video_game (developer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE video_game DROP CONSTRAINT FK_24BC6C5064DD9267');
        $this->addSql('DROP SEQUENCE developer_id_seq CASCADE');
        $this->addSql('DROP TABLE developer');
        $this->addSql('DROP INDEX IDX_24BC6C5064DD9267');
        $this->addSql('ALTER TABLE video_game DROP developer_id');
        $this->addSql('ALTER TABLE video_game RENAME COLUMN status TO developer');
    }
}

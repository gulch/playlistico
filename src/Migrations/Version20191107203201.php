<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191107203201 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__Channel AS SELECT id, title, url, group_id, logo_filename, tvg_id, created_at, note FROM Channel');
        $this->addSql('DROP TABLE Channel');
        $this->addSql('CREATE TABLE Channel (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, channel_group_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, url VARCHAR(255) NOT NULL COLLATE BINARY, logo_filename VARCHAR(255) DEFAULT NULL COLLATE BINARY, tvg_id VARCHAR(255) DEFAULT NULL COLLATE BINARY, created_at DATETIME NOT NULL, note CLOB DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_6D44B7DB89E4AAEE FOREIGN KEY (channel_group_id) REFERENCES "Group" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO Channel (id, title, url, channel_group_id, logo_filename, tvg_id, created_at, note) SELECT id, title, url, group_id, logo_filename, tvg_id, created_at, note FROM __temp__Channel');
        $this->addSql('DROP TABLE __temp__Channel');
        $this->addSql('CREATE INDEX IDX_6D44B7DB89E4AAEE ON Channel (channel_group_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_6D44B7DB89E4AAEE');
        $this->addSql('CREATE TEMPORARY TABLE __temp__Channel AS SELECT id, channel_group_id, title, url, logo_filename, tvg_id, created_at, note FROM "Channel"');
        $this->addSql('DROP TABLE "Channel"');
        $this->addSql('CREATE TABLE "Channel" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, logo_filename VARCHAR(255) DEFAULT NULL, tvg_id VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, note CLOB DEFAULT NULL, group_id INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO "Channel" (id, group_id, title, url, logo_filename, tvg_id, created_at, note) SELECT id, channel_group_id, title, url, logo_filename, tvg_id, created_at, note FROM __temp__Channel');
        $this->addSql('DROP TABLE __temp__Channel');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191007104238 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('ALTER TABLE Channel ADD COLUMN note CLOB DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__Channel AS SELECT id, title, url, group_id, logo_filename, tvg_id, created_at FROM "Channel"');
        $this->addSql('DROP TABLE "Channel"');
        $this->addSql('CREATE TABLE "Channel" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, group_id INTEGER DEFAULT NULL, logo_filename VARCHAR(255) DEFAULT NULL, tvg_id VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO "Channel" (id, title, url, group_id, logo_filename, tvg_id, created_at) SELECT id, title, url, group_id, logo_filename, tvg_id, created_at FROM __temp__Channel');
        $this->addSql('DROP TABLE __temp__Channel');
    }
}

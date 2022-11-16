<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * ! this migration implements the many-to-many relationship between episodes and characters
 */
final class Version20221116174635 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE episode_got_character (episode_id INT NOT NULL, got_character_id INT NOT NULL, INDEX IDX_F40D69FD362B62A0 (episode_id), INDEX IDX_F40D69FD896F1ED9 (got_character_id), PRIMARY KEY(episode_id, got_character_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE episode_got_character ADD CONSTRAINT FK_F40D69FD362B62A0 FOREIGN KEY (episode_id) REFERENCES episode (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE episode_got_character ADD CONSTRAINT FK_F40D69FD896F1ED9 FOREIGN KEY (got_character_id) REFERENCES got_character (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE episode_got_character DROP FOREIGN KEY FK_F40D69FD362B62A0');
        $this->addSql('ALTER TABLE episode_got_character DROP FOREIGN KEY FK_F40D69FD896F1ED9');
        $this->addSql('DROP TABLE episode_got_character');
    }
}

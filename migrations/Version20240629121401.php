<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240629121401 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artist_favorite (artist_id INT NOT NULL, favorite_id INT NOT NULL, INDEX IDX_D0CF6488B7970CF8 (artist_id), INDEX IDX_D0CF6488AA17481D (favorite_id), PRIMARY KEY(artist_id, favorite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artist_favorite ADD CONSTRAINT FK_D0CF6488B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_favorite ADD CONSTRAINT FK_D0CF6488AA17481D FOREIGN KEY (favorite_id) REFERENCES favorite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorite DROP artist_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist_favorite DROP FOREIGN KEY FK_D0CF6488B7970CF8');
        $this->addSql('ALTER TABLE artist_favorite DROP FOREIGN KEY FK_D0CF6488AA17481D');
        $this->addSql('DROP TABLE artist_favorite');
        $this->addSql('ALTER TABLE favorite ADD artist_id INT NOT NULL');
    }
}

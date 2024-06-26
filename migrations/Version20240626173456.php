<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240626173456 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artist_category (artist_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_BE46F390B7970CF8 (artist_id), INDEX IDX_BE46F39012469DE2 (category_id), PRIMARY KEY(artist_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artist_category ADD CONSTRAINT FK_BE46F390B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_category ADD CONSTRAINT FK_BE46F39012469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_159968712469DE2');
        $this->addSql('DROP INDEX IDX_159968712469DE2 ON artist');
        $this->addSql('ALTER TABLE artist DROP category_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist_category DROP FOREIGN KEY FK_BE46F390B7970CF8');
        $this->addSql('ALTER TABLE artist_category DROP FOREIGN KEY FK_BE46F39012469DE2');
        $this->addSql('DROP TABLE artist_category');
        $this->addSql('ALTER TABLE artist ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_159968712469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_159968712469DE2 ON artist (category_id)');
    }
}

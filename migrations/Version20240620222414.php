<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240620222414 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist_audio DROP FOREIGN KEY FK_787106C63A3123C7');
        $this->addSql('ALTER TABLE artist_audio DROP FOREIGN KEY FK_787106C6B7970CF8');
        $this->addSql('ALTER TABLE artist_picture DROP FOREIGN KEY FK_A19411BEB7970CF8');
        $this->addSql('ALTER TABLE artist_picture DROP FOREIGN KEY FK_A19411BEEE45BDBF');
        $this->addSql('ALTER TABLE artist_video DROP FOREIGN KEY FK_1CCBEA7F29C1004E');
        $this->addSql('ALTER TABLE artist_video DROP FOREIGN KEY FK_1CCBEA7FB7970CF8');
        $this->addSql('ALTER TABLE artist_website DROP FOREIGN KEY FK_F02003D018F45C82');
        $this->addSql('ALTER TABLE artist_website DROP FOREIGN KEY FK_F02003D0B7970CF8');
        $this->addSql('ALTER TABLE favorite_user DROP FOREIGN KEY FK_6395CF76A76ED395');
        $this->addSql('ALTER TABLE favorite_user DROP FOREIGN KEY FK_6395CF76AA17481D');
        $this->addSql('DROP TABLE artist_audio');
        $this->addSql('DROP TABLE artist_picture');
        $this->addSql('DROP TABLE artist_video');
        $this->addSql('DROP TABLE artist_website');
        $this->addSql('DROP TABLE favorite_user');
        $this->addSql('ALTER TABLE audio ADD artist_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE audio ADD CONSTRAINT FK_187D3695B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('CREATE INDEX IDX_187D3695B7970CF8 ON audio (artist_id)');
        $this->addSql('ALTER TABLE favorite ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_68C58ED9A76ED395 ON favorite (user_id)');
        $this->addSql('ALTER TABLE picture ADD artist_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('CREATE INDEX IDX_16DB4F89B7970CF8 ON picture (artist_id)');
        $this->addSql('ALTER TABLE video ADD artist_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('CREATE INDEX IDX_7CC7DA2CB7970CF8 ON video (artist_id)');
        $this->addSql('ALTER TABLE website ADD artist_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE website ADD CONSTRAINT FK_476F5DE7B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('CREATE INDEX IDX_476F5DE7B7970CF8 ON website (artist_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artist_audio (artist_id INT NOT NULL, audio_id INT NOT NULL, INDEX IDX_787106C63A3123C7 (audio_id), INDEX IDX_787106C6B7970CF8 (artist_id), PRIMARY KEY(artist_id, audio_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE artist_picture (artist_id INT NOT NULL, picture_id INT NOT NULL, INDEX IDX_A19411BEB7970CF8 (artist_id), INDEX IDX_A19411BEEE45BDBF (picture_id), PRIMARY KEY(artist_id, picture_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE artist_video (artist_id INT NOT NULL, video_id INT NOT NULL, INDEX IDX_1CCBEA7F29C1004E (video_id), INDEX IDX_1CCBEA7FB7970CF8 (artist_id), PRIMARY KEY(artist_id, video_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE artist_website (artist_id INT NOT NULL, website_id INT NOT NULL, INDEX IDX_F02003D018F45C82 (website_id), INDEX IDX_F02003D0B7970CF8 (artist_id), PRIMARY KEY(artist_id, website_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE favorite_user (favorite_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_6395CF76A76ED395 (user_id), INDEX IDX_6395CF76AA17481D (favorite_id), PRIMARY KEY(favorite_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE artist_audio ADD CONSTRAINT FK_787106C63A3123C7 FOREIGN KEY (audio_id) REFERENCES audio (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_audio ADD CONSTRAINT FK_787106C6B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_picture ADD CONSTRAINT FK_A19411BEB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_picture ADD CONSTRAINT FK_A19411BEEE45BDBF FOREIGN KEY (picture_id) REFERENCES picture (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_video ADD CONSTRAINT FK_1CCBEA7F29C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_video ADD CONSTRAINT FK_1CCBEA7FB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_website ADD CONSTRAINT FK_F02003D018F45C82 FOREIGN KEY (website_id) REFERENCES website (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_website ADD CONSTRAINT FK_F02003D0B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorite_user ADD CONSTRAINT FK_6395CF76A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE favorite_user ADD CONSTRAINT FK_6395CF76AA17481D FOREIGN KEY (favorite_id) REFERENCES favorite (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE audio DROP FOREIGN KEY FK_187D3695B7970CF8');
        $this->addSql('DROP INDEX IDX_187D3695B7970CF8 ON audio');
        $this->addSql('ALTER TABLE audio DROP artist_id');
        $this->addSql('ALTER TABLE favorite DROP FOREIGN KEY FK_68C58ED9A76ED395');
        $this->addSql('DROP INDEX IDX_68C58ED9A76ED395 ON favorite');
        $this->addSql('ALTER TABLE favorite DROP user_id');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89B7970CF8');
        $this->addSql('DROP INDEX IDX_16DB4F89B7970CF8 ON picture');
        $this->addSql('ALTER TABLE picture DROP artist_id');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CB7970CF8');
        $this->addSql('DROP INDEX IDX_7CC7DA2CB7970CF8 ON video');
        $this->addSql('ALTER TABLE video DROP artist_id');
        $this->addSql('ALTER TABLE website DROP FOREIGN KEY FK_476F5DE7B7970CF8');
        $this->addSql('DROP INDEX IDX_476F5DE7B7970CF8 ON website');
        $this->addSql('ALTER TABLE website DROP artist_id');
    }
}

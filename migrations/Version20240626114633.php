<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240626114633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, musician_id INT NOT NULL, nickname VARCHAR(50) NOT NULL, number INT NOT NULL, professional TINYINT(1) NOT NULL, city VARCHAR(50) DEFAULT NULL, country VARCHAR(50) DEFAULT NULL, phone VARCHAR(20) NOT NULL, mail VARCHAR(180) NOT NULL, image VARCHAR(255) DEFAULT NULL, bio LONGTEXT DEFAULT NULL, birthyear INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_159968712469DE2 (category_id), INDEX IDX_15996879523AA8A (musician_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist_tag (artist_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_DB8C3232B7970CF8 (artist_id), INDEX IDX_DB8C3232BAD26311 (tag_id), PRIMARY KEY(artist_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist_favorite (artist_id INT NOT NULL, favorite_id INT NOT NULL, INDEX IDX_D0CF6488B7970CF8 (artist_id), INDEX IDX_D0CF6488AA17481D (favorite_id), PRIMARY KEY(artist_id, favorite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist_musical_style (artist_id INT NOT NULL, musical_style_id INT NOT NULL, INDEX IDX_10B439CFB7970CF8 (artist_id), INDEX IDX_10B439CF814A84C0 (musical_style_id), PRIMARY KEY(artist_id, musical_style_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist_instrument (artist_id INT NOT NULL, instrument_id INT NOT NULL, INDEX IDX_DFC0B6A4B7970CF8 (artist_id), INDEX IDX_DFC0B6A4CF11D9C (instrument_id), PRIMARY KEY(artist_id, instrument_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist_set (artist_id INT NOT NULL, set_id INT NOT NULL, INDEX IDX_3E11A06DB7970CF8 (artist_id), INDEX IDX_3E11A06D10FB0D18 (set_id), PRIMARY KEY(artist_id, set_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist_performance (artist_id INT NOT NULL, performance_id INT NOT NULL, INDEX IDX_ABED20C6B7970CF8 (artist_id), INDEX IDX_ABED20C6B91ADEEE (performance_id), PRIMARY KEY(artist_id, performance_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist_social_network (artist_id INT NOT NULL, social_network_id INT NOT NULL, INDEX IDX_EEB919C1B7970CF8 (artist_id), INDEX IDX_EEB919C1FA413953 (social_network_id), PRIMARY KEY(artist_id, social_network_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist_music_platform (artist_id INT NOT NULL, music_platform_id INT NOT NULL, INDEX IDX_FF07C70DB7970CF8 (artist_id), INDEX IDX_FF07C70D5196207C (music_platform_id), PRIMARY KEY(artist_id, music_platform_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist_event_platform (artist_id INT NOT NULL, event_platform_id INT NOT NULL, INDEX IDX_7EF872FBB7970CF8 (artist_id), INDEX IDX_7EF872FB546F9AEF (event_platform_id), PRIMARY KEY(artist_id, event_platform_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist_event (artist_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_5BA23AF4B7970CF8 (artist_id), INDEX IDX_5BA23AF471F7E88B (event_id), PRIMARY KEY(artist_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE audio (id INT AUTO_INCREMENT NOT NULL, artist_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, link VARCHAR(255) NOT NULL, INDEX IDX_187D3695B7970CF8 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, image VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, location VARCHAR(50) NOT NULL, title VARCHAR(50) NOT NULL, date DATETIME DEFAULT NULL, description LONGTEXT DEFAULT NULL, address VARCHAR(50) DEFAULT NULL, city VARCHAR(50) DEFAULT NULL, zip VARCHAR(5) DEFAULT NULL, country VARCHAR(50) DEFAULT NULL, image VARCHAR(255) NOT NULL, link VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_platform (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, link VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favorite (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, INDEX IDX_68C58ED9A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instrument (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE music_platform (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, link VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE musical_style (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE performance (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(30) NOT NULL, location VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, artist_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, link VARCHAR(255) NOT NULL, INDEX IDX_16DB4F89B7970CF8 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, artist_id INT NOT NULL, title VARCHAR(50) NOT NULL, comment LONGTEXT DEFAULT NULL, rating INT NOT NULL, INDEX IDX_794381C6A76ED395 (user_id), INDEX IDX_794381C6B7970CF8 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `set` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE social_network (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, link VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, name VARCHAR(50) DEFAULT NULL, corporate_name VARCHAR(100) DEFAULT NULL, siret VARCHAR(17) DEFAULT NULL, phone VARCHAR(20) DEFAULT NULL, address VARCHAR(50) DEFAULT NULL, additional_address VARCHAR(50) DEFAULT NULL, city VARCHAR(50) DEFAULT NULL, zip VARCHAR(5) DEFAULT NULL, country VARCHAR(50) DEFAULT NULL, consent TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, artist_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, link VARCHAR(255) NOT NULL, INDEX IDX_7CC7DA2CB7970CF8 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE website (id INT AUTO_INCREMENT NOT NULL, artist_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, link VARCHAR(255) NOT NULL, INDEX IDX_476F5DE7B7970CF8 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_159968712469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_15996879523AA8A FOREIGN KEY (musician_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE artist_tag ADD CONSTRAINT FK_DB8C3232B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_tag ADD CONSTRAINT FK_DB8C3232BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_favorite ADD CONSTRAINT FK_D0CF6488B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_favorite ADD CONSTRAINT FK_D0CF6488AA17481D FOREIGN KEY (favorite_id) REFERENCES favorite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_musical_style ADD CONSTRAINT FK_10B439CFB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE artist_musical_style ADD CONSTRAINT FK_10B439CF814A84C0 FOREIGN KEY (musical_style_id) REFERENCES musical_style (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_instrument ADD CONSTRAINT FK_DFC0B6A4B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE artist_instrument ADD CONSTRAINT FK_DFC0B6A4CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_set ADD CONSTRAINT FK_3E11A06DB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_set ADD CONSTRAINT FK_3E11A06D10FB0D18 FOREIGN KEY (set_id) REFERENCES `set` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_performance ADD CONSTRAINT FK_ABED20C6B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_performance ADD CONSTRAINT FK_ABED20C6B91ADEEE FOREIGN KEY (performance_id) REFERENCES performance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_social_network ADD CONSTRAINT FK_EEB919C1B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_social_network ADD CONSTRAINT FK_EEB919C1FA413953 FOREIGN KEY (social_network_id) REFERENCES social_network (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_music_platform ADD CONSTRAINT FK_FF07C70DB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_music_platform ADD CONSTRAINT FK_FF07C70D5196207C FOREIGN KEY (music_platform_id) REFERENCES music_platform (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_event_platform ADD CONSTRAINT FK_7EF872FBB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_event_platform ADD CONSTRAINT FK_7EF872FB546F9AEF FOREIGN KEY (event_platform_id) REFERENCES event_platform (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_event ADD CONSTRAINT FK_5BA23AF4B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_event ADD CONSTRAINT FK_5BA23AF471F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE audio ADD CONSTRAINT FK_187D3695B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE favorite ADD CONSTRAINT FK_68C58ED9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CB7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('ALTER TABLE website ADD CONSTRAINT FK_476F5DE7B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_159968712469DE2');
        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_15996879523AA8A');
        $this->addSql('ALTER TABLE artist_tag DROP FOREIGN KEY FK_DB8C3232B7970CF8');
        $this->addSql('ALTER TABLE artist_tag DROP FOREIGN KEY FK_DB8C3232BAD26311');
        $this->addSql('ALTER TABLE artist_favorite DROP FOREIGN KEY FK_D0CF6488B7970CF8');
        $this->addSql('ALTER TABLE artist_favorite DROP FOREIGN KEY FK_D0CF6488AA17481D');
        $this->addSql('ALTER TABLE artist_musical_style DROP FOREIGN KEY FK_10B439CFB7970CF8');
        $this->addSql('ALTER TABLE artist_musical_style DROP FOREIGN KEY FK_10B439CF814A84C0');
        $this->addSql('ALTER TABLE artist_instrument DROP FOREIGN KEY FK_DFC0B6A4B7970CF8');
        $this->addSql('ALTER TABLE artist_instrument DROP FOREIGN KEY FK_DFC0B6A4CF11D9C');
        $this->addSql('ALTER TABLE artist_set DROP FOREIGN KEY FK_3E11A06DB7970CF8');
        $this->addSql('ALTER TABLE artist_set DROP FOREIGN KEY FK_3E11A06D10FB0D18');
        $this->addSql('ALTER TABLE artist_performance DROP FOREIGN KEY FK_ABED20C6B7970CF8');
        $this->addSql('ALTER TABLE artist_performance DROP FOREIGN KEY FK_ABED20C6B91ADEEE');
        $this->addSql('ALTER TABLE artist_social_network DROP FOREIGN KEY FK_EEB919C1B7970CF8');
        $this->addSql('ALTER TABLE artist_social_network DROP FOREIGN KEY FK_EEB919C1FA413953');
        $this->addSql('ALTER TABLE artist_music_platform DROP FOREIGN KEY FK_FF07C70DB7970CF8');
        $this->addSql('ALTER TABLE artist_music_platform DROP FOREIGN KEY FK_FF07C70D5196207C');
        $this->addSql('ALTER TABLE artist_event_platform DROP FOREIGN KEY FK_7EF872FBB7970CF8');
        $this->addSql('ALTER TABLE artist_event_platform DROP FOREIGN KEY FK_7EF872FB546F9AEF');
        $this->addSql('ALTER TABLE artist_event DROP FOREIGN KEY FK_5BA23AF4B7970CF8');
        $this->addSql('ALTER TABLE artist_event DROP FOREIGN KEY FK_5BA23AF471F7E88B');
        $this->addSql('ALTER TABLE audio DROP FOREIGN KEY FK_187D3695B7970CF8');
        $this->addSql('ALTER TABLE favorite DROP FOREIGN KEY FK_68C58ED9A76ED395');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89B7970CF8');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6A76ED395');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6B7970CF8');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CB7970CF8');
        $this->addSql('ALTER TABLE website DROP FOREIGN KEY FK_476F5DE7B7970CF8');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE artist_tag');
        $this->addSql('DROP TABLE artist_favorite');
        $this->addSql('DROP TABLE artist_musical_style');
        $this->addSql('DROP TABLE artist_instrument');
        $this->addSql('DROP TABLE artist_set');
        $this->addSql('DROP TABLE artist_performance');
        $this->addSql('DROP TABLE artist_social_network');
        $this->addSql('DROP TABLE artist_music_platform');
        $this->addSql('DROP TABLE artist_event_platform');
        $this->addSql('DROP TABLE artist_event');
        $this->addSql('DROP TABLE audio');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_platform');
        $this->addSql('DROP TABLE favorite');
        $this->addSql('DROP TABLE instrument');
        $this->addSql('DROP TABLE music_platform');
        $this->addSql('DROP TABLE musical_style');
        $this->addSql('DROP TABLE performance');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE `set`');
        $this->addSql('DROP TABLE social_network');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE video');
        $this->addSql('DROP TABLE website');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

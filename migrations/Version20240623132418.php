<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240623132418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist CHANGE nickname nickname VARCHAR(50) NOT NULL, CHANGE phone phone VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE audio CHANGE name name VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE event CHANGE title title VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE event_platform CHANGE name name VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE instrument CHANGE name name VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE music_platform CHANGE name name VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE musical_style CHANGE name name VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE picture CHANGE name name VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE `set` CHANGE name name VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE social_network CHANGE name name VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE tag CHANGE name name VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE name name VARCHAR(50) DEFAULT NULL, CHANGE phone phone VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE video CHANGE name name VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE website CHANGE name name VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist CHANGE nickname nickname VARCHAR(30) NOT NULL, CHANGE phone phone VARCHAR(23) NOT NULL');
        $this->addSql('ALTER TABLE audio CHANGE name name VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE event CHANGE title title VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE event_platform CHANGE name name VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE instrument CHANGE name name VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE music_platform CHANGE name name VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE musical_style CHANGE name name VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE picture CHANGE name name VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE `set` CHANGE name name VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE social_network CHANGE name name VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE tag CHANGE name name VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE name name VARCHAR(30) DEFAULT NULL, CHANGE phone phone VARCHAR(23) DEFAULT NULL');
        $this->addSql('ALTER TABLE video CHANGE name name VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE website CHANGE name name VARCHAR(30) NOT NULL');
    }
}

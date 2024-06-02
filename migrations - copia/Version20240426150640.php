<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240426150640 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE edificio (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE espacio (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, aforo INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE espacio_recurso (espacio_id INT NOT NULL, recurso_id INT NOT NULL, INDEX IDX_FDA8AA747CFC1D2C (espacio_id), INDEX IDX_FDA8AA74E52B6C4E (recurso_id), PRIMARY KEY(espacio_id, recurso_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE ponente (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, cargo VARCHAR(255) NOT NULL, url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE recurso (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE espacio_recurso ADD CONSTRAINT FK_FDA8AA747CFC1D2C FOREIGN KEY (espacio_id) REFERENCES espacio (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE espacio_recurso ADD CONSTRAINT FK_FDA8AA74E52B6C4E FOREIGN KEY (recurso_id) REFERENCES recurso (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE espacio_recurso DROP FOREIGN KEY FK_FDA8AA747CFC1D2C');
        $this->addSql('ALTER TABLE espacio_recurso DROP FOREIGN KEY FK_FDA8AA74E52B6C4E');
        $this->addSql('DROP TABLE edificio');
        $this->addSql('DROP TABLE espacio');
        $this->addSql('DROP TABLE espacio_recurso');
        $this->addSql('DROP TABLE ponente');
        $this->addSql('DROP TABLE recurso');
        $this->addSql('DROP TABLE user');
    }
}

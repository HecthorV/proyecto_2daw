<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240426151910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alumno (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, correo VARCHAR(255) NOT NULL, fecha_nacimiento DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE grupo (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, curso SMALLINT NOT NULL, letra VARCHAR(2) NOT NULL, nivel_educativo_id INT DEFAULT NULL, INDEX IDX_8C0E9BD37C0AF21A (nivel_educativo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE nivel_educativo (id INT AUTO_INCREMENT NOT NULL, siglas VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE grupo ADD CONSTRAINT FK_8C0E9BD37C0AF21A FOREIGN KEY (nivel_educativo_id) REFERENCES nivel_educativo (id)');
        $this->addSql('ALTER TABLE espacio ADD edificio_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE espacio ADD CONSTRAINT FK_90BF6AA48A652BD6 FOREIGN KEY (edificio_id) REFERENCES edificio (id)');
        $this->addSql('CREATE INDEX IDX_90BF6AA48A652BD6 ON espacio (edificio_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grupo DROP FOREIGN KEY FK_8C0E9BD37C0AF21A');
        $this->addSql('DROP TABLE alumno');
        $this->addSql('DROP TABLE grupo');
        $this->addSql('DROP TABLE nivel_educativo');
        $this->addSql('ALTER TABLE espacio DROP FOREIGN KEY FK_90BF6AA48A652BD6');
        $this->addSql('DROP INDEX IDX_90BF6AA48A652BD6 ON espacio');
        $this->addSql('ALTER TABLE espacio DROP edificio_id');
    }
}

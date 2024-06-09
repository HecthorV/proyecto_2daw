<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240609171645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actividad (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, fecha_hora_inicio DATETIME NOT NULL, fecha_hora_fin DATETIME DEFAULT NULL, compuesta TINYINT(1) NOT NULL, evento_id INT DEFAULT NULL, INDEX IDX_8DF2BD0687A5F842 (evento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE alumno (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, correo VARCHAR(255) NOT NULL, fecha_nacimiento DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE alumno_detalle_actividad (id INT AUTO_INCREMENT NOT NULL, alumno_id INT NOT NULL, detalle_actividad_id INT DEFAULT NULL, INDEX IDX_8FBC7449FC28E5EE (alumno_id), INDEX IDX_8FBC7449A954C5A1 (detalle_actividad_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE detalle_actividad (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, fecha_hora_inicio DATETIME NOT NULL, fecha_hora_fin DATETIME DEFAULT NULL, actividad_id INT DEFAULT NULL, INDEX IDX_AC9E0C466014FACA (actividad_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE detalle_actividad_espacio (detalle_actividad_id INT NOT NULL, espacio_id INT NOT NULL, INDEX IDX_5E1E2F63A954C5A1 (detalle_actividad_id), INDEX IDX_5E1E2F637CFC1D2C (espacio_id), PRIMARY KEY(detalle_actividad_id, espacio_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE detalle_actividad_grupo (detalle_actividad_id INT NOT NULL, grupo_id INT NOT NULL, INDEX IDX_973A41ACA954C5A1 (detalle_actividad_id), INDEX IDX_973A41AC9C833003 (grupo_id), PRIMARY KEY(detalle_actividad_id, grupo_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE edificio (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE espacio (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, aforo INT NOT NULL, edificio_id INT DEFAULT NULL, INDEX IDX_90BF6AA48A652BD6 (edificio_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE espacio_recurso (espacio_id INT NOT NULL, recurso_id INT NOT NULL, INDEX IDX_FDA8AA747CFC1D2C (espacio_id), INDEX IDX_FDA8AA74E52B6C4E (recurso_id), PRIMARY KEY(espacio_id, recurso_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE evento (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, fecha_inicio DATE NOT NULL, fecha_fin VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE grupo (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, curso SMALLINT NOT NULL, letra VARCHAR(2) NOT NULL, nivel_educativo_id INT DEFAULT NULL, INDEX IDX_8C0E9BD37C0AF21A (nivel_educativo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE nivel_educativo (id INT AUTO_INCREMENT NOT NULL, siglas VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE ponente (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, cargo VARCHAR(255) NOT NULL, url VARCHAR(255) DEFAULT NULL, detalle_actividad_id INT DEFAULT NULL, INDEX IDX_969EB3C8A954C5A1 (detalle_actividad_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE recurso (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user_grupo (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, grupo_id INT DEFAULT NULL, INDEX IDX_6ECC608BA76ED395 (user_id), INDEX IDX_6ECC608B9C833003 (grupo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE actividad ADD CONSTRAINT FK_8DF2BD0687A5F842 FOREIGN KEY (evento_id) REFERENCES evento (id)');
        $this->addSql('ALTER TABLE alumno_detalle_actividad ADD CONSTRAINT FK_8FBC7449FC28E5EE FOREIGN KEY (alumno_id) REFERENCES alumno (id)');
        $this->addSql('ALTER TABLE alumno_detalle_actividad ADD CONSTRAINT FK_8FBC7449A954C5A1 FOREIGN KEY (detalle_actividad_id) REFERENCES detalle_actividad (id)');
        $this->addSql('ALTER TABLE detalle_actividad ADD CONSTRAINT FK_AC9E0C466014FACA FOREIGN KEY (actividad_id) REFERENCES actividad (id)');
        $this->addSql('ALTER TABLE detalle_actividad_espacio ADD CONSTRAINT FK_5E1E2F63A954C5A1 FOREIGN KEY (detalle_actividad_id) REFERENCES detalle_actividad (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detalle_actividad_espacio ADD CONSTRAINT FK_5E1E2F637CFC1D2C FOREIGN KEY (espacio_id) REFERENCES espacio (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detalle_actividad_grupo ADD CONSTRAINT FK_973A41ACA954C5A1 FOREIGN KEY (detalle_actividad_id) REFERENCES detalle_actividad (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detalle_actividad_grupo ADD CONSTRAINT FK_973A41AC9C833003 FOREIGN KEY (grupo_id) REFERENCES grupo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE espacio ADD CONSTRAINT FK_90BF6AA48A652BD6 FOREIGN KEY (edificio_id) REFERENCES edificio (id)');
        $this->addSql('ALTER TABLE espacio_recurso ADD CONSTRAINT FK_FDA8AA747CFC1D2C FOREIGN KEY (espacio_id) REFERENCES espacio (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE espacio_recurso ADD CONSTRAINT FK_FDA8AA74E52B6C4E FOREIGN KEY (recurso_id) REFERENCES recurso (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE grupo ADD CONSTRAINT FK_8C0E9BD37C0AF21A FOREIGN KEY (nivel_educativo_id) REFERENCES nivel_educativo (id)');
        $this->addSql('ALTER TABLE ponente ADD CONSTRAINT FK_969EB3C8A954C5A1 FOREIGN KEY (detalle_actividad_id) REFERENCES detalle_actividad (id)');
        $this->addSql('ALTER TABLE user_grupo ADD CONSTRAINT FK_6ECC608BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_grupo ADD CONSTRAINT FK_6ECC608B9C833003 FOREIGN KEY (grupo_id) REFERENCES grupo (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actividad DROP FOREIGN KEY FK_8DF2BD0687A5F842');
        $this->addSql('ALTER TABLE alumno_detalle_actividad DROP FOREIGN KEY FK_8FBC7449FC28E5EE');
        $this->addSql('ALTER TABLE alumno_detalle_actividad DROP FOREIGN KEY FK_8FBC7449A954C5A1');
        $this->addSql('ALTER TABLE detalle_actividad DROP FOREIGN KEY FK_AC9E0C466014FACA');
        $this->addSql('ALTER TABLE detalle_actividad_espacio DROP FOREIGN KEY FK_5E1E2F63A954C5A1');
        $this->addSql('ALTER TABLE detalle_actividad_espacio DROP FOREIGN KEY FK_5E1E2F637CFC1D2C');
        $this->addSql('ALTER TABLE detalle_actividad_grupo DROP FOREIGN KEY FK_973A41ACA954C5A1');
        $this->addSql('ALTER TABLE detalle_actividad_grupo DROP FOREIGN KEY FK_973A41AC9C833003');
        $this->addSql('ALTER TABLE espacio DROP FOREIGN KEY FK_90BF6AA48A652BD6');
        $this->addSql('ALTER TABLE espacio_recurso DROP FOREIGN KEY FK_FDA8AA747CFC1D2C');
        $this->addSql('ALTER TABLE espacio_recurso DROP FOREIGN KEY FK_FDA8AA74E52B6C4E');
        $this->addSql('ALTER TABLE grupo DROP FOREIGN KEY FK_8C0E9BD37C0AF21A');
        $this->addSql('ALTER TABLE ponente DROP FOREIGN KEY FK_969EB3C8A954C5A1');
        $this->addSql('ALTER TABLE user_grupo DROP FOREIGN KEY FK_6ECC608BA76ED395');
        $this->addSql('ALTER TABLE user_grupo DROP FOREIGN KEY FK_6ECC608B9C833003');
        $this->addSql('DROP TABLE actividad');
        $this->addSql('DROP TABLE alumno');
        $this->addSql('DROP TABLE alumno_detalle_actividad');
        $this->addSql('DROP TABLE detalle_actividad');
        $this->addSql('DROP TABLE detalle_actividad_espacio');
        $this->addSql('DROP TABLE detalle_actividad_grupo');
        $this->addSql('DROP TABLE edificio');
        $this->addSql('DROP TABLE espacio');
        $this->addSql('DROP TABLE espacio_recurso');
        $this->addSql('DROP TABLE evento');
        $this->addSql('DROP TABLE grupo');
        $this->addSql('DROP TABLE nivel_educativo');
        $this->addSql('DROP TABLE ponente');
        $this->addSql('DROP TABLE recurso');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_grupo');
    }
}

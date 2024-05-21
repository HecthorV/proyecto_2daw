<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240426154453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actividad (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, fecha_hora_inicio DATETIME NOT NULL, fecha_hora_fin DATETIME DEFAULT NULL, compuesta TINYINT(1) NOT NULL, evento_id INT DEFAULT NULL, INDEX IDX_8DF2BD0687A5F842 (evento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE alumno_detalle_actividad (id INT AUTO_INCREMENT NOT NULL, alumno_id INT NOT NULL, detalle_actividad_id INT DEFAULT NULL, INDEX IDX_8FBC7449FC28E5EE (alumno_id), INDEX IDX_8FBC7449A954C5A1 (detalle_actividad_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE detalle_actividad (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, fecha_hora_inicio DATETIME NOT NULL, fecha_hora_fin DATETIME DEFAULT NULL, actividad_id INT DEFAULT NULL, INDEX IDX_AC9E0C466014FACA (actividad_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE evento (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, fecha_inicio DATE NOT NULL, fecha_fin VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user_grupo (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, grupo_id INT DEFAULT NULL, INDEX IDX_6ECC608BA76ED395 (user_id), INDEX IDX_6ECC608B9C833003 (grupo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE actividad ADD CONSTRAINT FK_8DF2BD0687A5F842 FOREIGN KEY (evento_id) REFERENCES evento (id)');
        $this->addSql('ALTER TABLE alumno_detalle_actividad ADD CONSTRAINT FK_8FBC7449FC28E5EE FOREIGN KEY (alumno_id) REFERENCES alumno (id)');
        $this->addSql('ALTER TABLE alumno_detalle_actividad ADD CONSTRAINT FK_8FBC7449A954C5A1 FOREIGN KEY (detalle_actividad_id) REFERENCES detalle_actividad (id)');
        $this->addSql('ALTER TABLE detalle_actividad ADD CONSTRAINT FK_AC9E0C466014FACA FOREIGN KEY (actividad_id) REFERENCES actividad (id)');
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
        $this->addSql('ALTER TABLE user_grupo DROP FOREIGN KEY FK_6ECC608BA76ED395');
        $this->addSql('ALTER TABLE user_grupo DROP FOREIGN KEY FK_6ECC608B9C833003');
        $this->addSql('DROP TABLE actividad');
        $this->addSql('DROP TABLE alumno_detalle_actividad');
        $this->addSql('DROP TABLE detalle_actividad');
        $this->addSql('DROP TABLE evento');
        $this->addSql('DROP TABLE user_grupo');
    }
}

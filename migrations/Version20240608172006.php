<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240608172006 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE detalle_actividad_espacio (detalle_actividad_id INT NOT NULL, espacio_id INT NOT NULL, INDEX IDX_5E1E2F63A954C5A1 (detalle_actividad_id), INDEX IDX_5E1E2F637CFC1D2C (espacio_id), PRIMARY KEY(detalle_actividad_id, espacio_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE detalle_actividad_grupo (detalle_actividad_id INT NOT NULL, grupo_id INT NOT NULL, INDEX IDX_973A41ACA954C5A1 (detalle_actividad_id), INDEX IDX_973A41AC9C833003 (grupo_id), PRIMARY KEY(detalle_actividad_id, grupo_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE detalle_actividad_espacio ADD CONSTRAINT FK_5E1E2F63A954C5A1 FOREIGN KEY (detalle_actividad_id) REFERENCES detalle_actividad (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detalle_actividad_espacio ADD CONSTRAINT FK_5E1E2F637CFC1D2C FOREIGN KEY (espacio_id) REFERENCES espacio (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detalle_actividad_grupo ADD CONSTRAINT FK_973A41ACA954C5A1 FOREIGN KEY (detalle_actividad_id) REFERENCES detalle_actividad (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detalle_actividad_grupo ADD CONSTRAINT FK_973A41AC9C833003 FOREIGN KEY (grupo_id) REFERENCES grupo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE detalle_actividad DROP FOREIGN KEY FK_AC9E0C467CFC1D2C');
        $this->addSql('DROP INDEX IDX_AC9E0C467CFC1D2C ON detalle_actividad');
        $this->addSql('ALTER TABLE detalle_actividad DROP espacio_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detalle_actividad_espacio DROP FOREIGN KEY FK_5E1E2F63A954C5A1');
        $this->addSql('ALTER TABLE detalle_actividad_espacio DROP FOREIGN KEY FK_5E1E2F637CFC1D2C');
        $this->addSql('ALTER TABLE detalle_actividad_grupo DROP FOREIGN KEY FK_973A41ACA954C5A1');
        $this->addSql('ALTER TABLE detalle_actividad_grupo DROP FOREIGN KEY FK_973A41AC9C833003');
        $this->addSql('DROP TABLE detalle_actividad_espacio');
        $this->addSql('DROP TABLE detalle_actividad_grupo');
        $this->addSql('ALTER TABLE detalle_actividad ADD espacio_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detalle_actividad ADD CONSTRAINT FK_AC9E0C467CFC1D2C FOREIGN KEY (espacio_id) REFERENCES espacio (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_AC9E0C467CFC1D2C ON detalle_actividad (espacio_id)');
    }
}

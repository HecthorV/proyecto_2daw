<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240611111558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detalle_actividad ADD espacio_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detalle_actividad ADD CONSTRAINT FK_AC9E0C467CFC1D2C FOREIGN KEY (espacio_id) REFERENCES espacio (id)');
        $this->addSql('CREATE INDEX IDX_AC9E0C467CFC1D2C ON detalle_actividad (espacio_id)');
        $this->addSql('ALTER TABLE espacio DROP FOREIGN KEY FK_90BF6AA42F4F3E2F');
        $this->addSql('DROP INDEX IDX_90BF6AA42F4F3E2F ON espacio');
        $this->addSql('ALTER TABLE espacio DROP actividades_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE espacio ADD actividades_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE espacio ADD CONSTRAINT FK_90BF6AA42F4F3E2F FOREIGN KEY (actividades_id) REFERENCES detalle_actividad (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_90BF6AA42F4F3E2F ON espacio (actividades_id)');
        $this->addSql('ALTER TABLE detalle_actividad DROP FOREIGN KEY FK_AC9E0C467CFC1D2C');
        $this->addSql('DROP INDEX IDX_AC9E0C467CFC1D2C ON detalle_actividad');
        $this->addSql('ALTER TABLE detalle_actividad DROP espacio_id');
    }
}

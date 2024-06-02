<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240601164103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actividad DROP FOREIGN KEY FK_8DF2BD0687A5F842');
        $this->addSql('DROP INDEX IDX_8DF2BD0687A5F842 ON actividad');
        $this->addSql('ALTER TABLE actividad ADD evento VARCHAR(255) DEFAULT NULL, DROP evento_id');
        $this->addSql('ALTER TABLE detalle_actividad ADD espacio_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detalle_actividad ADD CONSTRAINT FK_AC9E0C467CFC1D2C FOREIGN KEY (espacio_id) REFERENCES espacio (id)');
        $this->addSql('CREATE INDEX IDX_AC9E0C467CFC1D2C ON detalle_actividad (espacio_id)');
        $this->addSql('ALTER TABLE ponente ADD detalle_actividad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ponente ADD CONSTRAINT FK_969EB3C8A954C5A1 FOREIGN KEY (detalle_actividad_id) REFERENCES detalle_actividad (id)');
        $this->addSql('CREATE INDEX IDX_969EB3C8A954C5A1 ON ponente (detalle_actividad_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actividad ADD evento_id INT DEFAULT NULL, DROP evento');
        $this->addSql('ALTER TABLE actividad ADD CONSTRAINT FK_8DF2BD0687A5F842 FOREIGN KEY (evento_id) REFERENCES evento (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8DF2BD0687A5F842 ON actividad (evento_id)');
        $this->addSql('ALTER TABLE ponente DROP FOREIGN KEY FK_969EB3C8A954C5A1');
        $this->addSql('DROP INDEX IDX_969EB3C8A954C5A1 ON ponente');
        $this->addSql('ALTER TABLE ponente DROP detalle_actividad_id');
        $this->addSql('ALTER TABLE detalle_actividad DROP FOREIGN KEY FK_AC9E0C467CFC1D2C');
        $this->addSql('DROP INDEX IDX_AC9E0C467CFC1D2C ON detalle_actividad');
        $this->addSql('ALTER TABLE detalle_actividad DROP espacio_id');
    }
}
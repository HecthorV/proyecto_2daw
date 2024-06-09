<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240609131747 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actividad ADD evento_id INT DEFAULT NULL, DROP evento');
        $this->addSql('ALTER TABLE actividad ADD CONSTRAINT FK_8DF2BD0687A5F842 FOREIGN KEY (evento_id) REFERENCES evento (id)');
        $this->addSql('CREATE INDEX IDX_8DF2BD0687A5F842 ON actividad (evento_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actividad DROP FOREIGN KEY FK_8DF2BD0687A5F842');
        $this->addSql('DROP INDEX IDX_8DF2BD0687A5F842 ON actividad');
        $this->addSql('ALTER TABLE actividad ADD evento VARCHAR(255) DEFAULT NULL, DROP evento_id');
    }
}

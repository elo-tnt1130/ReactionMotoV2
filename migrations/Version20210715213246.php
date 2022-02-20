<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210715213246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE modeles CHANGE moteur_id moteur_id INT NULL, CHANGE permis_id permis_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pages ADD services_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pages ADD CONSTRAINT FK_2074E575AEF5A6C1 FOREIGN KEY (services_id) REFERENCES services (id)');
        $this->addSql('CREATE INDEX IDX_2074E575AEF5A6C1 ON pages (services_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE modeles CHANGE moteur_id moteur_id INT DEFAULT NULL, CHANGE permis_id permis_id INT NOT NULL');
        $this->addSql('ALTER TABLE pages DROP FOREIGN KEY FK_2074E575AEF5A6C1');
        $this->addSql('DROP INDEX IDX_2074E575AEF5A6C1 ON pages');
        $this->addSql('ALTER TABLE pages DROP services_id');
    }
}

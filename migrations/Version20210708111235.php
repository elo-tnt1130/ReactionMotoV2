<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210708111235 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE modeles ADD id_marque_id INT NOT NULL, ADD travaux_occasion LONGTEXT DEFAULT NULL, ADD kilometrage_occasion VARCHAR(100) DEFAULT NULL, ADD equipements_occasion LONGTEXT DEFAULT NULL, ADD check_occasion TINYINT(1) DEFAULT NULL, CHANGE lien_occasion lien_occasion VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE modeles ADD CONSTRAINT FK_7EAE1448C8120595 FOREIGN KEY (id_marque_id) REFERENCES marques (id)');
        $this->addSql('CREATE INDEX IDX_7EAE1448C8120595 ON modeles (id_marque_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE modeles DROP FOREIGN KEY FK_7EAE1448C8120595');
        $this->addSql('DROP INDEX IDX_7EAE1448C8120595 ON modeles');
        $this->addSql('ALTER TABLE modeles DROP id_marque_id, DROP travaux_occasion, DROP kilometrage_occasion, DROP equipements_occasion, DROP check_occasion, CHANGE lien_occasion lien_occasion VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

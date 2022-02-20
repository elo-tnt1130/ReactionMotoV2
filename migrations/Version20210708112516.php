<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210708112516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE permis (id INT AUTO_INCREMENT NOT NULL, lib_permis VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE modeles ADD permis_id INT NOT NULL');
        $this->addSql('ALTER TABLE modeles ADD CONSTRAINT FK_7EAE14483594A24E FOREIGN KEY (permis_id) REFERENCES permis (id)');
        $this->addSql('CREATE INDEX IDX_7EAE14483594A24E ON modeles (permis_id)');
        $this->addSql('ALTER TABLE modeles RENAME INDEX idx_7eae1448c8120595 TO IDX_7EAE14484827B9B2');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE modeles DROP FOREIGN KEY FK_7EAE14483594A24E');
        $this->addSql('DROP TABLE permis');
        $this->addSql('DROP INDEX IDX_7EAE14483594A24E ON modeles');
        $this->addSql('ALTER TABLE modeles DROP permis_id');
        $this->addSql('ALTER TABLE modeles RENAME INDEX idx_7eae14484827b9b2 TO IDX_7EAE1448C8120595');
    }
}

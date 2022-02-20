<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210708214033 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ets (id INT AUTO_INCREMENT NOT NULL, texte_accueil LONGTEXT NOT NULL, tel_ets VARCHAR(14) NOT NULL, fax_ets VARCHAR(14) DEFAULT NULL, mail1_ets VARCHAR(100) NOT NULL, mail2_ets VARCHAR(100) DEFAULT NULL, horaires LONGTEXT NOT NULL, adresse_ets VARCHAR(100) NOT NULL, cp_ets VARCHAR(5) NOT NULL, ville_ets VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ets');
    }
}

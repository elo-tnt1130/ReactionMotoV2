<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210708110548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE modeles (id INT AUTO_INCREMENT NOT NULL, lib_modele VARCHAR(50) NOT NULL, descr_neuf LONGTEXT DEFAULT NULL, prix_moto DOUBLE PRECISION NOT NULL, longueur_neuf INT DEFAULT NULL, largeur_neuf INT DEFAULT NULL, hauteur_selle_neuf INT DEFAULT NULL, conso_neuf DOUBLE PRECISION DEFAULT NULL, fiche_technique_neuf VARCHAR(50) DEFAULT NULL, img1_moto LONGTEXT DEFAULT NULL, img2_moto LONGTEXT DEFAULT NULL, img3_moto LONGTEXT DEFAULT NULL, img4_moto LONGTEXT DEFAULT NULL, descr_occasion LONGTEXT DEFAULT NULL, lien_occasion VARCHAR(100) NOT NULL, text VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE modeles');
    }
}

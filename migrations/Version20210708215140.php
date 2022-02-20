<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210708215140 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE forfaits (id INT AUTO_INCREMENT NOT NULL, services_id INT DEFAULT NULL, lib_forfait VARCHAR(100) NOT NULL, descr_forfait LONGTEXT DEFAULT NULL, prix_forfait DOUBLE PRECISION NOT NULL, INDEX IDX_180398C3AEF5A6C1 (services_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, services_id INT DEFAULT NULL, lib_img LONGTEXT DEFAULT NULL, INDEX IDX_E01FBE6AAEF5A6C1 (services_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pages (id INT AUTO_INCREMENT NOT NULL, lib_page VARCHAR(150) NOT NULL, bloc1 LONGTEXT NOT NULL, bloc2 LONGTEXT DEFAULT NULL, bloc3 LONGTEXT DEFAULT NULL, bloc4 LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pages_images (pages_id INT NOT NULL, images_id INT NOT NULL, INDEX IDX_4D95C565401ADD27 (pages_id), INDEX IDX_4D95C565D44F05E5 (images_id), PRIMARY KEY(pages_id, images_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE services (id INT AUTO_INCREMENT NOT NULL, lib_service VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE forfaits ADD CONSTRAINT FK_180398C3AEF5A6C1 FOREIGN KEY (services_id) REFERENCES services (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6AAEF5A6C1 FOREIGN KEY (services_id) REFERENCES services (id)');
        $this->addSql('ALTER TABLE pages_images ADD CONSTRAINT FK_4D95C565401ADD27 FOREIGN KEY (pages_id) REFERENCES pages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pages_images ADD CONSTRAINT FK_4D95C565D44F05E5 FOREIGN KEY (images_id) REFERENCES images (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pages_images DROP FOREIGN KEY FK_4D95C565D44F05E5');
        $this->addSql('ALTER TABLE pages_images DROP FOREIGN KEY FK_4D95C565401ADD27');
        $this->addSql('ALTER TABLE forfaits DROP FOREIGN KEY FK_180398C3AEF5A6C1');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6AAEF5A6C1');
        $this->addSql('DROP TABLE forfaits');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE pages');
        $this->addSql('DROP TABLE pages_images');
        $this->addSql('DROP TABLE services');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210708205103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE couleurs (id INT AUTO_INCREMENT NOT NULL, lib_couleur VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modeles_couleurs (modeles_id INT NOT NULL, couleurs_id INT NOT NULL, INDEX IDX_5E95CB57708408C (modeles_id), INDEX IDX_5E95CB575ED47289 (couleurs_id), PRIMARY KEY(modeles_id, couleurs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE modeles_couleurs ADD CONSTRAINT FK_5E95CB57708408C FOREIGN KEY (modeles_id) REFERENCES modeles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modeles_couleurs ADD CONSTRAINT FK_5E95CB575ED47289 FOREIGN KEY (couleurs_id) REFERENCES couleurs (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE modeles_couleurs DROP FOREIGN KEY FK_5E95CB575ED47289');
        $this->addSql('DROP TABLE couleurs');
        $this->addSql('DROP TABLE modeles_couleurs');
    }
}

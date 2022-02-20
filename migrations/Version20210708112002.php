<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210708112002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE moteurs (id INT AUTO_INCREMENT NOT NULL, cylindree INT NOT NULL, puissance_ch VARCHAR(50) DEFAULT NULL, couple_nm VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE modeles DROP FOREIGN KEY FK_7EAE1448C8120595');
        $this->addSql('DROP INDEX IDX_7EAE1448C8120595 ON modeles');
        $this->addSql('ALTER TABLE modeles ADD moteur_id INT NOT NULL, CHANGE marque_id id_marque_id INT NOT NULL');
        $this->addSql('ALTER TABLE modeles ADD CONSTRAINT FK_7EAE14486BF4B111 FOREIGN KEY (moteur_id) REFERENCES moteurs (id)');
        $this->addSql('ALTER TABLE modeles ADD CONSTRAINT FK_7EAE1448C8120595 FOREIGN KEY (id_marque_id) REFERENCES marques (id)');
        $this->addSql('CREATE INDEX IDX_7EAE14486BF4B111 ON modeles (moteur_id)');
        $this->addSql('CREATE INDEX IDX_7EAE1448C8120595 ON modeles (id_marque_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE modeles DROP FOREIGN KEY FK_7EAE14486BF4B111');
        $this->addSql('DROP TABLE moteurs');
        $this->addSql('ALTER TABLE modeles DROP FOREIGN KEY FK_7EAE1448C8120595');
        $this->addSql('DROP INDEX IDX_7EAE14486BF4B111 ON modeles');
        $this->addSql('DROP INDEX IDX_7EAE1448C8120595 ON modeles');
        $this->addSql('ALTER TABLE modeles ADD marque_id INT NOT NULL, DROP id_marque_id, DROP moteur_id');
        $this->addSql('ALTER TABLE modeles ADD CONSTRAINT FK_7EAE1448C8120595 FOREIGN KEY (marque_id) REFERENCES marques (id)');
        $this->addSql('CREATE INDEX IDX_7EAE1448C8120595 ON modeles (marque_id)');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210716171554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images ADD nom_img VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE modeles CHANGE marque_id marque_id INT NOT NULL');
        $this->addSql('ALTER TABLE pages CHANGE services_id services_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images DROP nom_img');
        $this->addSql('ALTER TABLE modeles CHANGE marque_id marque_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pages CHANGE services_id services_id INT NOT NULL');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210708210309 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE aides_conduite (id INT AUTO_INCREMENT NOT NULL, lib_aide_conduite VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modeles_aides_conduite (modeles_id INT NOT NULL, aides_conduite_id INT NOT NULL, INDEX IDX_616BDE72708408C (modeles_id), INDEX IDX_616BDE7271A05DEB (aides_conduite_id), PRIMARY KEY(modeles_id, aides_conduite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE modeles_aides_conduite ADD CONSTRAINT FK_616BDE72708408C FOREIGN KEY (modeles_id) REFERENCES modeles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE modeles_aides_conduite ADD CONSTRAINT FK_616BDE7271A05DEB FOREIGN KEY (aides_conduite_id) REFERENCES aides_conduite (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE modeles_aides_conduite DROP FOREIGN KEY FK_616BDE7271A05DEB');
        $this->addSql('DROP TABLE aides_conduite');
        $this->addSql('DROP TABLE modeles_aides_conduite');
    }
}

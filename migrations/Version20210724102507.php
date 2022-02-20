<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210724102507 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE pages_images');
        $this->addSql('ALTER TABLE images ADD pages_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A401ADD27 FOREIGN KEY (pages_id) REFERENCES pages (id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6A401ADD27 ON images (pages_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pages_images (pages_id INT NOT NULL, images_id INT NOT NULL, INDEX IDX_4D95C565401ADD27 (pages_id), INDEX IDX_4D95C565D44F05E5 (images_id), PRIMARY KEY(pages_id, images_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE pages_images ADD CONSTRAINT FK_4D95C565401ADD27 FOREIGN KEY (pages_id) REFERENCES pages (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pages_images ADD CONSTRAINT FK_4D95C565D44F05E5 FOREIGN KEY (images_id) REFERENCES images (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A401ADD27');
        $this->addSql('DROP INDEX IDX_E01FBE6A401ADD27 ON images');
        $this->addSql('ALTER TABLE images DROP pages_id');
    }
}

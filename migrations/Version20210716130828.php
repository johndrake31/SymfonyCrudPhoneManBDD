<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210716130828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE phone ADD constructeur_id INT NOT NULL');
        $this->addSql('ALTER TABLE phone ADD CONSTRAINT FK_444F97DD8815B605 FOREIGN KEY (constructeur_id) REFERENCES constructeur (id)');
        $this->addSql('CREATE INDEX IDX_444F97DD8815B605 ON phone (constructeur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE phone DROP FOREIGN KEY FK_444F97DD8815B605');
        $this->addSql('DROP INDEX IDX_444F97DD8815B605 ON phone');
        $this->addSql('ALTER TABLE phone DROP constructeur_id');
    }
}

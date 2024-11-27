<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241127205148 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sponsor DROP FOREIGN KEY FK_818CC9D4EA5C70D7');
        $this->addSql('ALTER TABLE sponsor ADD CONSTRAINT FK_818CC9D4EA5C70D7 FOREIGN KEY (nom_ev_id) REFERENCES event (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sponsor DROP FOREIGN KEY FK_818CC9D4EA5C70D7');
        $this->addSql('ALTER TABLE sponsor ADD CONSTRAINT FK_818CC9D4EA5C70D7 FOREIGN KEY (nom_ev_id) REFERENCES event (id)');
    }
}

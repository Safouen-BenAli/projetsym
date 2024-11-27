<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241127191359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, titre_ac VARCHAR(255) NOT NULL, date_ac DATETIME NOT NULL, description_ac LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog (id INT AUTO_INCREMENT NOT NULL, titre_bl VARCHAR(255) NOT NULL, contenue VARCHAR(255) NOT NULL, auteur VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description_cl LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, blog_id INT NOT NULL, conteneu VARCHAR(255) NOT NULL, auteur_co VARCHAR(255) NOT NULL, datecommentaitre DATETIME NOT NULL, email_co VARCHAR(255) NOT NULL, INDEX IDX_67F068BCDAE07E97 (blog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, nom_ev VARCHAR(255) NOT NULL, date_ev DATETIME NOT NULL, lieu_ev VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, nom_fo VARCHAR(255) NOT NULL, description_fo LONGTEXT NOT NULL, niveau_fo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE progress (id INT AUTO_INCREMENT NOT NULL, score_pr INT NOT NULL, etat_pr VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sponsor (id INT AUTO_INCREMENT NOT NULL, nom_ev_id INT DEFAULT NULL, nom_sp VARCHAR(255) NOT NULL, date_debut_sp DATETIME NOT NULL, montant_contrat DOUBLE PRECISION NOT NULL, date_fin_sp DATE NOT NULL, INDEX IDX_818CC9D4EA5C70D7 (nom_ev_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCDAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id)');
        $this->addSql('ALTER TABLE sponsor ADD CONSTRAINT FK_818CC9D4EA5C70D7 FOREIGN KEY (nom_ev_id) REFERENCES event (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCDAE07E97');
        $this->addSql('ALTER TABLE sponsor DROP FOREIGN KEY FK_818CC9D4EA5C70D7');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE blog');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE progress');
        $this->addSql('DROP TABLE sponsor');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

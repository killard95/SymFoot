<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230425213844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, budget INT NOT NULL, renommee INT DEFAULT NULL, points INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joueur (id INT AUTO_INCREMENT NOT NULL, entity_equipe_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, poste VARCHAR(255) NOT NULL, vitesse INT NOT NULL, dribble INT NOT NULL, tir INT NOT NULL, renommee INT NOT NULL, salaire INT NOT NULL, arret INT DEFAULT NULL, INDEX IDX_FD71A9C51BF8AEA5 (entity_equipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE manager (id INT AUTO_INCREMENT NOT NULL, entity_equipe_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, salaire INT NOT NULL, INDEX IDX_FA2425B91BF8AEA5 (entity_equipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C51BF8AEA5 FOREIGN KEY (entity_equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE manager ADD CONSTRAINT FK_FA2425B91BF8AEA5 FOREIGN KEY (entity_equipe_id) REFERENCES equipe (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C51BF8AEA5');
        $this->addSql('ALTER TABLE manager DROP FOREIGN KEY FK_FA2425B91BF8AEA5');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE joueur');
        $this->addSql('DROP TABLE manager');
    }
}

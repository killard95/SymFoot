<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230501100340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rencontre (id INT AUTO_INCREMENT NOT NULL, equipe1_id INT DEFAULT NULL, equipe2_id INT DEFAULT NULL, score VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_460C35ED4265900C (equipe1_id), UNIQUE INDEX UNIQ_460C35ED50D03FE2 (equipe2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED4265900C FOREIGN KEY (equipe1_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED50D03FE2 FOREIGN KEY (equipe2_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE equipe CHANGE budget budget INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED4265900C');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED50D03FE2');
        $this->addSql('DROP TABLE rencontre');
        $this->addSql('ALTER TABLE equipe CHANGE budget budget INT DEFAULT NULL');
    }
}

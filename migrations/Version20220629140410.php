<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220629140410 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicule ADD couleur VARCHAR(50) NOT NULL, ADD taille VARCHAR(50) NOT NULL, ADD collection VARCHAR(50) NOT NULL, ADD stock INT NOT NULL, DROP modele, DROP marque, CHANGE prix_journalier prix INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicule ADD modele VARCHAR(50) NOT NULL, ADD marque VARCHAR(50) NOT NULL, ADD prix_journalier INT NOT NULL, DROP couleur, DROP taille, DROP collection, DROP prix, DROP stock');
    }
}

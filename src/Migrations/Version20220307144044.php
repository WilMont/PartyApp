<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220307144044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE invitation (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, evenement_id INT DEFAULT NULL, date_invitation DATETIME NOT NULL, INDEX IDX_F11D61A2FB88E14F (utilisateur_id), INDEX IDX_F11D61A2FD02F13 (evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE invitation ADD CONSTRAINT FK_F11D61A2FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE invitation ADD CONSTRAINT FK_F11D61A2FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenements (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE invitation');
        $this->addSql('ALTER TABLE categories CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE commentaires CHANGE contenu contenu LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE compte CHANGE nom nom VARCHAR(100) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE prenom prenom VARCHAR(100) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE username username VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE evenements CHANGE titre titre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE contenu contenu LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE video video VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}

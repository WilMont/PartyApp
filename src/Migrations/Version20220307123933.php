<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220307123933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE participation_compte');
        $this->addSql('DROP TABLE participation_evenements');
        $this->addSql('ALTER TABLE participation ADD id_utilisateur_id INT DEFAULT NULL, ADD id_evenements_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FDDE8FDB1 FOREIGN KEY (id_evenements_id) REFERENCES evenements (id)');
        $this->addSql('CREATE INDEX IDX_AB55E24FC6EE5C49 ON participation (id_utilisateur_id)');
        $this->addSql('CREATE INDEX IDX_AB55E24FDDE8FDB1 ON participation (id_evenements_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participation_compte (participation_id INT NOT NULL, compte_id INT NOT NULL, INDEX IDX_B593D4456ACE3B73 (participation_id), INDEX IDX_B593D445F2C56620 (compte_id), PRIMARY KEY(participation_id, compte_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE participation_evenements (participation_id INT NOT NULL, evenements_id INT NOT NULL, INDEX IDX_3B04EBFE63C02CD4 (evenements_id), INDEX IDX_3B04EBFE6ACE3B73 (participation_id), PRIMARY KEY(participation_id, evenements_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE participation_compte ADD CONSTRAINT FK_B593D4456ACE3B73 FOREIGN KEY (participation_id) REFERENCES participation (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation_compte ADD CONSTRAINT FK_B593D445F2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation_evenements ADD CONSTRAINT FK_3B04EBFE63C02CD4 FOREIGN KEY (evenements_id) REFERENCES evenements (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation_evenements ADD CONSTRAINT FK_3B04EBFE6ACE3B73 FOREIGN KEY (participation_id) REFERENCES participation (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categories CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE commentaires CHANGE contenu contenu LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE compte CHANGE nom nom VARCHAR(100) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE prenom prenom VARCHAR(100) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE username username VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(100) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE evenements CHANGE titre titre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE contenu contenu LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE video video VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24FC6EE5C49');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24FDDE8FDB1');
        $this->addSql('DROP INDEX IDX_AB55E24FC6EE5C49 ON participation');
        $this->addSql('DROP INDEX IDX_AB55E24FDDE8FDB1 ON participation');
        $this->addSql('ALTER TABLE participation DROP id_utilisateur_id, DROP id_evenements_id');
    }
}

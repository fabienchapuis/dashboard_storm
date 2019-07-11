<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190711143450 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE saison (id INT AUTO_INCREMENT NOT NULL, evenements_id INT DEFAULT NULL, nom VARCHAR(45) NOT NULL, user_id INT NOT NULL, INDEX IDX_C0D0D58663C02CD4 (evenements_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE saison_user (saison_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B9E948B5F965414C (saison_id), INDEX IDX_B9E948B5A76ED395 (user_id), PRIMARY KEY(saison_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(50) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(60) NOT NULL, telephone VARCHAR(15) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, lieux VARCHAR(45) NOT NULL, nbenfants INT DEFAULT NULL, distance INT DEFAULT NULL, precense VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, evenement_id INT NOT NULL, placedispo INT DEFAULT NULL, user_id INT NOT NULL, INDEX IDX_5FB6DEC7FD02F13 (evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse_user (reponse_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B1F89F0ACF18BB82 (reponse_id), INDEX IDX_B1F89F0AA76ED395 (user_id), PRIMARY KEY(reponse_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE saison ADD CONSTRAINT FK_C0D0D58663C02CD4 FOREIGN KEY (evenements_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE saison_user ADD CONSTRAINT FK_B9E948B5F965414C FOREIGN KEY (saison_id) REFERENCES saison (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE saison_user ADD CONSTRAINT FK_B9E948B5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE reponse_user ADD CONSTRAINT FK_B1F89F0ACF18BB82 FOREIGN KEY (reponse_id) REFERENCES reponse (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reponse_user ADD CONSTRAINT FK_B1F89F0AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE saison_user DROP FOREIGN KEY FK_B9E948B5F965414C');
        $this->addSql('ALTER TABLE saison_user DROP FOREIGN KEY FK_B9E948B5A76ED395');
        $this->addSql('ALTER TABLE reponse_user DROP FOREIGN KEY FK_B1F89F0AA76ED395');
        $this->addSql('ALTER TABLE saison DROP FOREIGN KEY FK_C0D0D58663C02CD4');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7FD02F13');
        $this->addSql('ALTER TABLE reponse_user DROP FOREIGN KEY FK_B1F89F0ACF18BB82');
        $this->addSql('DROP TABLE saison');
        $this->addSql('DROP TABLE saison_user');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE reponse_user');
    }
}

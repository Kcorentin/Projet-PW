<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230103143143 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, administration TINYINT(1) NOT NULL, login VARCHAR(200) NOT NULL, date_creation DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', UNIQUE INDEX UNIQ_497B315EE7927C74 (email), UNIQUE INDEX UNIQ_497B315EAA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE biens_immobiliers ADD CONSTRAINT FK_ED62A1E0C54C8C93 FOREIGN KEY (type_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE biens_recherche ADD CONSTRAINT FK_B0AEB778C54C8C93 FOREIGN KEY (type_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE favoris ADD CONSTRAINT FK_8933C4327773350C FOREIGN KEY (biens_id) REFERENCES biens_immobiliers (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A7773350C FOREIGN KEY (biens_id) REFERENCES biens_immobiliers (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE utilisateurs');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE biens_immobiliers DROP FOREIGN KEY FK_ED62A1E0C54C8C93');
        $this->addSql('ALTER TABLE biens_recherche DROP FOREIGN KEY FK_B0AEB778C54C8C93');
        $this->addSql('ALTER TABLE favoris DROP FOREIGN KEY FK_8933C4327773350C');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A7773350C');
    }
}

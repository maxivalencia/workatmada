<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220319082329 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, typeannonce_id INT NOT NULL, domaine_id INT NOT NULL, userid_id INT NOT NULL, titre VARCHAR(255) NOT NULL, contenue LONGTEXT NOT NULL, datelimite DATE NOT NULL, dossier VARCHAR(255) DEFAULT NULL, reference VARCHAR(255) DEFAULT NULL, INDEX IDX_F65593E5715F4B22 (typeannonce_id), INDEX IDX_F65593E54272FC9F (domaine_id), INDEX IDX_F65593E558E0A285 (userid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE curriculum (id INT AUTO_INCREMENT NOT NULL, userid_id INT NOT NULL, filename VARCHAR(255) NOT NULL, servername VARCHAR(255) NOT NULL, INDEX IDX_7BE2A7C358E0A285 (userid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE domaine (id INT AUTO_INCREMENT NOT NULL, domaine VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, userid_id INT NOT NULL, destinataire_id INT NOT NULL, typefile_id INT NOT NULL, filename VARCHAR(255) NOT NULL, servername VARCHAR(255) NOT NULL, INDEX IDX_8C9F361058E0A285 (userid_id), INDEX IDX_8C9F3610A4F84F6E (destinataire_id), INDEX IDX_8C9F3610492FF5D7 (typefile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, userid_id INT NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_C53D045F58E0A285 (userid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pub (id INT AUTO_INCREMENT NOT NULL, userid_id INT DEFAULT NULL, image VARCHAR(255) NOT NULL, lien VARCHAR(255) DEFAULT NULL, isactive TINYINT(1) NOT NULL, INDEX IDX_5A443C8558E0A285 (userid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_annonce (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_compte (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_file (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, type_compte_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) DEFAULT NULL, tel VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, isactive TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D64946032730 (type_compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5715F4B22 FOREIGN KEY (typeannonce_id) REFERENCES type_annonce (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E54272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E558E0A285 FOREIGN KEY (userid_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE curriculum ADD CONSTRAINT FK_7BE2A7C358E0A285 FOREIGN KEY (userid_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F361058E0A285 FOREIGN KEY (userid_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610A4F84F6E FOREIGN KEY (destinataire_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610492FF5D7 FOREIGN KEY (typefile_id) REFERENCES type_file (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F58E0A285 FOREIGN KEY (userid_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE pub ADD CONSTRAINT FK_5A443C8558E0A285 FOREIGN KEY (userid_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D64946032730 FOREIGN KEY (type_compte_id) REFERENCES type_compte (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E54272FC9F');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5715F4B22');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64946032730');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610492FF5D7');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E558E0A285');
        $this->addSql('ALTER TABLE curriculum DROP FOREIGN KEY FK_7BE2A7C358E0A285');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F361058E0A285');
        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610A4F84F6E');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F58E0A285');
        $this->addSql('ALTER TABLE pub DROP FOREIGN KEY FK_5A443C8558E0A285');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE curriculum');
        $this->addSql('DROP TABLE domaine');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE pub');
        $this->addSql('DROP TABLE type_annonce');
        $this->addSql('DROP TABLE type_compte');
        $this->addSql('DROP TABLE type_file');
        $this->addSql('DROP TABLE `user`');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220410062523 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pub_hor (id INT AUTO_INCREMENT NOT NULL, userid_id INT DEFAULT NULL, image VARCHAR(255) NOT NULL, lien VARCHAR(255) DEFAULT NULL, isactive TINYINT(1) NOT NULL, INDEX IDX_40DD551E58E0A285 (userid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pub_ver (id INT AUTO_INCREMENT NOT NULL, userid_id INT DEFAULT NULL, image VARCHAR(255) NOT NULL, lien VARCHAR(255) DEFAULT NULL, isactive TINYINT(1) NOT NULL, INDEX IDX_AC8A33EE58E0A285 (userid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pub_hor ADD CONSTRAINT FK_40DD551E58E0A285 FOREIGN KEY (userid_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE pub_ver ADD CONSTRAINT FK_AC8A33EE58E0A285 FOREIGN KEY (userid_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE pub_hor');
        $this->addSql('DROP TABLE pub_ver');
    }
}

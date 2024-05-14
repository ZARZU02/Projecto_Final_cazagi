<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240513110340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alumnos (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, apellidos VARCHAR(255) NOT NULL, correo VARCHAR(255) NOT NULL, telefono VARCHAR(255) NOT NULL, deportes VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clases (id INT AUTO_INCREMENT NOT NULL, deporte VARCHAR(255) NOT NULL, entrenador VARCHAR(255) NOT NULL, dia VARCHAR(255) NOT NULL, hora TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clases_alumnos (clases_id INT NOT NULL, alumnos_id INT NOT NULL, INDEX IDX_D0360C9E158CCF68 (clases_id), INDEX IDX_D0360C9EA03F5ABF (alumnos_id), PRIMARY KEY(clases_id, alumnos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consejos (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(255) NOT NULL, descripcion VARCHAR(1000) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contactos (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, direccion VARCHAR(255) NOT NULL, telefono INT NOT NULL, nombre VARCHAR(255) NOT NULL, apellidos VARCHAR(255) NOT NULL, deportes VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clases_alumnos ADD CONSTRAINT FK_D0360C9E158CCF68 FOREIGN KEY (clases_id) REFERENCES clases (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE clases_alumnos ADD CONSTRAINT FK_D0360C9EA03F5ABF FOREIGN KEY (alumnos_id) REFERENCES alumnos (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clases_alumnos DROP FOREIGN KEY FK_D0360C9E158CCF68');
        $this->addSql('ALTER TABLE clases_alumnos DROP FOREIGN KEY FK_D0360C9EA03F5ABF');
        $this->addSql('DROP TABLE alumnos');
        $this->addSql('DROP TABLE clases');
        $this->addSql('DROP TABLE clases_alumnos');
        $this->addSql('DROP TABLE consejos');
        $this->addSql('DROP TABLE contactos');
        $this->addSql('DROP TABLE user');
    }
}

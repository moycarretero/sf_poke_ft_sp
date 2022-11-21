<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221121112633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE debilidad (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE debilidad_pokemon (debilidad_id INT NOT NULL, pokemon_id INT NOT NULL, INDEX IDX_CF8A9471D7C99BD5 (debilidad_id), INDEX IDX_CF8A94712FE71C3E (pokemon_id), PRIMARY KEY(debilidad_id, pokemon_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE debilidad_pokemon ADD CONSTRAINT FK_CF8A9471D7C99BD5 FOREIGN KEY (debilidad_id) REFERENCES debilidad (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE debilidad_pokemon ADD CONSTRAINT FK_CF8A94712FE71C3E FOREIGN KEY (pokemon_id) REFERENCES pokemon (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE debilidad_pokemon DROP FOREIGN KEY FK_CF8A9471D7C99BD5');
        $this->addSql('ALTER TABLE debilidad_pokemon DROP FOREIGN KEY FK_CF8A94712FE71C3E');
        $this->addSql('DROP TABLE debilidad');
        $this->addSql('DROP TABLE debilidad_pokemon');
    }
}

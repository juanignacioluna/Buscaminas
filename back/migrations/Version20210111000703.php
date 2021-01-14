<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210111000703 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jugador ADD ultimo_tiempo INT NOT NULL, ADD mejor_tiempo INT NOT NULL, DROP ultimo_puntaje, DROP mejor_puntaje');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jugador ADD ultimo_puntaje INT NOT NULL, ADD mejor_puntaje INT NOT NULL, DROP ultimo_tiempo, DROP mejor_tiempo');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230110144659 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE championships (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(8) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE days (id INT AUTO_INCREMENT NOT NULL, championship_id INT DEFAULT NULL, seed INT NOT NULL, INDEX IDX_EBE4FC6694DDBCE9 (championship_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE games (id INT AUTO_INCREMENT NOT NULL, day_id INT DEFAULT NULL, home_score INT NOT NULL, outsider_score INT NOT NULL, INDEX IDX_FF232B319C24126 (day_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE players (id INT AUTO_INCREMENT NOT NULL, team_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, position VARCHAR(255) NOT NULL, club VARCHAR(255) NOT NULL, age INT NOT NULL, INDEX IDX_264E43A6296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teams (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, championship_id INT DEFAULT NULL, game_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, stadium VARCHAR(255) NOT NULL, coach VARCHAR(255) NOT NULL, INDEX IDX_96C22258A76ED395 (user_id), INDEX IDX_96C2225894DDBCE9 (championship_id), UNIQUE INDEX UNIQ_96C22258E48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), UNIQUE INDEX UNIQ_1483A5E9F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE days ADD CONSTRAINT FK_EBE4FC6694DDBCE9 FOREIGN KEY (championship_id) REFERENCES championships (id)');
        $this->addSql('ALTER TABLE games ADD CONSTRAINT FK_FF232B319C24126 FOREIGN KEY (day_id) REFERENCES days (id)');
        $this->addSql('ALTER TABLE players ADD CONSTRAINT FK_264E43A6296CD8AE FOREIGN KEY (team_id) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE teams ADD CONSTRAINT FK_96C22258A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE teams ADD CONSTRAINT FK_96C2225894DDBCE9 FOREIGN KEY (championship_id) REFERENCES championships (id)');
        $this->addSql('ALTER TABLE teams ADD CONSTRAINT FK_96C22258E48FD905 FOREIGN KEY (game_id) REFERENCES games (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE days DROP FOREIGN KEY FK_EBE4FC6694DDBCE9');
        $this->addSql('ALTER TABLE games DROP FOREIGN KEY FK_FF232B319C24126');
        $this->addSql('ALTER TABLE players DROP FOREIGN KEY FK_264E43A6296CD8AE');
        $this->addSql('ALTER TABLE teams DROP FOREIGN KEY FK_96C22258A76ED395');
        $this->addSql('ALTER TABLE teams DROP FOREIGN KEY FK_96C2225894DDBCE9');
        $this->addSql('ALTER TABLE teams DROP FOREIGN KEY FK_96C22258E48FD905');
        $this->addSql('DROP TABLE championships');
        $this->addSql('DROP TABLE days');
        $this->addSql('DROP TABLE games');
        $this->addSql('DROP TABLE players');
        $this->addSql('DROP TABLE teams');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

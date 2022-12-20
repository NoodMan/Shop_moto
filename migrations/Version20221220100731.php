<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221220100731 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE moto ADD photo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE moto ADD CONSTRAINT FK_3DDDBCE47E9E4C8C FOREIGN KEY (photo_id) REFERENCES photo (id)');
        $this->addSql('CREATE INDEX IDX_3DDDBCE47E9E4C8C ON moto (photo_id)');
        $this->addSql('ALTER TABLE moto_panier ADD moto_id INT DEFAULT NULL, ADD panier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE moto_panier ADD CONSTRAINT FK_343C20EF78B8F2AC FOREIGN KEY (moto_id) REFERENCES moto (id)');
        $this->addSql('ALTER TABLE moto_panier ADD CONSTRAINT FK_343C20EFF77D927C FOREIGN KEY (panier_id) REFERENCES panier (id)');
        $this->addSql('CREATE INDEX IDX_343C20EF78B8F2AC ON moto_panier (moto_id)');
        $this->addSql('CREATE INDEX IDX_343C20EFF77D927C ON moto_panier (panier_id)');
        $this->addSql('ALTER TABLE panier ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF282EA2E54 FOREIGN KEY (commande_id) REFERENCES panier (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_24CC0DF282EA2E54 ON panier (commande_id)');
        $this->addSql('ALTER TABLE user ADD adresse_id INT DEFAULT NULL, ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6494DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64982EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6494DE7DC5C ON user (adresse_id)');
        $this->addSql('CREATE INDEX IDX_8D93D64982EA2E54 ON user (commande_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE moto DROP FOREIGN KEY FK_3DDDBCE47E9E4C8C');
        $this->addSql('DROP INDEX IDX_3DDDBCE47E9E4C8C ON moto');
        $this->addSql('ALTER TABLE moto DROP photo_id');
        $this->addSql('ALTER TABLE moto_panier DROP FOREIGN KEY FK_343C20EF78B8F2AC');
        $this->addSql('ALTER TABLE moto_panier DROP FOREIGN KEY FK_343C20EFF77D927C');
        $this->addSql('DROP INDEX IDX_343C20EF78B8F2AC ON moto_panier');
        $this->addSql('DROP INDEX IDX_343C20EFF77D927C ON moto_panier');
        $this->addSql('ALTER TABLE moto_panier DROP moto_id, DROP panier_id');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF282EA2E54');
        $this->addSql('DROP INDEX UNIQ_24CC0DF282EA2E54 ON panier');
        $this->addSql('ALTER TABLE panier DROP commande_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6494DE7DC5C');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64982EA2E54');
        $this->addSql('DROP INDEX IDX_8D93D6494DE7DC5C ON user');
        $this->addSql('DROP INDEX IDX_8D93D64982EA2E54 ON user');
        $this->addSql('ALTER TABLE user DROP adresse_id, DROP commande_id');
    }
}

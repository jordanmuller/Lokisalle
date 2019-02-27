<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190226164410 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product DROP INDEX UNIQ_D34A04AD54177093, ADD INDEX IDX_D34A04AD54177093 (room_id)');
        $this->addSql('ALTER TABLE opinion DROP INDEX UNIQ_AB02B02754177093, ADD INDEX IDX_AB02B02754177093 (room_id)');
        $this->addSql('ALTER TABLE opinion DROP INDEX UNIQ_AB02B027A76ED395, ADD INDEX IDX_AB02B027A76ED395 (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE opinion DROP INDEX IDX_AB02B027A76ED395, ADD UNIQUE INDEX UNIQ_AB02B027A76ED395 (user_id)');
        $this->addSql('ALTER TABLE opinion DROP INDEX IDX_AB02B02754177093, ADD UNIQUE INDEX UNIQ_AB02B02754177093 (room_id)');
        $this->addSql('ALTER TABLE product DROP INDEX IDX_D34A04AD54177093, ADD UNIQUE INDEX UNIQ_D34A04AD54177093 (room_id)');
    }
}

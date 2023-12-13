<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231213144157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('UPDATE "user" SET created_at = NOW()');
        $this->addSql('ALTER TABLE "user" ALTER COLUMN created_at SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD is_active BOOLEAN');
        $this->addSql('UPDATE "user" SET is_active = true');
        $this->addSql('ALTER TABLE "user" ALTER COLUMN is_active SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD is_admin BOOLEAN');
        $this->addSql('UPDATE "user" SET is_admin = false');
        $this->addSql('ALTER TABLE "user" ALTER COLUMN is_admin SET NOT NULL');
        $this->addSql('COMMENT ON COLUMN "user".created_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" DROP created_at');
        $this->addSql('ALTER TABLE "user" DROP is_active');
        $this->addSql('ALTER TABLE "user" DROP is_admin');
    }
}

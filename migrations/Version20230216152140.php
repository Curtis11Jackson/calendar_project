<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230216152140 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404555741EEB9');
        $this->addSql('DROP INDEX fk_c74404555741eeb9 ON client');
        $this->addSql('CREATE INDEX IDX_C74404555741EEB9 ON client (fk_user_id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404555741EEB9 FOREIGN KEY (fk_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sales_rep DROP FOREIGN KEY FK_15AF24E85741EEB9');
        $this->addSql('DROP INDEX IDX_15AF24E85741EEB9 ON sales_rep');
        $this->addSql('ALTER TABLE sales_rep DROP fk_user_id');
        $this->addSql('ALTER TABLE timetable ADD start DATE NOT NULL, ADD end DATE NOT NULL, DROP hour');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404555741EEB9');
        $this->addSql('DROP INDEX idx_c74404555741eeb9 ON client');
        $this->addSql('CREATE INDEX FK_C74404555741EEB9 ON client (fk_user_id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404555741EEB9 FOREIGN KEY (fk_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sales_rep ADD fk_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE sales_rep ADD CONSTRAINT FK_15AF24E85741EEB9 FOREIGN KEY (fk_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_15AF24E85741EEB9 ON sales_rep (fk_user_id)');
        $this->addSql('ALTER TABLE timetable ADD hour VARCHAR(50) NOT NULL, DROP start, DROP end');
    }
}

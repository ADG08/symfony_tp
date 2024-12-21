<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241220170501 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE comment (id SERIAL NOT NULL, publication_id INT DEFAULT NULL, parent_comment_id INT DEFAULT NULL, publisher_id INT DEFAULT NULL, content TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9474526C38B217A7 ON comment (publication_id)');
        $this->addSql('CREATE INDEX IDX_9474526CBF2AF943 ON comment (parent_comment_id)');
        $this->addSql('CREATE INDEX IDX_9474526C40C86FCE ON comment (publisher_id)');
        $this->addSql('CREATE TABLE publication (id SERIAL NOT NULL, publisher_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AF3C677940C86FCE ON publication (publisher_id)');
        $this->addSql('CREATE TABLE reaction (id SERIAL NOT NULL, reactor_id INT DEFAULT NULL, publication_id INT DEFAULT NULL, comment_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A4D707F7723AD41B ON reaction (reactor_id)');
        $this->addSql('CREATE INDEX IDX_A4D707F738B217A7 ON reaction (publication_id)');
        $this->addSql('CREATE INDEX IDX_A4D707F7F8697D13 ON reaction (comment_id)');
        $this->addSql('CREATE TABLE tag (id SERIAL NOT NULL, label VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tag_publication (tag_id INT NOT NULL, publication_id INT NOT NULL, PRIMARY KEY(tag_id, publication_id))');
        $this->addSql('CREATE INDEX IDX_B3F51D99BAD26311 ON tag_publication (tag_id)');
        $this->addSql('CREATE INDEX IDX_B3F51D9938B217A7 ON tag_publication (publication_id)');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C38B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CBF2AF943 FOREIGN KEY (parent_comment_id) REFERENCES comment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C40C86FCE FOREIGN KEY (publisher_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C677940C86FCE FOREIGN KEY (publisher_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reaction ADD CONSTRAINT FK_A4D707F7723AD41B FOREIGN KEY (reactor_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reaction ADD CONSTRAINT FK_A4D707F738B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reaction ADD CONSTRAINT FK_A4D707F7F8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tag_publication ADD CONSTRAINT FK_B3F51D99BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tag_publication ADD CONSTRAINT FK_B3F51D9938B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C38B217A7');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CBF2AF943');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C40C86FCE');
        $this->addSql('ALTER TABLE publication DROP CONSTRAINT FK_AF3C677940C86FCE');
        $this->addSql('ALTER TABLE reaction DROP CONSTRAINT FK_A4D707F7723AD41B');
        $this->addSql('ALTER TABLE reaction DROP CONSTRAINT FK_A4D707F738B217A7');
        $this->addSql('ALTER TABLE reaction DROP CONSTRAINT FK_A4D707F7F8697D13');
        $this->addSql('ALTER TABLE tag_publication DROP CONSTRAINT FK_B3F51D99BAD26311');
        $this->addSql('ALTER TABLE tag_publication DROP CONSTRAINT FK_B3F51D9938B217A7');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE publication');
        $this->addSql('DROP TABLE reaction');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_publication');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

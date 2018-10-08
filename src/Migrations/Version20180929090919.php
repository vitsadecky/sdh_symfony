<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180929090919 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66F675F31B');
        $this->addSql('ALTER TABLE article ADD attendance INT NOT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD author_id INT DEFAULT NULL, DROP author, CHANGE commented_at commented_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9474526CF675F31B ON comment (author_id)');
        $this->addSql('ALTER TABLE document ADD downloaded INT NOT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE file_name file_name VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA729CCBAD0');
        $this->addSql('DROP INDEX IDX_3BAE0AA729CCBAD0 ON event');
        $this->addSql('ALTER TABLE event ADD name VARCHAR(50) NOT NULL, ADD latitude DOUBLE PRECISION DEFAULT NULL, ADD longitude DOUBLE PRECISION DEFAULT NULL, ADD date_time DATETIME NOT NULL, DROP content, DROP author, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE forum_id author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7F675F31B ON event (author_id)');
        $this->addSql('ALTER TABLE forum CHANGE created_at created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD author_id INT DEFAULT NULL, ADD attendance INT NOT NULL, DROP author');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DF675F31B ON post (author_id)');
        $this->addSql('ALTER TABLE user CHANGE first_name first_name VARCHAR(30) DEFAULT NULL, CHANGE surname surname VARCHAR(50) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66F675F31B');
        $this->addSql('ALTER TABLE article DROP attendance');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66F675F31B FOREIGN KEY (author_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CF675F31B');
        $this->addSql('DROP INDEX IDX_9474526CF675F31B ON comment');
        $this->addSql('ALTER TABLE comment ADD author VARCHAR(10) NOT NULL COLLATE utf8mb4_unicode_ci, DROP author_id, CHANGE commented_at commented_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE document DROP downloaded, CHANGE created_at created_at DATETIME NOT NULL, CHANGE description description VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE file_name file_name VARCHAR(120) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7F675F31B');
        $this->addSql('DROP INDEX IDX_3BAE0AA7F675F31B ON event');
        $this->addSql('ALTER TABLE event ADD content LONGBLOB NOT NULL, ADD author VARCHAR(10) NOT NULL COLLATE utf8mb4_unicode_ci, DROP name, DROP latitude, DROP longitude, DROP date_time, CHANGE created_at created_at DATETIME NOT NULL, CHANGE author_id forum_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA729CCBAD0 FOREIGN KEY (forum_id) REFERENCES forum (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA729CCBAD0 ON event (forum_id)');
        $this->addSql('ALTER TABLE forum CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DF675F31B');
        $this->addSql('DROP INDEX IDX_5A8A6C8DF675F31B ON post');
        $this->addSql('ALTER TABLE post ADD author VARCHAR(10) NOT NULL COLLATE utf8mb4_unicode_ci, DROP author_id, DROP attendance');
        $this->addSql('ALTER TABLE user CHANGE first_name first_name VARCHAR(30) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE surname surname VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE created_at created_at DATETIME NOT NULL');
    }
}

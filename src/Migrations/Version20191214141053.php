<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191214141053 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE lwc_cms_block (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(64) NOT NULL, enabled TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_1A7780077153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lwc_cms_block_sections (block_id INT NOT NULL, section_id INT NOT NULL, INDEX IDX_33B3B298E9ED820C (block_id), INDEX IDX_33B3B298D823E37A (section_id), PRIMARY KEY(block_id, section_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lwc_cms_block_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, content LONGTEXT DEFAULT NULL, link LONGTEXT DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_F2CA41CC2C2AC5D3 (translatable_id), UNIQUE INDEX lwc_cms_block_translation_uniq_trans (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lwc_cms_faq (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, position INT NOT NULL, enabled TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lwc_cms_faq_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT NOT NULL, question LONGTEXT NOT NULL, answer LONGTEXT NOT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_6051CDB22C2AC5D3 (translatable_id), UNIQUE INDEX lwc_cms_faq_translation_uniq_trans (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lwc_cms_media (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(250) NOT NULL, type VARCHAR(250) NOT NULL, path VARCHAR(250) NOT NULL, mime_type VARCHAR(250) DEFAULT NULL, enabled TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_E8904E2E77153098 (code), UNIQUE INDEX UNIQ_E8904E2EB548B0F (path), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lwc_cms_media_sections (media_id INT NOT NULL, section_id INT NOT NULL, INDEX IDX_66AD60C5EA9FDD75 (media_id), INDEX IDX_66AD60C5D823E37A (section_id), PRIMARY KEY(media_id, section_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lwc_cms_media_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, content LONGTEXT DEFAULT NULL, alt LONGTEXT DEFAULT NULL, link LONGTEXT DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_DFAF66842C2AC5D3 (translatable_id), UNIQUE INDEX lwc_cms_media_translation_uniq_trans (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lwc_cms_page (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(250) NOT NULL, enabled TINYINT(1) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_A011557677153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lwc_cms_page_sections (block_id INT NOT NULL, section_id INT NOT NULL, INDEX IDX_439CC791E9ED820C (block_id), INDEX IDX_439CC791D823E37A (section_id), PRIMARY KEY(block_id, section_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lwc_cms_page_image (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, path VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_53502B3E7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lwc_cms_page_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT NOT NULL, slug VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, breadcrumb VARCHAR(255) DEFAULT NULL, name_when_linked VARCHAR(255) DEFAULT NULL, description_when_linked VARCHAR(1000) DEFAULT NULL, meta_keywords VARCHAR(1000) DEFAULT NULL, meta_description VARCHAR(5000) DEFAULT NULL, content LONGTEXT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_482CAD92C2AC5D3 (translatable_id), UNIQUE INDEX lwc_cms_page_translation_uniq_trans (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lwc_cms_section (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(250) NOT NULL, UNIQUE INDEX UNIQ_BA74419A77153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lwc_cms_section_translation (id INT AUTO_INCREMENT NOT NULL, translatable_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, INDEX IDX_591234222C2AC5D3 (translatable_id), UNIQUE INDEX lwc_cms_section_translation_uniq_trans (translatable_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sylius_locale (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(12) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_7BA1286477153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lwc_cms_block_sections ADD CONSTRAINT FK_33B3B298E9ED820C FOREIGN KEY (block_id) REFERENCES lwc_cms_block (id)');
        $this->addSql('ALTER TABLE lwc_cms_block_sections ADD CONSTRAINT FK_33B3B298D823E37A FOREIGN KEY (section_id) REFERENCES lwc_cms_section (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lwc_cms_block_translation ADD CONSTRAINT FK_F2CA41CC2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES lwc_cms_block (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lwc_cms_faq_translation ADD CONSTRAINT FK_6051CDB22C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES lwc_cms_faq (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lwc_cms_media_sections ADD CONSTRAINT FK_66AD60C5EA9FDD75 FOREIGN KEY (media_id) REFERENCES lwc_cms_media (id)');
        $this->addSql('ALTER TABLE lwc_cms_media_sections ADD CONSTRAINT FK_66AD60C5D823E37A FOREIGN KEY (section_id) REFERENCES lwc_cms_section (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lwc_cms_media_translation ADD CONSTRAINT FK_DFAF66842C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES lwc_cms_media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lwc_cms_page_sections ADD CONSTRAINT FK_439CC791E9ED820C FOREIGN KEY (block_id) REFERENCES lwc_cms_page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lwc_cms_page_sections ADD CONSTRAINT FK_439CC791D823E37A FOREIGN KEY (section_id) REFERENCES lwc_cms_section (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lwc_cms_page_image ADD CONSTRAINT FK_53502B3E7E3C61F9 FOREIGN KEY (owner_id) REFERENCES lwc_cms_page_translation (id)');
        $this->addSql('ALTER TABLE lwc_cms_page_translation ADD CONSTRAINT FK_482CAD92C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES lwc_cms_page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lwc_cms_section_translation ADD CONSTRAINT FK_591234222C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES lwc_cms_section (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lwc_cms_block_sections DROP FOREIGN KEY FK_33B3B298E9ED820C');
        $this->addSql('ALTER TABLE lwc_cms_block_translation DROP FOREIGN KEY FK_F2CA41CC2C2AC5D3');
        $this->addSql('ALTER TABLE lwc_cms_faq_translation DROP FOREIGN KEY FK_6051CDB22C2AC5D3');
        $this->addSql('ALTER TABLE lwc_cms_media_sections DROP FOREIGN KEY FK_66AD60C5EA9FDD75');
        $this->addSql('ALTER TABLE lwc_cms_media_translation DROP FOREIGN KEY FK_DFAF66842C2AC5D3');
        $this->addSql('ALTER TABLE lwc_cms_page_sections DROP FOREIGN KEY FK_439CC791E9ED820C');
        $this->addSql('ALTER TABLE lwc_cms_page_translation DROP FOREIGN KEY FK_482CAD92C2AC5D3');
        $this->addSql('ALTER TABLE lwc_cms_page_image DROP FOREIGN KEY FK_53502B3E7E3C61F9');
        $this->addSql('ALTER TABLE lwc_cms_block_sections DROP FOREIGN KEY FK_33B3B298D823E37A');
        $this->addSql('ALTER TABLE lwc_cms_media_sections DROP FOREIGN KEY FK_66AD60C5D823E37A');
        $this->addSql('ALTER TABLE lwc_cms_page_sections DROP FOREIGN KEY FK_439CC791D823E37A');
        $this->addSql('ALTER TABLE lwc_cms_section_translation DROP FOREIGN KEY FK_591234222C2AC5D3');
        $this->addSql('DROP TABLE lwc_cms_block');
        $this->addSql('DROP TABLE lwc_cms_block_sections');
        $this->addSql('DROP TABLE lwc_cms_block_translation');
        $this->addSql('DROP TABLE lwc_cms_faq');
        $this->addSql('DROP TABLE lwc_cms_faq_translation');
        $this->addSql('DROP TABLE lwc_cms_media');
        $this->addSql('DROP TABLE lwc_cms_media_sections');
        $this->addSql('DROP TABLE lwc_cms_media_translation');
        $this->addSql('DROP TABLE lwc_cms_page');
        $this->addSql('DROP TABLE lwc_cms_page_sections');
        $this->addSql('DROP TABLE lwc_cms_page_image');
        $this->addSql('DROP TABLE lwc_cms_page_translation');
        $this->addSql('DROP TABLE lwc_cms_section');
        $this->addSql('DROP TABLE lwc_cms_section_translation');
        $this->addSql('DROP TABLE sylius_locale');
    }
}

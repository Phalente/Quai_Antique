<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230316153434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allergy (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories_meals (categories_id INT NOT NULL, meals_id INT NOT NULL, INDEX IDX_E62AF3A7A21214B7 (categories_id), INDEX IDX_E62AF3A788A25CA2 (meals_id), PRIMARY KEY(categories_id, meals_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formulas (id INT AUTO_INCREMENT NOT NULL, price DOUBLE PRECISION NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meals (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meals_menus (meals_id INT NOT NULL, menus_id INT NOT NULL, INDEX IDX_9F5A0AB288A25CA2 (meals_id), INDEX IDX_9F5A0AB214041B84 (menus_id), PRIMARY KEY(meals_id, menus_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menus (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menus_formulas (menus_id INT NOT NULL, formulas_id INT NOT NULL, INDEX IDX_E3378CEF14041B84 (menus_id), INDEX IDX_E3378CEFE30F9153 (formulas_id), PRIMARY KEY(menus_id, formulas_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, picture_name VARCHAR(500) DEFAULT NULL, picture_title VARCHAR(255) DEFAULT NULL, text_alt LONGTEXT DEFAULT NULL, slider TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, restaurant_hour_id INT NOT NULL, user_id INT DEFAULT NULL, date DATETIME NOT NULL, hour TIME NOT NULL, number_of_covers INT NOT NULL, INDEX IDX_42C849557FD8278C (restaurant_hour_id), INDEX IDX_42C84955A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_allergy (reservation_id INT NOT NULL, allergy_id INT NOT NULL, INDEX IDX_AC24F930B83297E7 (reservation_id), INDEX IDX_AC24F930DBFD579D (allergy_id), PRIMARY KEY(reservation_id, allergy_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant_hours (id INT AUTO_INCREMENT NOT NULL, day VARCHAR(50) NOT NULL, opening_lunch TIME DEFAULT NULL, closing_lunch TIME DEFAULT NULL, places_available_lunch INT NOT NULL, opening_dinner TIME DEFAULT NULL, closing_dinner TIME DEFAULT NULL, places_available_dinner INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', nbr_of_covers_by_default INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_allergy (user_id INT NOT NULL, allergy_id INT NOT NULL, INDEX IDX_93BC5CBFA76ED395 (user_id), INDEX IDX_93BC5CBFDBFD579D (allergy_id), PRIMARY KEY(user_id, allergy_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categories_meals ADD CONSTRAINT FK_E62AF3A7A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categories_meals ADD CONSTRAINT FK_E62AF3A788A25CA2 FOREIGN KEY (meals_id) REFERENCES meals (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meals_menus ADD CONSTRAINT FK_9F5A0AB288A25CA2 FOREIGN KEY (meals_id) REFERENCES meals (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meals_menus ADD CONSTRAINT FK_9F5A0AB214041B84 FOREIGN KEY (menus_id) REFERENCES menus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menus_formulas ADD CONSTRAINT FK_E3378CEF14041B84 FOREIGN KEY (menus_id) REFERENCES menus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menus_formulas ADD CONSTRAINT FK_E3378CEFE30F9153 FOREIGN KEY (formulas_id) REFERENCES formulas (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849557FD8278C FOREIGN KEY (restaurant_hour_id) REFERENCES restaurant_hours (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation_allergy ADD CONSTRAINT FK_AC24F930B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_allergy ADD CONSTRAINT FK_AC24F930DBFD579D FOREIGN KEY (allergy_id) REFERENCES allergy (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_allergy ADD CONSTRAINT FK_93BC5CBFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_allergy ADD CONSTRAINT FK_93BC5CBFDBFD579D FOREIGN KEY (allergy_id) REFERENCES allergy (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories_meals DROP FOREIGN KEY FK_E62AF3A7A21214B7');
        $this->addSql('ALTER TABLE categories_meals DROP FOREIGN KEY FK_E62AF3A788A25CA2');
        $this->addSql('ALTER TABLE meals_menus DROP FOREIGN KEY FK_9F5A0AB288A25CA2');
        $this->addSql('ALTER TABLE meals_menus DROP FOREIGN KEY FK_9F5A0AB214041B84');
        $this->addSql('ALTER TABLE menus_formulas DROP FOREIGN KEY FK_E3378CEF14041B84');
        $this->addSql('ALTER TABLE menus_formulas DROP FOREIGN KEY FK_E3378CEFE30F9153');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849557FD8278C');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395');
        $this->addSql('ALTER TABLE reservation_allergy DROP FOREIGN KEY FK_AC24F930B83297E7');
        $this->addSql('ALTER TABLE reservation_allergy DROP FOREIGN KEY FK_AC24F930DBFD579D');
        $this->addSql('ALTER TABLE user_allergy DROP FOREIGN KEY FK_93BC5CBFA76ED395');
        $this->addSql('ALTER TABLE user_allergy DROP FOREIGN KEY FK_93BC5CBFDBFD579D');
        $this->addSql('DROP TABLE allergy');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE categories_meals');
        $this->addSql('DROP TABLE formulas');
        $this->addSql('DROP TABLE meals');
        $this->addSql('DROP TABLE meals_menus');
        $this->addSql('DROP TABLE menus');
        $this->addSql('DROP TABLE menus_formulas');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE reservation_allergy');
        $this->addSql('DROP TABLE restaurant_hours');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_allergy');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

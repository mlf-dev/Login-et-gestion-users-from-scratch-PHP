-- se connecter au serveur Mysql avec le user root --
mysql -u root -p

-- quitter mysql --
exit

-- créer une base de données qui se nomme td_php_db --
CREATE DATABASE td_php_db CHARACTER SET UTF8mb4 COLLATE utf8mb4_general_ci;

-- voir les bases de données --
SHOW DATABASES;

-- sélectionner une base de donnée --
USE td_php_db;

-- créer une table --
CREATE TABLE users(
    id INT NOT NULL AUTO_INCREMENT,
    login VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    is_admin BOOLEAN DEFAULT 0,
    created_at DATETIME NOT NULL,
    CONSTRAINT primarykey_users_id PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- CONSTRAINT contrainte permettant de générer une erreur s'il y a deux fois le même id --

-- consulter le schéma d'une table --
DESC users;

-- supprimer une table --
DROP TABLE users;


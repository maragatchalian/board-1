--Create Database
CREATE DATABASE IF NOT EXISTS board;
GRANT SELECT, INSERT, UPDATE, DELETE ON board.* TO board_root@localhost IDENTIFIED BY 'board_root';
FLUSH PRIVILEGES;

--Create Tables
USE board;

--User Table
CREATE TABLE IF NOT EXISTS user (
     id INT(11) NOT NULL AUTO_INCREMENT,
     username VARCHAR(50) NOT NULL,
     first_name VARCHAR(50) NOT NULL,
     last_name VARCHAR(50) NOT NULL,
     email_address VARCHAR(255) NOT NULL, 
     password VARCHAR(50) NOT NULL,
     PRIMARY KEY (id)
)ENGINE=InnoDB;

--Thread Table
CREATE TABLE IF NOT EXISTS thread (
    id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    title VARCHAR(50) NOT NULL,
    created DATETIME,
    PRIMARY KEY (id)
)ENGINE=InnoDB;

--Comment Table
CREATE TABLE IF NOT EXISTS comment (
    id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    thread_id INT(11) UNSIGNED NOT NULL,
    username VARCHAR(11) NOT NULL,
    body TEXT NOT NULL,
    created DATETIME,
    PRIMARY KEY (id)
)ENGINE=InnoDB;

--Like Table
CREATE TABLE IF NOT EXISTS likes (
    id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    comment_id INT(11) UNSIGNED NOT NULL,
    user_id INT(11) UNSIGNED NOT NULL,
    PRIMARY KEY (id) 
)ENGINE=InnoDB;

--Follow Table
CREATE TABLE IF NOT EXISTS follow (
    id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    thread_id INT(11) UNSIGNED NOT NULL,
    user_id INT(11) UNSIGNED NOT NULL,
    PRIMARY KEY (id)
)ENGINE=InnoDB;

--Follow Table
CREATE TABLE IF NOT EXISTS avatar (
    id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT(11) UNSIGNED NOT NULL,
    image_path TINYINT(4),
    PRIMARY KEY (id)
)ENGINE=InnoDB;


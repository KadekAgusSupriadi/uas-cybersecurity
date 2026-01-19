CREATE DATABASE uas_vuln;
USE uas_vuln;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(50)
);

INSERT INTO users VALUES
(1,'admin','admin'),
(2,'secureadmin','admin123');

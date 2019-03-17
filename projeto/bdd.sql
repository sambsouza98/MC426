CREATE DATABASE health;
USE health;

CREATE TABLE Usuario(
id INT not null,
cpf INT PRIMARY KEY,
email VARCHAR(50),
senha VARCHAR(50)
)
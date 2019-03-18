CREATE DATABASE health;
USE health;

CREATE TABLE Usuario(
idUsuario INT NOT NULL AUTO_INCREMENT,
email VARCHAR(50) NOT NULL,
senha VARCHAR(50) NOT NULL,
tipoUsuario INT NOT NULL,
dataDeInclusao DATE NOT NULL,
PRIMARY KEY(idUsuario)
);

CREATE TABLE Paciente(
cpf INT NOT NULL,
nome VARCHAR(50) NOT NULL,
email VARCHAR(50) NOT NULL,
telefone VARCHAR(11),
dataDeNascimento DATE,
convenio VARCHAR(50),
sexo CHAR,
tipoSanguineo VARCHAR(3),
alergias VARCHAR(128),
idUsuario INT NOT NULL,
PRIMARY KEY(cpf),
FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario)
);

CREATE TABLE Hospital(
cnpj INT NOT NULL,
nome VARCHAR(50) NOT NULL,
email VARCHAR(50) NOT NULL,
telefone VARCHAR(11),
endereco VARCHAR(50),
dataDeAbertura DATE,
dataDeFechamento DATE,
autenticado BOOLEAN DEFAULT FALSE,
conveniosAceitos VARCHAR(50),
idUsuario INT NOT NULL,
PRIMARY KEY(cnpj),
FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario)
);

CREATE TABLE Medico(
crm INT NOT NULL,
cpf INT NOT NULL,
nome VARCHAR(50) NOT NULL,
especializacao VARCHAR(50),
telefone VARCHAR(11),
email VARCHAR(50) NOT NULL,
idUsuario INT NOT NULL,
PRIMARY KEY(crm),
FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario)
);

CREATE TABLE MedicoHospital(
crm INT NOT NULL,
cnpj INT NOT NULL,
FOREIGN KEY (crm) REFERENCES Medico(crm),
FOREIGN KEY (cnpj) REFERENCES Hospital(cnpj)
);

CREATE TABLE Agendamento(
idAgendamento INT NOT NULL AUTO_INCREMENT,
cpf INT NOT NULL,
cnpj INT NOT NULL,
crm INT,
dataDeConsulta DATE,
dataDeSolicitacao DATE NOT NULL,
processado BOOLEAN DEFAULT FALSE,
PRIMARY KEY(idAgendamento),
FOREIGN KEY (cpf) REFERENCES Paciente(cpf),
FOREIGN KEY (cnpj) REFERENCES Hospital(cnpj),
FOREIGN KEY (crm) REFERENCES Medico(crm)
);

INSERT INTO Usuario (email, senha, tipoUsuario, DataDeInclusao) VALUES ("admin@admin.com", "admin", 0, "2019-03-16") 
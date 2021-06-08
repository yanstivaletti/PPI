CREATE TABLE MEDICO (
  CODIGO int AUTO_INCREMENT PRIMARY KEY,
  CRM varchar(50),
  ESPECIALIDADE varchar(50)
) ENGINE=InnoDB;
CREATE TABLE FUNCIONARIO (
  DataContrato date,
  Salario int,
  SenhaHash varchar(50),
  Codigo int AUTO_INCREMENT PRIMARY KEY
) ENGINE=InnoDB;
CREATE TABLE PACIENTE (
  codigo int AUTO_INCREMENT PRIMARY KEY,
  tipo_sanguineo varchar(4),
  altura int,
  peso int
) ENGINE=InnoDB;
CREATE TABLE PESSOA (
  codigo int AUTO_INCREMENT PRIMARY KEY,
  nome varchar(50),
  cep char(14),
  email varchar(50),
  logradouro varchar(50),
  estado varchar(50),
  telefone varchar(30),
  cidade varchar(20),
  sexo varchar(10)
) ENGINE=InnoDB;
CREATE TABLE ENDERECO (
  CEP varchar(20) NOT NULL,
  Logradouro varchar(60),
  Cidade varchar(60),
  Estado varchar(30)
) ENGINE=InnoDB;
CREATE TABLE AGENDA (
  Codigo int AUTO_INCREMENT PRIMARY KEY,
  _DATA date,
  Horário int,
  Nome varchar(100),
  Sexo varchar(30),
  Email varchar(50),
  CodigoMedico int,
  FOREIGN KEY (CodigoMedico) REFERENCES MEDICO(CODIGO)
) ENGINE=InnoDB;




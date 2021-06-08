CREATE TABLE veiculo
(
   id int PRIMARY KEY auto_increment,
   tipo varchar(50),
   marca varchar(50),
   modelo varchar(50)
) ENGINE=InnoDB;

CREATE TABLE veiculo_multa
(
   id int PRIMARY KEY auto_increment,
   valor decimal(10,2),
   descricao varchar(50),
   id_veiculo int not null,
   FOREIGN KEY (id_veiculo) REFERENCES veiculo(id) ON DELETE CASCADE
) ENGINE=InnoDB;
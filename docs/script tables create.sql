CREATE DATABASE slim3_gerenciador_de_lojas CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE slim3_gerenciador_de_lojas;

CREATE TABLE lojas (
id INT UNSIGNED NOT NULL AUTO_INCREMENT,
nome VARCHAR(100) NOT NULL,
telefone VARCHAR(13) NOT NULL,
endereco VARCHAR(200) NOT NULL,
ativo BIT NOT NULL DEFAULT 1,
PRIMARY KEY(id)
);

CREATE TABLE produtos (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    loja_id INT UNSIGNED NOT NULL,
    nome VARCHAR(100) NOT NULL,
    preco DECIMAL(6,2) NOT NULL,
    quantidade INT UNSIGNED NOT NULL,    
    ativo BIT NOT NULL DEFAULT 1,    
    PRIMARY KEY(id),
    CONSTRAINT fk_produtos_loja_id_lojas_id
		FOREIGN KEY (loja_id) REFERENCES lojas(id)
);

-- INSERT --
INSERT INTO lojas (nome, telefone, endereco)
VALUES
	('codeeasy','9898-9988','Rua dos Sonhos'),
    ('RJR Informatica', '3831-2044', 'Av. Pascoal, 46, Centro'),
    ('Arpion','3839-0234','Av. Israel Pinheiro, 4077, Centro');
    
INSERT INTO produtos (loja_id, nome, preco, quantidade)
VALUES
	(1,'Teclado com fio',29.99,20),
    (1,'Monitor 25"',399.99,4),
    (1,'Mouse sem fio',24.40,30),
    (3,'Mouse sem fio',28.90,10),
    (3,'Fonte ATX 500W',199.00,4),
    (3,'Monitor 25"', 340.00 ,2);
DROP DATABASE IF EXISTS clinica_db;

CREATE DATABASE clinica_db;

USE clinica_db;

SET autocommit = 0;
START TRANSACTION;

CREATE TABLE IF NOT EXISTS Clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS Servicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_servico VARCHAR(100) NOT NULL UNIQUE,
    descricao TEXT
);

CREATE TABLE IF NOT EXISTS Pets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    nome_pet VARCHAR(100) NOT NULL,
    sexo CHAR(1) COMMENT 'M para Macho, F para Fêmea',
    
    FOREIGN KEY (id_cliente) 
        REFERENCES Clientes(id_cliente)
        ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Consultas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pet INT NOT NULL,
    id_servico INT NOT NULL,
    data_consulta DATETIME NOT NULL,
    status_consulta VARCHAR(50) NOT NULL DEFAULT 'Agendada',
    observacoes TEXT,
    
    FOREIGN KEY (id_pet) 
        REFERENCES Pets(id_pet)
        ON DELETE CASCADE,
        
    FOREIGN KEY (id_servico) 
        REFERENCES Servicos(id_servico)
        ON DELETE RESTRICT
);

INSERT INTO Clientes (nome, email, senha, telefone) VALUES
('Matheus Henrique', 'matheus@email.com', '$2y$10$Y9/g1.m92m.tqgCg/T8.luH.1b.Xk.X2q.Yg3.Z2r.Z4r.Z4r.Z4d', '(41) 99999-0001'),
('Ana Silva', 'ana.silva@email.com', '$2y$10$Y9/g1.m92m.tqgCg/T8.luH.1b.Xk.X2q.Yg3.Z2r.Z4r.Z4r.Z4e', '(41) 98888-0002');

INSERT INTO Servicos (nome_servico, descricao) VALUES
('Consulta de Rotina', 'Check-up geral da saúde do animal.'),
('Vacinação V10', 'Aplicação da vacina polivalente V10 para cães.'),
('Banho & Tosa', 'Serviço de higiene e estética animal.'),
('Castração', 'Procedimento cirúrgico para castração.');

INSERT INTO Pets (id_cliente, nome_pet, sexo) VALUES
(1, 'Rex', 'M'),
(2, 'Mia', 'F'),
(2, 'Toby', 'M');

INSERT INTO Consultas (id_pet, id_servico, data_consulta, status_consulta, observacoes) VALUES
(1, 1, '2025-11-20 14:30:00', 'Agendada', 'Rex parece estar coçando muito a orelha.'),
(2, 2, '2025-11-21 10:00:00', 'Agendada', 'Primeira vacina da Mia.'),
(3, 3, '2025-11-22 11:00:00', 'Concluída', 'Tosa completa, animal estava com muitos nós.');

COMMIT;

SET autocommit = 1;
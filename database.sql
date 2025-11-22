DROP DATABASE IF EXISTS clinica_db;

CREATE DATABASE clinica_db;

USE clinica_db;

SET autocommit = 0;
START TRANSACTION;

CREATE TABLE IF NOT EXISTS `User` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS Service (
    id INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL UNIQUE,
    `description` TEXT
);

CREATE TABLE IF NOT EXISTS Pet (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `type` ENUM('dog', 'cat', 'other') NOT NULL,
    gender CHAR(1) COMMENT 'M for Male, F for Female',
    
    FOREIGN KEY (user_id) 
        REFERENCES User(id)
        ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Appointment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pet_id INT NOT NULL,
    service_id INT NOT NULL,
    appointment_date DATE NOT NULL,
    infos TEXT,
    
    FOREIGN KEY (pet_id) 
        REFERENCES Pet(id)
        ON DELETE CASCADE,
        
    FOREIGN KEY (service_id) 
        REFERENCES Service(id)
        ON DELETE RESTRICT
);

INSERT INTO User (name, email, password, phone) VALUES
('Matheus Henrique', 'matheus@email.com', '$2y$10$Y9/g1.m92m.tqgCg/T8.luH.1b.Xk.X2q.Yg3.Z2r.Z4r.Z4r.Z4d', '(41) 99999-0001'),
('Ana Silva', 'ana.silva@email.com', '$2y$10$Y9/g1.m92m.tqgCg/T8.luH.1b.Xk.X2q.Yg3.Z2r.Z4r.Z4r.Z4e', '(41) 98888-0002');

INSERT INTO Service (name, description) VALUES
('Consulta', 'Check-up geral da saúde do animal.'),
('Banho', 'Serviço de higiene e estética animal.'),
('Tosa', 'Corte e aparo dos pelos do animal.'),
('Vacinação', 'Aplicação de vacinas para prevenção de doenças.');

INSERT INTO Pet (user_id, `name`, `type`, gender) VALUES
(1, 'Rex', 'dog', 'M'),
(1, 'Mia', 'cat', 'F'),
(1, 'Toby', 'other', 'M');

INSERT INTO Appointment (pet_id, service_id, appointment_date, infos) VALUES
(1, 1, '2025-11-20 14:30:00', 'Rex parece estar coçando muito a orelha.'),
(2, 2, '2025-11-21 10:00:00', 'Primeira vacina da Mia.'),
(3, 3, '2025-11-22 11:00:00', 'Tosa completa, animal estava com muitos nós.');

COMMIT;

SET autocommit = 1;
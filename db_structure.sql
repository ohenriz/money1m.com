
CREATE DATABASE money1m;

USE money1m;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha_hash VARCHAR(255) NOT NULL,
    saldo DECIMAL(15,2) DEFAULT 0.00
);

CREATE TABLE transacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    tipo ENUM('deposito', 'saque') NOT NULL,
    valor DECIMAL(15,2) NOT NULL,
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE apostas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    jogo VARCHAR(50) NOT NULL,
    resultado VARCHAR(255) NOT NULL,
    valor_apostado DECIMAL(15,2) NOT NULL,
    ganho DECIMAL(15,2) DEFAULT 0.00,
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

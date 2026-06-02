CREATE DATABASE IF NOT EXISTS db_web_luiza_vitoria_banco;
USE db_web_luiza_vitoria_banco;

-- 1. TABELA OBRIGATÓRIA DE USUÁRIOS 
CREATE TABLE IF NOT EXISTS usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    login VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

-- 2. TABELA FUNCIONÁRIO 
CREATE TABLE IF NOT EXISTS funcionario (
    id INT AUTO_INCREMENT NOT NULL,
    nome VARCHAR(50) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    nascimento DATE NOT NULL,
    admissao DATE NOT NULL,
    demissao DATE NULL,
    funcao VARCHAR(50) NOT NULL DEFAULT '',
    status ENUM('Ativo','Afastado', 'Desativado') NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- 3. TABELA CLIENTE 
CREATE TABLE IF NOT EXISTS cliente (
    id INT AUTO_INCREMENT NOT NULL,
    nome VARCHAR(50) NOT NULL DEFAULT '',
    razao_social VARCHAR(100) NULL DEFAULT '',
    cpf VARCHAR(14) NULL DEFAULT '',
    cnpj VARCHAR(18) NULL DEFAULT '',
    telefone VARCHAR(15) NOT NULL DEFAULT '',
    email VARCHAR(50) NOT NULL DEFAULT '',
    endereco VARCHAR(100) NOT NULL DEFAULT '',
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- 4. TABELA PRODUTO 
CREATE TABLE IF NOT EXISTS produto (
    id INT AUTO_INCREMENT NOT NULL,
    nome VARCHAR(50) NOT NULL DEFAULT '',
    categoria ENUM('Armação','Lente','Óculos de sol','Outros') NOT NULL,
    tipo_lente ENUM('Visão Simples','Progressiva') NULL,
    descricao VARCHAR(50) NOT NULL DEFAULT '',
    marca VARCHAR(50) NOT NULL DEFAULT '',
    preco_custo DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    preco_venda DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    estoque INT NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Inserção do administrador - testar o login
INSERT INTO usuario (nome, telefone, email, login, senha) 
VALUES ('Administrador', '49999999999', 'admin@admin.com', 'admin', '123')
ON DUPLICATE KEY UPDATE login=login;
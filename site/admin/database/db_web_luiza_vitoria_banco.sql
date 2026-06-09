-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para db_web_luiza_vitoria_banco
CREATE DATABASE IF NOT EXISTS `db_web_luiza_vitoria_banco` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_web_luiza_vitoria_banco`;

-- Copiando estrutura para tabela db_web_luiza_vitoria_banco.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL DEFAULT '',
  `razao_social` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '',
  `cpf` varchar(11) DEFAULT '',
  `cnpj` varchar(14) DEFAULT '',
  `telefone` varchar(20) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '',
  `rua` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `cidade` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `cep` varchar(9) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela db_web_luiza_vitoria_banco.cliente: ~0 rows (aproximadamente)
INSERT INTO `cliente` (`id`, `nome`, `razao_social`, `cpf`, `cnpj`, `telefone`, `email`, `rua`, `cidade`, `cep`) VALUES
	(1, 'João da Silva', '', '111', '', '999999', 'joao@gmail', 'Dos Bobos', 'Chapecó', '89803');

-- Copiando estrutura para tabela db_web_luiza_vitoria_banco.estoque
CREATE TABLE IF NOT EXISTS `estoque` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_produto` int NOT NULL,
  `quantidade` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_produto` (`id_produto`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela db_web_luiza_vitoria_banco.estoque: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela db_web_luiza_vitoria_banco.funcionario
CREATE TABLE IF NOT EXISTS `funcionario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `nascimento` date NOT NULL,
  `admissao` date NOT NULL,
  `demissao` date DEFAULT NULL,
  `funcao` varchar(50) NOT NULL DEFAULT '',
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `salario` float NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela db_web_luiza_vitoria_banco.funcionario: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela db_web_luiza_vitoria_banco.movimentacao_estoque
CREATE TABLE IF NOT EXISTS `movimentacao_estoque` (
  `id_movimentacao` int NOT NULL AUTO_INCREMENT,
  `id_produto` int NOT NULL,
  `id_funcionario` int NOT NULL,
  `tipo` enum('Entrada','Saída') NOT NULL,
  `quantidade` int NOT NULL,
  PRIMARY KEY (`id_movimentacao`),
  KEY `id_produto_movimentacao` (`id_produto`),
  KEY `id_funcionario_movimentacao` (`id_funcionario`),
  CONSTRAINT `id_funcionario_movimentacao` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id`),
  CONSTRAINT `id_produto_movimentacao` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela db_web_luiza_vitoria_banco.movimentacao_estoque: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela db_web_luiza_vitoria_banco.produto
CREATE TABLE IF NOT EXISTS `produto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL DEFAULT '',
  `descrição` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `marca` varchar(50) NOT NULL DEFAULT '',
  `preco_custo` decimal(10,2) NOT NULL DEFAULT '0.00',
  `preco_venda` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela db_web_luiza_vitoria_banco.produto: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela db_web_luiza_vitoria_banco.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `login` varchar(50) NOT NULL DEFAULT '',
  `senha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `telefone` varchar(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela db_web_luiza_vitoria_banco.usuario: ~0 rows (aproximadamente)
/*INSERT INTO `usuario` (`id`, `nome`, `email`, `login`, `senha`, `telefone`) VALUES
	(2, 'Vitoria', 'vitoria@gmail.com', 'vitoria', '123', '499999999'),
	(3, 'ana', 'ana@banana', 'ana', '$2y$10$16JGao/N/PJ6hphfhTXFdOgkkiXWAMBzHvgN2aKy18xoIv9teRGqS', '99999'),
	(8, 'Luiza', 'luiza@gmail.com ', 'luiza', '$2y$10$OMXagKYTZO5M/wLdav1UueTZhaQJNR5frg4hj8PedZTG47bVBHoeG', '9999'),
	(9, 'Vitoria', 'vi@gmail', 'vitoria', '$2y$10$RO9GBkigK.NY7RgxQs23VOhwmel8Fh7hxCkYoUin70j3mwQLmTswa', '999');
*/
/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

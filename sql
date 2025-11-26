create database gestorpro;
use gestorpro:
CREATE TABLE IF NOT EXISTS alugueis (
  id int NOT NULL AUTO_INCREMENT,
  id_equipamento int NOT NULL,
  nome_locatario varchar(100) NOT NULL,
  email_locatario varchar(100) DEFAULT NULL,
  data_inicio date NOT NULL,
  data_fim date NOT NULL,
  status_ativo tinyint(1) DEFAULT '1',
  observacoes text,
  PRIMARY KEY (id),
  KEY id_equipamento (id_equipamento)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE IF NOT EXISTS equipamentos (
  id int NOT NULL AUTO_INCREMENT,
  id_empresa int NOT NULL,
  nome_modelo varchar(255) NOT NULL,
  numeracao varchar(100) DEFAULT NULL,
  data_fabricacao date DEFAULT NULL,
  estado varchar(50) DEFAULT NULL,
  setor varchar(100) DEFAULT NULL,
  localizacao varchar(100) DEFAULT NULL,
  preco decimal(10,2) DEFAULT NULL,
  imagem varchar(255) DEFAULT NULL,
  status_aluguel varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Disponivel',
  criado_em timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY id_empresa (id_empresa)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE IF NOT EXISTS usuarios (
  id int NOT NULL AUTO_INCREMENT,
  nome varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  senha varchar(255) NOT NULL,
  criado_em timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY email (email)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

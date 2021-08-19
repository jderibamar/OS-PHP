-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: localhost    Database: ordem_servico
-- ------------------------------------------------------
-- Server version	8.0.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `categoria_id` int NOT NULL AUTO_INCREMENT,
  `categoria_nome` varchar(45) NOT NULL,
  `categoria_ativa` tinyint(1) DEFAULT NULL,
  `categoria_data_alteracao` varchar(14) DEFAULT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Eletrônicos',1,'26/07/2021'),(3,'Esquadrias',1,'28/07/2021'),(5,'Categoria de teste 3',1,'28/07/2021'),(7,'Categoria de teste',0,'25/07/2021'),(8,'Eletrodomésticos',1,'18/08/2021');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `cliente_id` int NOT NULL AUTO_INCREMENT,
  `cliente_data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `cliente_tipo` tinyint(1) DEFAULT NULL,
  `cliente_nome` varchar(45) NOT NULL,
  `cliente_sobrenome` varchar(150) NOT NULL,
  `cliente_data_nascimento` date NOT NULL,
  `cliente_cpf_cnpj` varchar(20) NOT NULL,
  `cliente_rg_ie` varchar(20) DEFAULT NULL,
  `cliente_email` varchar(50) DEFAULT NULL,
  `cliente_telefone` varchar(20) DEFAULT NULL,
  `cliente_celular` varchar(20) DEFAULT NULL,
  `cliente_cep` varchar(10) NOT NULL,
  `cliente_endereco` varchar(155) NOT NULL,
  `cliente_numero_endereco` varchar(20) NOT NULL,
  `cliente_bairro` varchar(45) NOT NULL,
  `cliente_complemento` varchar(145) NOT NULL,
  `cliente_cidade` varchar(105) NOT NULL,
  `cliente_estado` varchar(2) NOT NULL,
  `cliente_ativo` tinyint(1) NOT NULL,
  `cliente_obs` tinytext,
  `cliente_data_alteracao` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cliente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'2021-07-13 03:00:00',1,'José de Ribamar','Duarte','0000-00-00','187.821.220-67','102304050','ribamarinformatica@gmail.com','(61) 3321-2530','(61) 92001-8815','71070-649','QE 46, AE 03','1500','Guará II','BLOCO C','GUARÁ','DF',1,'afdfsdfsdafsadfsafasf','2021-08-16 00:24:08'),(7,'2021-07-18 22:55:06',1,'Exper Vidros','Vidros','2030-11-01','427.701.690-17','1023040','teste@teste.com','(55) 61320-4620','(61) 98633-3744','71070-649','RUA 20 QUADRA 51 LOTE 18','450','Bom Sucesso','BLOCO A','Val Paraíso','GO',1,'','2021-08-02 02:42:12'),(8,'2021-07-24 13:58:36',1,'Tereza','Fulana de Tal','1997-05-01','922.001.250-20','27.463.548-3','maria@test.com','(61) 3356-6540','(61) 98633-3551','71070-649','QE 46, AE 03','5','Guará II','','GUARÁ','DF',1,'','2021-07-24 13:58:36'),(9,'2021-08-01 00:08:51',1,'Cliente','de Teste','2000-07-13','249.253.180-55','11.861.976-7','teste1@teste.com','(55) 61320-4635','','71070-649','RUA 20 QUADRA 51 LOTE 18','150','Guará II','','Val Paraíso','GO',1,'','2021-08-01 00:08:51'),(10,'2021-08-02 11:53:53',1,'Cliente de teste','Testando','2001-01-01','912.274.940-33','28.352.083-8','teste2@teste.com','(55) 61320-2030','','71070-649','QE 44','15','Guará II','BLOCO C','Val Paraíso','DF',1,'','2021-08-02 11:53:53');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contas_pagar`
--

DROP TABLE IF EXISTS `contas_pagar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contas_pagar` (
  `conta_pagar_id` int NOT NULL AUTO_INCREMENT,
  `conta_pagar_fornecedor_id` int DEFAULT NULL,
  `conta_pagar_valor` varchar(15) DEFAULT NULL,
  `conta_pagar_status` tinyint(1) DEFAULT NULL,
  `conta_pagar_data_vencimento` varchar(15) DEFAULT NULL,
  `conta_pagar_data_pagamento` varchar(15) DEFAULT NULL,
  `conta_pagar_data_alteracao` varchar(15) DEFAULT NULL,
  `conta_pagar_obs` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`conta_pagar_id`),
  KEY `fk_conta_pagar_id_fornecedor` (`conta_pagar_fornecedor_id`),
  CONSTRAINT `fk_conta_pagar_id_fornecedor` FOREIGN KEY (`conta_pagar_fornecedor_id`) REFERENCES `fornecedores` (`fornecedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COMMENT='		';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contas_pagar`
--

LOCK TABLES `contas_pagar` WRITE;
/*!40000 ALTER TABLE `contas_pagar` DISABLE KEYS */;
INSERT INTO `contas_pagar` VALUES (5,1,'500,00',0,'01/08/2021','','03/08/2021','Teste de data como string, testando, testando, testando  aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa  '),(8,1,'1.157,90',1,'12/09/2021','','02/08/2021','Boleto 2 ar-condicionado  '),(9,1,'1.157,92',1,'12/10/2021','','02/08/2021','Último boleto ar-condicionado    '),(11,1,'1.023,09',1,'15/09/2021','','02/08/2021','Boleto 2 de 3 do fogão  '),(12,1,'1.023,11',1,'15/10/2021','','02/08/2021','Último boleto do fogão.  ');
/*!40000 ALTER TABLE `contas_pagar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contas_receber`
--

DROP TABLE IF EXISTS `contas_receber`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contas_receber` (
  `conta_receber_id` int NOT NULL AUTO_INCREMENT,
  `conta_receber_cliente_id` int NOT NULL,
  `conta_receber_data_vencimento` varchar(10) DEFAULT NULL,
  `conta_receber_data_pagamento` varchar(10) DEFAULT NULL,
  `conta_receber_valor` varchar(20) DEFAULT NULL,
  `conta_receber_status` tinyint(1) DEFAULT NULL,
  `conta_receber_obs` tinytext,
  `conta_receber_data_alteracao` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`conta_receber_id`),
  KEY `fk_conta_receber_id_cliente` (`conta_receber_cliente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contas_receber`
--

LOCK TABLES `contas_receber` WRITE;
/*!40000 ALTER TABLE `contas_receber` DISABLE KEYS */;
INSERT INTO `contas_receber` VALUES (9,7,'10/08/2021',NULL,'3.350,00',0,'Conta referente ao desenvolvimento do sistema de Ordem de Serviço.','01/08/2021'),(10,1,'16/07/2021','','650,00',0,'Conta de teste!','01/08/2021'),(11,8,'23/07/2021','01/08/2021','650,00',1,'','01/08/2021'),(12,9,'10/08/2021','','250,00',0,'Mais uma conta de teste','02/08/2021'),(13,10,'26/08/2021',NULL,'650,00',0,'Mais uma conta a receber de teste pendente.','02/08/2021');
/*!40000 ALTER TABLE `contas_receber` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formas_pagamentos`
--

DROP TABLE IF EXISTS `formas_pagamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `formas_pagamentos` (
  `forma_pagamento_id` int NOT NULL AUTO_INCREMENT,
  `forma_pagamento_nome` varchar(45) DEFAULT NULL,
  `forma_pagamento_aceita_parc` tinyint(1) DEFAULT NULL,
  `forma_pagamento_ativa` tinyint(1) DEFAULT NULL,
  `forma_pagamento_data_alteracao` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`forma_pagamento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formas_pagamentos`
--

LOCK TABLES `formas_pagamentos` WRITE;
/*!40000 ALTER TABLE `formas_pagamentos` DISABLE KEYS */;
INSERT INTO `formas_pagamentos` VALUES (1,'Cartão de crédito',1,1,'03/08/2021'),(2,'Boleto bancário',1,1,'03/08/2021'),(3,'Dinheiro',0,1,'12/08/2021'),(7,'Para excluir 2',1,1,'03/08/2021'),(8,'PIX',0,1,'04/08/2021');
/*!40000 ALTER TABLE `formas_pagamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fornecedores`
--

DROP TABLE IF EXISTS `fornecedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fornecedores` (
  `fornecedor_id` int NOT NULL AUTO_INCREMENT,
  `fornecedor_data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fornecedor_razao` varchar(200) DEFAULT NULL,
  `fornecedor_nome_fantasia` varchar(145) DEFAULT NULL,
  `fornecedor_cnpj` varchar(20) DEFAULT NULL,
  `fornecedor_ie` varchar(20) DEFAULT NULL,
  `fornecedor_telefone` varchar(20) DEFAULT NULL,
  `fornecedor_celular` varchar(20) DEFAULT NULL,
  `fornecedor_email` varchar(100) DEFAULT NULL,
  `fornecedor_contato` varchar(45) DEFAULT NULL,
  `fornecedor_cep` varchar(10) DEFAULT NULL,
  `fornecedor_endereco` varchar(145) DEFAULT NULL,
  `fornecedor_numero_endereco` varchar(20) DEFAULT NULL,
  `fornecedor_bairro` varchar(45) DEFAULT NULL,
  `fornecedor_complemento` varchar(45) DEFAULT NULL,
  `fornecedor_cidade` varchar(45) DEFAULT NULL,
  `fornecedor_estado` varchar(2) DEFAULT NULL,
  `fornecedor_ativo` tinyint(1) DEFAULT NULL,
  `fornecedor_obs` tinytext,
  `fornecedor_data_alteracao` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`fornecedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fornecedores`
--

LOCK TABLES `fornecedores` WRITE;
/*!40000 ALTER TABLE `fornecedores` DISABLE KEYS */;
INSERT INTO `fornecedores` VALUES (1,'2021-07-18 20:29:58','Electrolux do Brasil S/A','Electrolux do Brasil','76.487.032/0054-37','062000918','(61) 3356-1234','(61) 9863-3123','teste@teste.com','Vendedor X','71965-000','End: Rodovia SP 318 Km 245 s/n','','Por enquanto','Complemento de teste','São Carlos','SP',1,'Fornecedor demora muito para enviar os produtos  com atraso','2021-07-20 13:13:29'),(3,'2021-07-20 14:28:28','Fornecedor de teste 2','Exper Vidros','43.864.201/0001-40','538.738.145.442','(55) 6132-0462','(61) 98633-1020','teste@test.com','','71070-649','RUA 20 QUADRA 51 LOTE 18','15','Bairro do analista e desenvolvedor','Bloco do DEV','Val Paraíso','GO',1,'','2021-07-20 14:28:39'),(4,'2021-07-20 14:43:58','Fornecedor de teste 3','Fantasia de teste 2','78.643.646/0001-84','701.903.330.955','(61) 3356-3040','(61) 9863-1234','teste2@test.com','Fulano de tal','71070-649','Rua da programação','25','Bairro de teste','BLOCO DE TESTE','GUARÁ','PI',0,'','2021-07-31 14:52:41'),(6,'2021-07-20 16:58:18','Novo fornecedor de teste','JDuarte Informática','94.215.449/0001-10','981.753.518.750','(61) 3356-4055','(61) 98633-5561','jduarte@test.com','Contato de teste','71070-649','QE 46, AE 03','401','Bairro do analista e desenvolvedor','BLOCO DE TESTE','GUARÁ','AC',1,'','2021-07-28 02:24:16');
/*!40000 ALTER TABLE `fornecedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groups` (
  `id` mediumint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'admin','Administrator'),(2,'vendedor','Vendedores');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login_attempts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marcas`
--

DROP TABLE IF EXISTS `marcas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marcas` (
  `marca_id` int NOT NULL AUTO_INCREMENT,
  `marca_nome` varchar(45) NOT NULL,
  `marca_ativa` tinyint(1) DEFAULT NULL,
  `marca_data_alteracao` varchar(20) NOT NULL,
  PRIMARY KEY (`marca_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marcas`
--

LOCK TABLES `marcas` WRITE;
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
INSERT INTO `marcas` VALUES (1,'HP',1,'24/07/2021'),(3,'ABCD',1,'26/07/2021'),(4,'AXYZ',1,'25/07/2021'),(5,'Marca de teste',0,'25/07/2021'),(6,'Marca de teste 2',0,'24/07/2021'),(7,'Marca de teste 3',0,'24/07/2021'),(8,'Marca de teste 4',0,'24/07/2021'),(9,'Marca de teste 5',1,'24/07/2021'),(10,'Marca de teste 6',0,'24/07/2021'),(11,'Marca de teste 7',1,'24/07/2021'),(12,'Marca de teste 8',1,'24/07/2021'),(13,'Marca de teste 9',0,'25/07/2021'),(14,'Electrolux',1,'18/08/2021');
/*!40000 ALTER TABLE `marcas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordem_tem_servicos`
--

DROP TABLE IF EXISTS `ordem_tem_servicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ordem_tem_servicos` (
  `ordem_ts_id` int NOT NULL AUTO_INCREMENT,
  `ordem_ts_id_servico` int DEFAULT NULL,
  `ordem_ts_id_ordem_servico` int DEFAULT NULL,
  `ordem_ts_quantidade` int DEFAULT NULL,
  `ordem_ts_valor_unitario` varchar(45) DEFAULT NULL,
  `ordem_ts_valor_desconto` varchar(45) DEFAULT NULL,
  `ordem_ts_valor_total` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ordem_ts_id`),
  KEY `fk_ordem_ts_id_servico` (`ordem_ts_id_servico`),
  KEY `fk_ordem_ts_id_ordem_servico` (`ordem_ts_id_ordem_servico`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='Tabela de relacionamento entre as tabelas servicos e ordem_servico';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordem_tem_servicos`
--

LOCK TABLES `ordem_tem_servicos` WRITE;
/*!40000 ALTER TABLE `ordem_tem_servicos` DISABLE KEYS */;
INSERT INTO `ordem_tem_servicos` VALUES (1,4,1,4,' 400.00','0 ',' 1 600.00'),(2,6,1,1,' 650.00','0 ',' 650.00');
/*!40000 ALTER TABLE `ordem_tem_servicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordens_servicos`
--

DROP TABLE IF EXISTS `ordens_servicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ordens_servicos` (
  `ordem_servico_id` int NOT NULL AUTO_INCREMENT,
  `ordem_servico_forma_pagamento_id` int DEFAULT NULL,
  `ordem_servico_cliente_id` int DEFAULT NULL,
  `ordem_servico_data_emissao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ordem_servico_data_conclusao` varchar(100) DEFAULT NULL,
  `ordem_servico_equipamento` varchar(80) DEFAULT NULL,
  `ordem_servico_marca_equipamento` varchar(80) DEFAULT NULL,
  `ordem_servico_modelo_equipamento` varchar(80) DEFAULT NULL,
  `ordem_servico_acessorios` tinytext,
  `ordem_servico_defeito` tinytext,
  `ordem_servico_valor_desconto` varchar(25) DEFAULT NULL,
  `ordem_servico_valor_total` varchar(25) DEFAULT NULL,
  `ordem_servico_status` tinyint(1) DEFAULT NULL,
  `ordem_servico_obs` tinytext,
  `ordem_servico_data_alteracao` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ordem_servico_id`),
  KEY `fk_ordem_servico_id_cliente` (`ordem_servico_cliente_id`),
  KEY `fk_ordem_servico_id_forma_pagto` (`ordem_servico_forma_pagamento_id`),
  CONSTRAINT `fk_ordem_servico_id_cliente` FOREIGN KEY (`ordem_servico_cliente_id`) REFERENCES `clientes` (`cliente_id`),
  CONSTRAINT `fk_ordem_servico_id_forma_pagto` FOREIGN KEY (`ordem_servico_forma_pagamento_id`) REFERENCES `formas_pagamentos` (`forma_pagamento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordens_servicos`
--

LOCK TABLES `ordens_servicos` WRITE;
/*!40000 ALTER TABLE `ordens_servicos` DISABLE KEYS */;
INSERT INTO `ordens_servicos` VALUES (1,NULL,1,'2021-08-18 16:17:36',NULL,'PC com S.O não inicializando','Dell','SA123B210','Sem acessórios','S.O não inicializa','R$ 0.00','R 2,250.00',0,'',NULL);
/*!40000 ALTER TABLE `ordens_servicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produtos` (
  `produto_id` int NOT NULL AUTO_INCREMENT,
  `produto_codigo` varchar(45) DEFAULT NULL,
  `produto_data_cadastro` varchar(20) DEFAULT NULL,
  `produto_categoria_id` int NOT NULL,
  `produto_marca_id` int NOT NULL,
  `produto_fornecedor_id` int NOT NULL,
  `produto_descricao` varchar(145) DEFAULT NULL,
  `produto_unidade` varchar(25) DEFAULT NULL,
  `produto_codigo_barras` varchar(45) DEFAULT NULL,
  `produto_preco_custo` varchar(45) DEFAULT NULL,
  `produto_preco_venda` varchar(45) DEFAULT NULL,
  `produto_estoque_minimo` varchar(10) DEFAULT NULL,
  `produto_qtde_estoque` varchar(10) DEFAULT NULL,
  `produto_ativo` tinyint(1) DEFAULT NULL,
  `produto_obs` tinytext,
  `produto_data_alteracao` varchar(20) NOT NULL,
  `produto_margem_lucro` float DEFAULT NULL,
  PRIMARY KEY (`produto_id`),
  KEY `produto_categoria_id` (`produto_categoria_id`,`produto_marca_id`,`produto_fornecedor_id`),
  KEY `fk_produto_marca_id` (`produto_marca_id`),
  KEY `fk_produto_forncedor_id` (`produto_fornecedor_id`),
  CONSTRAINT `fk_produto_cat_id` FOREIGN KEY (`produto_categoria_id`) REFERENCES `categorias` (`categoria_id`),
  CONSTRAINT `fk_produto_forncedor_id` FOREIGN KEY (`produto_fornecedor_id`) REFERENCES `fornecedores` (`fornecedor_id`),
  CONSTRAINT `fk_produto_marca_id` FOREIGN KEY (`produto_marca_id`) REFERENCES `marcas` (`marca_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'72495380',NULL,1,1,1,'Notebook gamer - atualizado','UN','4545','1.800,00','3950,75','4','10',1,'Testando mudança no preço para não gravar o ponto de milhar.','18/08/2021',NULL),(2,'50412637',NULL,1,1,1,'Fone de ouvido gamer','UN','9999','11,50','55,00','1','4',1,'','16/08/2021',NULL),(3,'41697502',NULL,1,3,6,'Mouse usb','UN','9999','9,99','15,22','2','14',1,'Produto atualizado, testando...','16/08/2021',NULL),(8,'87092364','28/07/2021',3,3,3,'Porta de vidro temperado','metro',NULL,'150,00','250,00','2','10',1,'Teste teste','28/07/2021',NULL),(9,'02956784','28/07/2021',1,1,1,'Notebook vaio core I7','UN',NULL,'3.550,00','5.500,00','1','1',0,'','28/07/2021',NULL),(11,'80739415','18/08/2021',8,14,1,'Lavadora De Alta Pressão Electrolux Ultra Wash 2200 Psi 110v','UN',NULL,'526,60','789,00','1','3',1,'','',NULL);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicos`
--

DROP TABLE IF EXISTS `servicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servicos` (
  `servico_id` int NOT NULL AUTO_INCREMENT,
  `servico_nome` varchar(145) DEFAULT NULL,
  `servico_preco` varchar(15) DEFAULT NULL,
  `servico_descricao` tinytext,
  `servico_ativo` tinyint(1) DEFAULT NULL,
  `servico_data_alteracao` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`servico_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicos`
--

LOCK TABLES `servicos` WRITE;
/*!40000 ALTER TABLE `servicos` DISABLE KEYS */;
INSERT INTO `servicos` VALUES (2,'Instalação de janelas - teste','1500,00','Serviço de instalação de janelas de todos os tamanhos até 2 x 2m',1,'07/08/2021'),(4,'Serviço de teste atualizado','400,00','Serviço de criação de software ao valor de R$ 400,00 por hora',1,'07/08/2021'),(5,'Troca de fechadura','50,00','Troca de fechadura de porta de vidro 8mm',1,'07/08/2021'),(6,'Formatação de computador','650,00','Formatação de computador sem backup dos dados.',1,'12/08/2021'),(7,'Teste_S','75,00','Mais um serviço de teste',1,'07/08/2021'),(9,'Serviço de teste','150,00','Outro serviço de teste',1,'07/08/2021'),(10,'Máscara de dinheiro','200,00','Testando máscara de dinheiro',1,'25/07/2021'),(11,'Teste de máscara de money','25,00','Teste de atualização..',1,'07/08/2021');
/*!40000 ALTER TABLE `servicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sistema`
--

DROP TABLE IF EXISTS `sistema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sistema` (
  `sistema_id` int NOT NULL AUTO_INCREMENT,
  `sistema_razao_social` varchar(145) DEFAULT NULL,
  `sistema_nome_fantasia` varchar(145) DEFAULT NULL,
  `sistema_cnpj` varchar(25) DEFAULT NULL,
  `sistema_ie` varchar(25) DEFAULT NULL,
  `sistema_telefone_fixo` varchar(25) DEFAULT NULL,
  `sistema_telefone_movel` varchar(25) NOT NULL,
  `sistema_email` varchar(100) DEFAULT NULL,
  `sistema_site_url` varchar(100) DEFAULT NULL,
  `sistema_cep` varchar(25) DEFAULT NULL,
  `sistema_endereco` varchar(145) DEFAULT NULL,
  `sistema_numero` varchar(25) DEFAULT NULL,
  `sistema_cidade` varchar(45) DEFAULT NULL,
  `sistema_estado` varchar(2) DEFAULT NULL,
  `sistema_txt_ordem_servico` tinytext,
  `sistema_data_alteracao` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sistema_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sistema`
--

LOCK TABLES `sistema` WRITE;
/*!40000 ALTER TABLE `sistema` DISABLE KEYS */;
INSERT INTO `sistema` VALUES (1,'Razão Social de Teste','Nome fantasia de teste','37.146.733/0001-49','','(61) 3356-6120','(61) 92001-8815','maria@test.com','             ','71070-649','RUA DE TESTE DA ORDEM DE SERVIÇO','401','GUARÁ','DF','Testando a ORDEM DE SERVIÇO, sua satisfação é nosso compromisso.','2021-08-09 20:12:02');
/*!40000 ALTER TABLE `sistema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int unsigned DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int unsigned NOT NULL,
  `last_login` int unsigned DEFAULT NULL,
  `active` tinyint unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_email` (`email`),
  UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  UNIQUE KEY `uc_remember_selector` (`remember_selector`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'127.0.0.1','admin','$2y$10$2CU2thaD85gYmHAbRf5W8u7q7GdUDjdNvros/DYIMdb.6sXHiZEb2','admin@admin.com',NULL,'',NULL,NULL,NULL,NULL,NULL,1268889823,1629328976,1,'Admin_2','Duarte','ADMIN','0'),(5,'::1','teste','$2y$10$aUTM2WQq4/awXjF7.PrOG.JeKZn.AKqozvzbmrmLfzVyISAp55QR.','teste@teste.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1625959683,1626635082,1,'Testando','Teste',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_groups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `group_id` mediumint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_groups`
--

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` VALUES (10,1,1),(16,5,2);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venda_produtos`
--

DROP TABLE IF EXISTS `venda_produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `venda_produtos` (
  `id_venda_produtos` int NOT NULL AUTO_INCREMENT,
  `venda_produto_id_venda` int DEFAULT NULL,
  `venda_produto_id_produto` int DEFAULT NULL,
  `venda_produto_quantidade` int DEFAULT NULL,
  `venda_produto_valor_unitario` float DEFAULT NULL,
  `venda_produto_desconto` float DEFAULT NULL,
  `venda_produto_valor_total` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_venda_produtos`),
  KEY `fk_venda_produtos_id_produto` (`venda_produto_id_produto`),
  KEY `fk_venda_produtos_id_venda` (`venda_produto_id_venda`),
  CONSTRAINT `fk_venda_produtos_id_produto` FOREIGN KEY (`venda_produto_id_produto`) REFERENCES `produtos` (`produto_id`),
  CONSTRAINT `fk_venda_produtos_id_venda` FOREIGN KEY (`venda_produto_id_venda`) REFERENCES `vendas` (`venda_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venda_produtos`
--

LOCK TABLES `venda_produtos` WRITE;
/*!40000 ALTER TABLE `venda_produtos` DISABLE KEYS */;
INSERT INTO `venda_produtos` VALUES (14,15,1,3,3,0,' 11852.25'),(15,15,2,5,55,0,' 275.00');
/*!40000 ALTER TABLE `venda_produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendas`
--

DROP TABLE IF EXISTS `vendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendas` (
  `venda_id` int NOT NULL AUTO_INCREMENT,
  `venda_cliente_id` int DEFAULT NULL,
  `venda_forma_pagamento_id` int DEFAULT NULL,
  `venda_vendedor_id` int DEFAULT NULL,
  `venda_tipo` tinyint(1) DEFAULT NULL,
  `venda_data_emissao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `venda_valor_desconto` varchar(25) DEFAULT NULL,
  `venda_valor_total` varchar(25) DEFAULT NULL,
  `venda_data_alteracao` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`venda_id`),
  KEY `fk_venda_cliente_id` (`venda_cliente_id`),
  KEY `fk_venda_forma_pagto_id` (`venda_forma_pagamento_id`),
  KEY `fk_venda_vendedor_id` (`venda_vendedor_id`),
  CONSTRAINT `fk_venda_cliente_id` FOREIGN KEY (`venda_cliente_id`) REFERENCES `clientes` (`cliente_id`),
  CONSTRAINT `fk_venda_forma_pagto_id` FOREIGN KEY (`venda_forma_pagamento_id`) REFERENCES `formas_pagamentos` (`forma_pagamento_id`),
  CONSTRAINT `fk_venda_vendedor_id` FOREIGN KEY (`venda_vendedor_id`) REFERENCES `vendedores` (`vendedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendas`
--

LOCK TABLES `vendas` WRITE;
/*!40000 ALTER TABLE `vendas` DISABLE KEYS */;
INSERT INTO `vendas` VALUES (15,1,3,1,1,NULL,'R$ 0.00','R 12,127.25',NULL);
/*!40000 ALTER TABLE `vendas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendedores`
--

DROP TABLE IF EXISTS `vendedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendedores` (
  `vendedor_id` int NOT NULL AUTO_INCREMENT,
  `vendedor_matricula` varchar(10) NOT NULL,
  `vendedor_data_cadastro` varchar(20) DEFAULT NULL,
  `vendedor_nome_completo` varchar(145) NOT NULL,
  `vendedor_cpf` varchar(25) NOT NULL,
  `vendedor_rg` varchar(20) NOT NULL,
  `vendedor_telefone` varchar(15) DEFAULT NULL,
  `vendedor_celular` varchar(15) DEFAULT NULL,
  `vendedor_email` varchar(45) DEFAULT NULL,
  `vendedor_cep` varchar(15) DEFAULT NULL,
  `vendedor_endereco` varchar(45) DEFAULT NULL,
  `vendedor_numero_endereco` varchar(25) DEFAULT NULL,
  `vendedor_complemento` varchar(45) DEFAULT NULL,
  `vendedor_bairro` varchar(45) DEFAULT NULL,
  `vendedor_cidade` varchar(45) DEFAULT NULL,
  `vendedor_estado` varchar(2) DEFAULT NULL,
  `vendedor_ativo` tinyint(1) DEFAULT NULL,
  `vendedor_obs` tinytext,
  `vendedor_data_alteracao` varchar(20) DEFAULT NULL,
  `vendedorescol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`vendedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendedores`
--

LOCK TABLES `vendedores` WRITE;
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
INSERT INTO `vendedores` VALUES (1,'09842571','01/11/2030','Lucio Antonio de Souza','795.977.343-20','3.680.331-93','(61) 3353-2521','(41) 99999-9999','novalt@teste.com','80530-000','Rua das vendas','45','','Centro','Curitiba','PR',1,'fadsfasfasdfafasfsa',NULL,NULL),(2,'03841956','29/01/2020','Sara Betina','582.071.790-23','25.287.429-8','(41) 9563-1456','(41) 88884-4444','sara@gmail.com','80540-120','Rua das vendas','45','','Centro','Joinville','SC',1,'',NULL,NULL),(5,'53762108','22/07/2021','Ellen Duarte','487.782.730-72','3.007.979-77','(61) 3356-6150','(61) 98633-3520','ellenduarte@hotmail.com','','QE 46, AE 03','','BLOCO C','Guará II','GUARÁ','PI',1,'',NULL,NULL);
/*!40000 ALTER TABLE `vendedores` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-08-19  1:18:47

-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.7.15-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema dbroadrunner
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ dbroadrunner;
USE dbroadrunner;

--
-- Table structure for table `dbroadrunner`.`tbl_atleta_destaque`
--

DROP TABLE IF EXISTS `tbl_atleta_destaque`;
CREATE TABLE `tbl_atleta_destaque` (
  `idatleta` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `foto` varchar(45) NOT NULL DEFAULT '',
  `descfoto` varchar(45) NOT NULL DEFAULT '',
  `nome` varchar(45) NOT NULL DEFAULT '',
  `trajetoria` text NOT NULL,
  `visivel` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`idatleta`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dbroadrunner`.`tbl_atleta_destaque`
--

/*!40000 ALTER TABLE `tbl_atleta_destaque` DISABLE KEYS */;
INSERT INTO `tbl_atleta_destaque` (`idatleta`,`foto`,`descfoto`,`nome`,`trajetoria`,`visivel`) VALUES 
 (5,'arquivos/bike5.jpg','meu teste','marcel','teste',0),
 (6,'arquivos/helmet.jpg','meu teste 2','marcel','teste teste',0),
 (7,'arquivos/images.jpg','meu teste 26666','marcel6666','Eu fiz o teste',0),
 (8,'arquivos/background.jpg','meu teste 789','marcel 789','teste 2',1),
 (13,'arquivos/Isabella-Lacerda-capa.jpg','Isabella Lacerda Ciclista','Isabella Lacerda','blablablabalbalabla blablablabalbalabla vblablablabalbalabla blablablabalbalabla blablablabalbalabla',0),
 (14,'arquivos/image3.jpg','asdad','asds','asdas',0),
 (15,'arquivos/roupa2.jpg','asdas','asd','asd',0);
/*!40000 ALTER TABLE `tbl_atleta_destaque` ENABLE KEYS */;


--
-- Table structure for table `dbroadrunner`.`tbl_cat_prod`
--

DROP TABLE IF EXISTS `tbl_cat_prod`;
CREATE TABLE `tbl_cat_prod` (
  `idcategoria` int(10) unsigned NOT NULL,
  `idproduto` int(10) unsigned NOT NULL,
  KEY `FK_tbl_cat_prod_1` (`idcategoria`),
  KEY `FK_tbl_cat_prod_2` (`idproduto`),
  CONSTRAINT `FK_tbl_cat_prod_1` FOREIGN KEY (`idcategoria`) REFERENCES `tbl_categoria` (`idcategoria`),
  CONSTRAINT `FK_tbl_cat_prod_2` FOREIGN KEY (`idproduto`) REFERENCES `tbl_produto` (`idproduto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dbroadrunner`.`tbl_cat_prod`
--

/*!40000 ALTER TABLE `tbl_cat_prod` DISABLE KEYS */;
INSERT INTO `tbl_cat_prod` (`idcategoria`,`idproduto`) VALUES 
 (5,45),
 (4,46),
 (3,47);
/*!40000 ALTER TABLE `tbl_cat_prod` ENABLE KEYS */;


--
-- Table structure for table `dbroadrunner`.`tbl_cat_subcat`
--

DROP TABLE IF EXISTS `tbl_cat_subcat`;
CREATE TABLE `tbl_cat_subcat` (
  `idcategoria` int(10) unsigned NOT NULL DEFAULT '0',
  `idsubcategoria` int(10) unsigned NOT NULL DEFAULT '0',
  KEY `FK_tbl_cat_subcat_1` (`idcategoria`),
  KEY `FK_tbl_cat_subcat_2` (`idsubcategoria`),
  CONSTRAINT `FK_tbl_cat_subcat_1` FOREIGN KEY (`idcategoria`) REFERENCES `tbl_categoria` (`idcategoria`),
  CONSTRAINT `FK_tbl_cat_subcat_2` FOREIGN KEY (`idsubcategoria`) REFERENCES `tbl_subcategoria` (`idsubcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dbroadrunner`.`tbl_cat_subcat`
--

/*!40000 ALTER TABLE `tbl_cat_subcat` DISABLE KEYS */;
INSERT INTO `tbl_cat_subcat` (`idcategoria`,`idsubcategoria`) VALUES 
 (1,11),
 (4,12),
 (1,13),
 (1,14),
 (1,15),
 (1,16),
 (5,17),
 (5,18);
/*!40000 ALTER TABLE `tbl_cat_subcat` ENABLE KEYS */;


--
-- Table structure for table `dbroadrunner`.`tbl_categoria`
--

DROP TABLE IF EXISTS `tbl_categoria`;
CREATE TABLE `tbl_categoria` (
  `idcategoria` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dbroadrunner`.`tbl_categoria`
--

/*!40000 ALTER TABLE `tbl_categoria` DISABLE KEYS */;
INSERT INTO `tbl_categoria` (`idcategoria`,`descricao`) VALUES 
 (1,'Bicicletas de manobra'),
 (3,'Capacete'),
 (4,'Bicicletas'),
 (5,'Roupa');
/*!40000 ALTER TABLE `tbl_categoria` ENABLE KEYS */;


--
-- Table structure for table `dbroadrunner`.`tbl_loja`
--

DROP TABLE IF EXISTS `tbl_loja`;
CREATE TABLE `tbl_loja` (
  `idloja` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `endereco` varchar(45) NOT NULL DEFAULT '',
  `telefone` varchar(45) NOT NULL DEFAULT '',
  `idnl` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idloja`),
  KEY `FK_tbl_loja_1` (`idnl`),
  CONSTRAINT `FK_tbl_loja_1` FOREIGN KEY (`idnl`) REFERENCES `tbl_nossas_lojas` (`idnl`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dbroadrunner`.`tbl_loja`
--

/*!40000 ALTER TABLE `tbl_loja` DISABLE KEYS */;
INSERT INTO `tbl_loja` (`idloja`,`endereco`,`telefone`,`idnl`) VALUES 
 (9,'Rua do inferno, 666','123456',4),
 (10,'balbal','asdfasdf',5),
 (11,'Rua 2','123',4),
 (12,'sadfasdf','sdf',4),
 (13,'Rua do inferno, 666','123456',4);
/*!40000 ALTER TABLE `tbl_loja` ENABLE KEYS */;


--
-- Table structure for table `dbroadrunner`.`tbl_nossas_lojas`
--

DROP TABLE IF EXISTS `tbl_nossas_lojas`;
CREATE TABLE `tbl_nossas_lojas` (
  `idnl` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `imagem` varchar(45) NOT NULL DEFAULT '',
  `titulo` varchar(45) NOT NULL DEFAULT '',
  `visivel` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`idnl`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dbroadrunner`.`tbl_nossas_lojas`
--

/*!40000 ALTER TABLE `tbl_nossas_lojas` DISABLE KEYS */;
INSERT INTO `tbl_nossas_lojas` (`idnl`,`imagem`,`titulo`,`visivel`) VALUES 
 (4,'arquivos/helmet2.jpg','Essa loja 34',0),
 (5,'arquivos/background3.jpg','Essa loja 2hm',1);
/*!40000 ALTER TABLE `tbl_nossas_lojas` ENABLE KEYS */;


--
-- Table structure for table `dbroadrunner`.`tbl_noticia`
--

DROP TABLE IF EXISTS `tbl_noticia`;
CREATE TABLE `tbl_noticia` (
  `idnoticia` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `imagem` varchar(45) NOT NULL DEFAULT '',
  `ttlnoticia` varchar(45) NOT NULL DEFAULT '',
  `txtnoticia` text NOT NULL,
  PRIMARY KEY (`idnoticia`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dbroadrunner`.`tbl_noticia`
--

/*!40000 ALTER TABLE `tbl_noticia` DISABLE KEYS */;
INSERT INTO `tbl_noticia` (`idnoticia`,`imagem`,`ttlnoticia`,`txtnoticia`) VALUES 
 (2,'arquivos/noticia2.jpg','ota noticia','maskldjalksdlakdjlk asjldkjadklasj dlkasdalksd lasj dlaksjd lkasjd lkas jdlkajslk jasldas'),
 (4,'arquivos/images.jpg','Meu teste 123','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna. teste\r\nNunc viverra imperdiet enim. Fusce est. Vivamus a tellus.\r\n						');
/*!40000 ALTER TABLE `tbl_noticia` ENABLE KEYS */;


--
-- Table structure for table `dbroadrunner`.`tbl_produto`
--

DROP TABLE IF EXISTS `tbl_produto`;
CREATE TABLE `tbl_produto` (
  `idproduto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `imagem` varchar(45) NOT NULL DEFAULT '',
  `nome` varchar(45) NOT NULL DEFAULT '',
  `descricao` varchar(45) NOT NULL DEFAULT '',
  `preco` double NOT NULL DEFAULT '0',
  `promocao` double NOT NULL DEFAULT '0',
  `visitas` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idproduto`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dbroadrunner`.`tbl_produto`
--

/*!40000 ALTER TABLE `tbl_produto` DISABLE KEYS */;
INSERT INTO `tbl_produto` (`idproduto`,`imagem`,`nome`,`descricao`,`preco`,`promocao`,`visitas`) VALUES 
 (45,'arquivos/roupa2.jpg','Calça feminina','Calça feminina',100,0,17),
 (46,'arquivos/bike4.jpg','Caloi 205','Bicicleta rapidona',2000,10,25),
 (47,'arquivos/helmet.jpg','Capacete Fox Flux','Capacete do fluxo',120,12,13);
/*!40000 ALTER TABLE `tbl_produto` ENABLE KEYS */;


--
-- Table structure for table `dbroadrunner`.`tbl_subcat_prod`
--

DROP TABLE IF EXISTS `tbl_subcat_prod`;
CREATE TABLE `tbl_subcat_prod` (
  `idsubcategoria` int(10) unsigned NOT NULL,
  `idproduto` int(10) unsigned NOT NULL,
  KEY `FK_tbl_sucat_prod_1` (`idsubcategoria`),
  KEY `FK_tbl_sucat_prod_2` (`idproduto`),
  CONSTRAINT `FK_tbl_sucat_prod_1` FOREIGN KEY (`idsubcategoria`) REFERENCES `tbl_subcategoria` (`idsubcategoria`),
  CONSTRAINT `FK_tbl_sucat_prod_2` FOREIGN KEY (`idproduto`) REFERENCES `tbl_produto` (`idproduto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dbroadrunner`.`tbl_subcat_prod`
--

/*!40000 ALTER TABLE `tbl_subcat_prod` DISABLE KEYS */;
INSERT INTO `tbl_subcat_prod` (`idsubcategoria`,`idproduto`) VALUES 
 (17,45),
 (12,46);
/*!40000 ALTER TABLE `tbl_subcat_prod` ENABLE KEYS */;


--
-- Table structure for table `dbroadrunner`.`tbl_subcategoria`
--

DROP TABLE IF EXISTS `tbl_subcategoria`;
CREATE TABLE `tbl_subcategoria` (
  `idsubcategoria` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`idsubcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dbroadrunner`.`tbl_subcategoria`
--

/*!40000 ALTER TABLE `tbl_subcategoria` DISABLE KEYS */;
INSERT INTO `tbl_subcategoria` (`idsubcategoria`,`descricao`) VALUES 
 (11,'bike anos oitenta'),
 (12,'caloi 10'),
 (13,'Bike anos 60'),
 (14,'Bike anos 90'),
 (15,'Bike anos 70'),
 (16,'Bike anos 40'),
 (17,'Calça'),
 (18,'Luva');
/*!40000 ALTER TABLE `tbl_subcategoria` ENABLE KEYS */;


--
-- Table structure for table `dbroadrunner`.`tblcontato`
--

DROP TABLE IF EXISTS `tblcontato`;
CREATE TABLE `tblcontato` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `celular` varchar(16) NOT NULL,
  `email` varchar(100) NOT NULL,
  `homepage` varchar(100) DEFAULT NULL,
  `facepage` varchar(100) DEFAULT NULL,
  `sugestao` varchar(200) DEFAULT NULL,
  `infoprod` varchar(200) DEFAULT NULL,
  `sexo` varchar(1) NOT NULL,
  `profissao` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dbroadrunner`.`tblcontato`
--

/*!40000 ALTER TABLE `tblcontato` DISABLE KEYS */;
INSERT INTO `tblcontato` (`id`,`nome`,`telefone`,`celular`,`email`,`homepage`,`facepage`,`sugestao`,`infoprod`,`sexo`,`profissao`) VALUES 
 (3,'asda','132','132','Joao@knowsnothing.com','asd','asdasdasd','kndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnf','kndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnf','M','aasd'),
 (4,'asdasd ','4654654','465465163','asdfa!@afsadf','asdasd','asdasd','kndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnf','kndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnf','F','asdasd'),
 (5,'adasd','132456','135465','Asd@awd','asasd','asdasdasd','kndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnf','kndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnfkndkfn lskdnf','M','asdasd');
/*!40000 ALTER TABLE `tblcontato` ENABLE KEYS */;


--
-- Table structure for table `dbroadrunner`.`tblnivel_usuario`
--

DROP TABLE IF EXISTS `tblnivel_usuario`;
CREATE TABLE `tblnivel_usuario` (
  `idnivel` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descricao` varchar(24) NOT NULL,
  PRIMARY KEY (`idnivel`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dbroadrunner`.`tblnivel_usuario`
--

/*!40000 ALTER TABLE `tblnivel_usuario` DISABLE KEYS */;
INSERT INTO `tblnivel_usuario` (`idnivel`,`descricao`) VALUES 
 (1,'Administrador de sistema'),
 (2,'Operador básico'),
 (3,'Cataloguista');
/*!40000 ALTER TABLE `tblnivel_usuario` ENABLE KEYS */;


--
-- Table structure for table `dbroadrunner`.`tblsobre_loja`
--

DROP TABLE IF EXISTS `tblsobre_loja`;
CREATE TABLE `tblsobre_loja` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `imagem` varchar(45) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `texto` text NOT NULL,
  `visivel` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dbroadrunner`.`tblsobre_loja`
--

/*!40000 ALTER TABLE `tblsobre_loja` DISABLE KEYS */;
INSERT INTO `tblsobre_loja` (`id`,`imagem`,`titulo`,`texto`,`visivel`) VALUES 
 (3,'arquivos/background4.jpg','Minha loja 02456789asda','meu ad asd af asdf',0),
 (4,'arquivos/background.jpg','asdasd asd asd123','asdasdasd',1);
/*!40000 ALTER TABLE `tblsobre_loja` ENABLE KEYS */;


--
-- Table structure for table `dbroadrunner`.`tblusuario`
--

DROP TABLE IF EXISTS `tblusuario`;
CREATE TABLE `tblusuario` (
  `idusuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(45) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `idnivel` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idusuario`),
  KEY `FK_tblusuario_1` (`idnivel`),
  CONSTRAINT `FK_tblusuario_1` FOREIGN KEY (`idnivel`) REFERENCES `tblnivel_usuario` (`idnivel`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dbroadrunner`.`tblusuario`
--

/*!40000 ALTER TABLE `tblusuario` DISABLE KEYS */;
INSERT INTO `tblusuario` (`idusuario`,`nome`,`sobrenome`,`usuario`,`senha`,`idnivel`) VALUES 
 (1,'Josiscleysson','quejo','cley','123',3),
 (2,'Joseilson','Neves','jose','123456',2),
 (4,'admin','supreme','admin','123',1);
/*!40000 ALTER TABLE `tblusuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

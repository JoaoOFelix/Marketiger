
--
-- Banco de dados: `marketiger`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro`
--

DROP TABLE IF EXISTS `cadastro`;
CREATE TABLE IF NOT EXISTS `cadastro` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(18) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `linkFoto` mediumtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`usuario`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `secao` varchar(20) NOT NULL,
  `comentario` tinytext NOT NULL,
  `id_item` int(100) NOT NULL,
  `id_comentador` int(100) NOT NULL,
  `comentador` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ID_COMENTADOR` (`id_comentador`),
  KEY `FK_ID_PERFIL` (`id_item`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Estrutura da tabela `favoritar`
--

DROP TABLE IF EXISTS `favoritar`;
CREATE TABLE IF NOT EXISTS `favoritar` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `id_produto` int(100) NOT NULL,
  `id_usuario` int(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_usuario` (`id_usuario`),
  KEY `fk_id_produto` (`id_produto`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(255) NOT NULL,
  `anunciante` varchar(100)NOT NULL,
  `confiabilidade` int(5) NOT NULL,
  `produto` varchar(80) NOT NULL,
  `descricao` text,
  `categoria` varchar(100) DEFAULT NULL,
  `material` varchar(80)DEFAULT NULL,
  `tamanho` varchar(20)DEFAULT NULL,
  `condicao` varchar(7) DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `link-img` longtext,
  PRIMARY KEY (`id`),
  KEY `fk_id_usuario` (`id_usuario`) USING BTREE,
  KEY `fk_anunciante` (`anunciante`) USING BTREE
) ENGINE=InnoDB;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `FK_ID_COMENTADOR` FOREIGN KEY (`id_comentador`) REFERENCES `cadastro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ID_PERFIL` FOREIGN KEY (`id_item`) REFERENCES `cadastro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `favoritar`
--
ALTER TABLE `favoritar`
  ADD CONSTRAINT `fk_id_produto` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `cadastro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_anunciante` FOREIGN KEY (`anunciante`) REFERENCES `cadastro` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `cadastro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Host: mysql02.8a80.com.br
-- Generation Time: 15-Set-2016 às 18:13
-- Versão do servidor: 5.6.30-76.3-log
-- PHP Version: 5.6.24-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `w8a80121`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acabamento`
--

CREATE TABLE `acabamento` (
  `id` int(10) NOT NULL,
  `nome` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valor` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `adendo`
--

CREATE TABLE `adendo` (
  `id_adendo` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `local_retirada` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `data_adendo` datetime NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `local_venda` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `local` varchar(15) NOT NULL,
  `nome_1` varchar(20) DEFAULT NULL,
  `nome_2` varchar(20) DEFAULT NULL,
  `evento` varchar(20) DEFAULT NULL,
  `data_evento` date DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `observacao` text,
  `atendimento` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartao_acabamento`
--

CREATE TABLE `cartao_acabamento` (
  `id` int(11) NOT NULL,
  `id_convite` int(11) NOT NULL,
  `id_acabamento` int(11) NOT NULL,
  `detalhe` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartao_fonte`
--

CREATE TABLE `cartao_fonte` (
  `id` int(11) NOT NULL,
  `id_convite` int(11) NOT NULL,
  `id_fonte` int(11) NOT NULL,
  `detalhe` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartao_impressao`
--

CREATE TABLE `cartao_impressao` (
  `id` int(11) NOT NULL,
  `id_convite` int(11) NOT NULL,
  `id_impressao` int(11) NOT NULL,
  `descricao` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartao_papel`
--

CREATE TABLE `cartao_papel` (
  `id` int(11) NOT NULL,
  `id_convite` int(11) NOT NULL,
  `id_papel` int(11) NOT NULL,
  `empastamento` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartao_servico`
--

CREATE TABLE `cartao_servico` (
  `id` int(11) NOT NULL,
  `id_convite` int(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `detalhe` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `catalogo`
--

CREATE TABLE `catalogo` (
  `id_catalogo` int(11) NOT NULL,
  `pagina` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `id_convite` int(11) NOT NULL,
  `item` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria_papel`
--

CREATE TABLE `categoria_papel` (
  `id` int(10) NOT NULL,
  `nome` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `data_evento` date NOT NULL,
  `evento_tipo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `rua` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero` int(7) DEFAULT NULL,
  `complemento` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bairro` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cidade` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cep` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacao` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `convite`
--

CREATE TABLE `convite` (
  `id` int(11) NOT NULL,
  `id_modelo` int(11) NOT NULL,
  `descricao_cartao` text COLLATE utf8_unicode_ci NOT NULL,
  `descricao_envelope` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `convite_modelo`
--

CREATE TABLE `convite_modelo` (
  `id` int(10) NOT NULL,
  `nome` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `altura` decimal(10,2) DEFAULT NULL,
  `largura` decimal(10,2) DEFAULT NULL,
  `formato_cartao_altura` int(3) DEFAULT NULL,
  `formato_cartao_largura` int(3) DEFAULT NULL,
  `formato_envelope_altura` int(3) DEFAULT NULL,
  `formato_envelope_largura` int(3) DEFAULT NULL,
  `folha_unica` tinyint(1) DEFAULT NULL,
  `formato_cartao` int(3) NOT NULL,
  `formato_envelope` int(3) NOT NULL,
  `cod` int(3) DEFAULT NULL,
  `colagem_pva` int(2) NOT NULL,
  `dupla_face` int(2) NOT NULL,
  `dobra` int(2) NOT NULL,
  `markup` decimal(10,2) NOT NULL,
  `observacao` varchar(255) NOT NULL,
  `empastamento_borda` int(11) NOT NULL,
  `empastamento_borda_envelope` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `envelope_acabamento`
--

CREATE TABLE `envelope_acabamento` (
  `id` int(11) NOT NULL,
  `id_convite` int(11) NOT NULL,
  `id_acabamento` int(11) NOT NULL,
  `detalhe` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `envelope_fita`
--

CREATE TABLE `envelope_fita` (
  `id` int(11) NOT NULL,
  `id_convite` int(11) NOT NULL,
  `id_fita_categoria` int(11) NOT NULL,
  `largura` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `id_fita` varchar(11) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `envelope_fonte`
--

CREATE TABLE `envelope_fonte` (
  `id` int(11) NOT NULL,
  `id_convite` int(11) NOT NULL,
  `id_fonte` int(11) NOT NULL,
  `detalhe` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `envelope_impressao`
--

CREATE TABLE `envelope_impressao` (
  `id` int(11) NOT NULL,
  `id_convite` int(11) NOT NULL,
  `id_impressao` int(11) NOT NULL,
  `detalhe` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `envelope_papel`
--

CREATE TABLE `envelope_papel` (
  `id` int(11) NOT NULL,
  `id_convite` int(11) NOT NULL,
  `id_papel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `envelope_servico`
--

CREATE TABLE `envelope_servico` (
  `id` int(11) NOT NULL,
  `id_convite` int(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `detalhe` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento`
--

CREATE TABLE `evento` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fita`
--

CREATE TABLE `fita` (
  `id` int(10) NOT NULL,
  `cor` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `fabricante` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `imagem` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fita_categoria`
--

CREATE TABLE `fita_categoria` (
  `id` int(10) NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fonte`
--

CREATE TABLE `fonte` (
  `id` int(10) NOT NULL,
  `nome` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id` int(10) NOT NULL,
  `nome` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `sobrenome` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cargo` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `senha` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ativo` tinyint(1) NOT NULL,
  `nivel` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `impressao`
--

CREATE TABLE `impressao` (
  `id` int(10) NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `impressao_cor`
--

CREATE TABLE `impressao_cor` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `detalhe` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_convite`
--

CREATE TABLE `itens_convite` (
  `id_item` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `data_entrega` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `id_convite` int(11) NOT NULL,
  `desconto_porcentagem` int(3) NOT NULL,
  `id_orcamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_convite_adendo`
--

CREATE TABLE `itens_convite_adendo` (
  `id_item` int(11) NOT NULL,
  `id_adendo` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `id_convite` int(11) NOT NULL,
  `desconto_porcentagem` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_convite_orcamento`
--

CREATE TABLE `itens_convite_orcamento` (
  `id_item` int(11) NOT NULL,
  `id_orcamento` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `id_convite` int(11) NOT NULL,
  `desconto_porcentagem` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_produto`
--

CREATE TABLE `itens_produto` (
  `id_item_produto` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `lancamento`
--

CREATE TABLE `lancamento` (
  `id` int(11) NOT NULL,
  `id_financeiro_cliente` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `data` date NOT NULL,
  `descricao` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mao_de_obra`
--

CREATE TABLE `mao_de_obra` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `valor` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento`
--

CREATE TABLE `orcamento` (
  `id_orcamento` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `data_orcamento` datetime NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `local_venda` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `papel`
--

CREATE TABLE `papel` (
  `id` int(10) NOT NULL,
  `categoria_papel_id` int(10) NOT NULL,
  `nome` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gramatura` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `local_retirada` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `data_pedido` datetime NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pedido_tipo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `local_venda` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `id_pessoa` int(11) NOT NULL,
  `nome` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `sobrenome` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` int(10) NOT NULL,
  `celular` int(11) NOT NULL,
  `cpf` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `rg` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `descricao` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `produto_categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_categoria`
--

CREATE TABLE `produto_categoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE `servico` (
  `id` int(10) NOT NULL,
  `nome` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `envelope` tinyint(1) NOT NULL,
  `cartao` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acabamento`
--
ALTER TABLE `acabamento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adendo`
--
ALTER TABLE `adendo`
  ADD PRIMARY KEY (`id_adendo`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_funcionario` (`id_funcionario`);

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cartao_acabamento`
--
ALTER TABLE `cartao_acabamento`
  ADD PRIMARY KEY (`id`,`id_convite`,`id_acabamento`),
  ADD KEY `id_convite` (`id_convite`),
  ADD KEY `id_acabamento` (`id_acabamento`);

--
-- Indexes for table `cartao_fonte`
--
ALTER TABLE `cartao_fonte`
  ADD PRIMARY KEY (`id`,`id_convite`,`id_fonte`),
  ADD KEY `id_convite` (`id_convite`),
  ADD KEY `id_fonte` (`id_fonte`);

--
-- Indexes for table `cartao_impressao`
--
ALTER TABLE `cartao_impressao`
  ADD PRIMARY KEY (`id`,`id_convite`,`id_impressao`),
  ADD KEY `id_convite` (`id_convite`),
  ADD KEY `id_impressao` (`id_impressao`);

--
-- Indexes for table `cartao_papel`
--
ALTER TABLE `cartao_papel`
  ADD PRIMARY KEY (`id`,`id_convite`,`id_papel`),
  ADD KEY `id_convite` (`id_convite`),
  ADD KEY `id_papel` (`id_papel`);

--
-- Indexes for table `cartao_servico`
--
ALTER TABLE `cartao_servico`
  ADD PRIMARY KEY (`id`,`id_convite`,`id_servico`),
  ADD KEY `id_convite` (`id_convite`),
  ADD KEY `id_servico` (`id_servico`);

--
-- Indexes for table `catalogo`
--
ALTER TABLE `catalogo`
  ADD PRIMARY KEY (`id_catalogo`,`id_convite`),
  ADD KEY `id_convite` (`id_convite`);

--
-- Indexes for table `categoria_papel`
--
ALTER TABLE `categoria_papel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `convite`
--
ALTER TABLE `convite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `convite_FKIndex1` (`id_modelo`);

--
-- Indexes for table `convite_modelo`
--
ALTER TABLE `convite_modelo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `envelope_acabamento`
--
ALTER TABLE `envelope_acabamento`
  ADD PRIMARY KEY (`id`,`id_convite`,`id_acabamento`),
  ADD KEY `id_convite` (`id_convite`),
  ADD KEY `id_acabamento` (`id_acabamento`);

--
-- Indexes for table `envelope_fita`
--
ALTER TABLE `envelope_fita`
  ADD PRIMARY KEY (`id`,`id_convite`,`id_fita_categoria`),
  ADD KEY `id_convite` (`id_convite`),
  ADD KEY `id_fita_categoria` (`id_fita_categoria`);

--
-- Indexes for table `envelope_fonte`
--
ALTER TABLE `envelope_fonte`
  ADD PRIMARY KEY (`id`,`id_convite`,`id_fonte`),
  ADD KEY `id_convite` (`id_convite`),
  ADD KEY `id_fonte` (`id_fonte`);

--
-- Indexes for table `envelope_impressao`
--
ALTER TABLE `envelope_impressao`
  ADD PRIMARY KEY (`id`,`id_convite`,`id_impressao`),
  ADD KEY `id_convite` (`id_convite`),
  ADD KEY `id_impressao` (`id_impressao`);

--
-- Indexes for table `envelope_papel`
--
ALTER TABLE `envelope_papel`
  ADD PRIMARY KEY (`id`,`id_convite`,`id_papel`),
  ADD KEY `envelope_FKIndex5` (`id_papel`),
  ADD KEY `id_convite` (`id_convite`);

--
-- Indexes for table `envelope_servico`
--
ALTER TABLE `envelope_servico`
  ADD PRIMARY KEY (`id`,`id_convite`,`id_servico`),
  ADD KEY `id_convite` (`id_convite`),
  ADD KEY `id_servico` (`id_servico`);

--
-- Indexes for table `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fita`
--
ALTER TABLE `fita`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD UNIQUE KEY `codigo_2` (`codigo`);

--
-- Indexes for table `fita_categoria`
--
ALTER TABLE `fita_categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fonte`
--
ALTER TABLE `fonte`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `impressao`
--
ALTER TABLE `impressao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `impressao_cor`
--
ALTER TABLE `impressao_cor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itens_convite`
--
ALTER TABLE `itens_convite`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `fk_id_convite` (`id_convite`),
  ADD KEY `fk_id_pedido` (`id_pedido`);

--
-- Indexes for table `itens_convite_adendo`
--
ALTER TABLE `itens_convite_adendo`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `fk_id_convite` (`id_convite`),
  ADD KEY `fk_id_adendo` (`id_adendo`),
  ADD KEY `fk_id_pedido` (`id_pedido`);

--
-- Indexes for table `itens_convite_orcamento`
--
ALTER TABLE `itens_convite_orcamento`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `fk_id_convite` (`id_convite`),
  ADD KEY `fk_id_orcamento` (`id_orcamento`);

--
-- Indexes for table `itens_produto`
--
ALTER TABLE `itens_produto`
  ADD PRIMARY KEY (`id_item_produto`),
  ADD KEY `fk_id_pedido` (`id_pedido`),
  ADD KEY `fk_id_produto` (`id_produto`);

--
-- Indexes for table `lancamento`
--
ALTER TABLE `lancamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lancamento_FKIndex1` (`id_pedido`),
  ADD KEY `lancamento_FKIndex3` (`id_financeiro_cliente`);

--
-- Indexes for table `mao_de_obra`
--
ALTER TABLE `mao_de_obra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orcamento`
--
ALTER TABLE `orcamento`
  ADD PRIMARY KEY (`id_orcamento`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_funcionario` (`id_funcionario`);

--
-- Indexes for table `papel`
--
ALTER TABLE `papel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `papel_FKIndex1` (`categoria_papel_id`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `pedido_FKIndex3` (`id_cliente`),
  ADD KEY `pedido_FKIndex4` (`id_funcionario`);

--
-- Indexes for table `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`id_pessoa`,`id_cliente`,`email`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produto_categoria_id` (`produto_categoria_id`);

--
-- Indexes for table `produto_categoria`
--
ALTER TABLE `produto_categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acabamento`
--
ALTER TABLE `acabamento`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `adendo`
--
ALTER TABLE `adendo`
  MODIFY `id_adendo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;
--
-- AUTO_INCREMENT for table `cartao_acabamento`
--
ALTER TABLE `cartao_acabamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=324;
--
-- AUTO_INCREMENT for table `cartao_fonte`
--
ALTER TABLE `cartao_fonte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cartao_impressao`
--
ALTER TABLE `cartao_impressao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2075;
--
-- AUTO_INCREMENT for table `cartao_papel`
--
ALTER TABLE `cartao_papel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1585;
--
-- AUTO_INCREMENT for table `cartao_servico`
--
ALTER TABLE `cartao_servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;
--
-- AUTO_INCREMENT for table `catalogo`
--
ALTER TABLE `catalogo`
  MODIFY `id_catalogo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;
--
-- AUTO_INCREMENT for table `categoria_papel`
--
ALTER TABLE `categoria_papel`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=521;
--
-- AUTO_INCREMENT for table `convite`
--
ALTER TABLE `convite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2012;
--
-- AUTO_INCREMENT for table `convite_modelo`
--
ALTER TABLE `convite_modelo`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `envelope_acabamento`
--
ALTER TABLE `envelope_acabamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1143;
--
-- AUTO_INCREMENT for table `envelope_fita`
--
ALTER TABLE `envelope_fita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=889;
--
-- AUTO_INCREMENT for table `envelope_fonte`
--
ALTER TABLE `envelope_fonte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `envelope_impressao`
--
ALTER TABLE `envelope_impressao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1500;
--
-- AUTO_INCREMENT for table `envelope_papel`
--
ALTER TABLE `envelope_papel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1964;
--
-- AUTO_INCREMENT for table `envelope_servico`
--
ALTER TABLE `envelope_servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;
--
-- AUTO_INCREMENT for table `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `fita`
--
ALTER TABLE `fita`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `fita_categoria`
--
ALTER TABLE `fita_categoria`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `fonte`
--
ALTER TABLE `fonte`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `impressao`
--
ALTER TABLE `impressao`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `impressao_cor`
--
ALTER TABLE `impressao_cor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `itens_convite`
--
ALTER TABLE `itens_convite`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=459;
--
-- AUTO_INCREMENT for table `itens_convite_adendo`
--
ALTER TABLE `itens_convite_adendo`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `itens_convite_orcamento`
--
ALTER TABLE `itens_convite_orcamento`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=912;
--
-- AUTO_INCREMENT for table `itens_produto`
--
ALTER TABLE `itens_produto`
  MODIFY `id_item_produto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lancamento`
--
ALTER TABLE `lancamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mao_de_obra`
--
ALTER TABLE `mao_de_obra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orcamento`
--
ALTER TABLE `orcamento`
  MODIFY `id_orcamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=283;
--
-- AUTO_INCREMENT for table `papel`
--
ALTER TABLE `papel`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=507;
--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;
--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id_pessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=997;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;
--
-- AUTO_INCREMENT for table `produto_categoria`
--
ALTER TABLE `produto_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `servico`
--
ALTER TABLE `servico`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `adendo`
--
ALTER TABLE `adendo`
  ADD CONSTRAINT `adendo_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`),
  ADD CONSTRAINT `adendo_ibfk_2` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id`),
  ADD CONSTRAINT `adendo_ibfk_3` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Limitadores para a tabela `cartao_acabamento`
--
ALTER TABLE `cartao_acabamento`
  ADD CONSTRAINT `cartao_acabamento_ibfk_1` FOREIGN KEY (`id_convite`) REFERENCES `convite` (`id`),
  ADD CONSTRAINT `cartao_acabamento_ibfk_2` FOREIGN KEY (`id_acabamento`) REFERENCES `acabamento` (`id`);

--
-- Limitadores para a tabela `cartao_fonte`
--
ALTER TABLE `cartao_fonte`
  ADD CONSTRAINT `cartao_fonte_ibfk_1` FOREIGN KEY (`id_convite`) REFERENCES `convite` (`id`),
  ADD CONSTRAINT `cartao_fonte_ibfk_2` FOREIGN KEY (`id_fonte`) REFERENCES `fonte` (`id`);

--
-- Limitadores para a tabela `cartao_impressao`
--
ALTER TABLE `cartao_impressao`
  ADD CONSTRAINT `cartao_impressao_ibfk_1` FOREIGN KEY (`id_convite`) REFERENCES `convite` (`id`),
  ADD CONSTRAINT `cartao_impressao_ibfk_2` FOREIGN KEY (`id_impressao`) REFERENCES `impressao` (`id`);

--
-- Limitadores para a tabela `cartao_papel`
--
ALTER TABLE `cartao_papel`
  ADD CONSTRAINT `cartao_papel_ibfk_1` FOREIGN KEY (`id_convite`) REFERENCES `convite` (`id`),
  ADD CONSTRAINT `cartao_papel_ibfk_2` FOREIGN KEY (`id_papel`) REFERENCES `papel` (`id`);

--
-- Limitadores para a tabela `cartao_servico`
--
ALTER TABLE `cartao_servico`
  ADD CONSTRAINT `cartao_servico_ibfk_1` FOREIGN KEY (`id_convite`) REFERENCES `convite` (`id`),
  ADD CONSTRAINT `cartao_servico_ibfk_2` FOREIGN KEY (`id_servico`) REFERENCES `servico` (`id`);

--
-- Limitadores para a tabela `catalogo`
--
ALTER TABLE `catalogo`
  ADD CONSTRAINT `catalogo_ibfk_1` FOREIGN KEY (`id_convite`) REFERENCES `convite` (`id`);

--
-- Limitadores para a tabela `envelope_acabamento`
--
ALTER TABLE `envelope_acabamento`
  ADD CONSTRAINT `envelope_acabamento_ibfk_1` FOREIGN KEY (`id_convite`) REFERENCES `convite` (`id`),
  ADD CONSTRAINT `envelope_acabamento_ibfk_2` FOREIGN KEY (`id_acabamento`) REFERENCES `acabamento` (`id`);

--
-- Limitadores para a tabela `envelope_fita`
--
ALTER TABLE `envelope_fita`
  ADD CONSTRAINT `envelope_fita_ibfk_1` FOREIGN KEY (`id_convite`) REFERENCES `convite` (`id`),
  ADD CONSTRAINT `envelope_fita_ibfk_2` FOREIGN KEY (`id_fita_categoria`) REFERENCES `fita_categoria` (`id`);

--
-- Limitadores para a tabela `envelope_fonte`
--
ALTER TABLE `envelope_fonte`
  ADD CONSTRAINT `envelope_fonte_ibfk_1` FOREIGN KEY (`id_convite`) REFERENCES `convite` (`id`),
  ADD CONSTRAINT `envelope_fonte_ibfk_2` FOREIGN KEY (`id_fonte`) REFERENCES `fonte` (`id`);

--
-- Limitadores para a tabela `envelope_impressao`
--
ALTER TABLE `envelope_impressao`
  ADD CONSTRAINT `envelope_impressao_ibfk_1` FOREIGN KEY (`id_convite`) REFERENCES `convite` (`id`),
  ADD CONSTRAINT `envelope_impressao_ibfk_2` FOREIGN KEY (`id_impressao`) REFERENCES `impressao` (`id`);

--
-- Limitadores para a tabela `envelope_papel`
--
ALTER TABLE `envelope_papel`
  ADD CONSTRAINT `envelope_papel_ibfk_1` FOREIGN KEY (`id_convite`) REFERENCES `convite` (`id`),
  ADD CONSTRAINT `envelope_papel_ibfk_2` FOREIGN KEY (`id_papel`) REFERENCES `papel` (`id`);

--
-- Limitadores para a tabela `envelope_servico`
--
ALTER TABLE `envelope_servico`
  ADD CONSTRAINT `envelope_servico_ibfk_1` FOREIGN KEY (`id_convite`) REFERENCES `convite` (`id`),
  ADD CONSTRAINT `envelope_servico_ibfk_2` FOREIGN KEY (`id_servico`) REFERENCES `servico` (`id`);

--
-- Limitadores para a tabela `itens_convite`
--
ALTER TABLE `itens_convite`
  ADD CONSTRAINT `fk_id_convite` FOREIGN KEY (`id_convite`) REFERENCES `convite` (`id`),
  ADD CONSTRAINT `itens_convite_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`);

--
-- Limitadores para a tabela `itens_convite_adendo`
--
ALTER TABLE `itens_convite_adendo`
  ADD CONSTRAINT `itens_convite_adendo_ibfk_1` FOREIGN KEY (`id_adendo`) REFERENCES `adendo` (`id_adendo`),
  ADD CONSTRAINT `itens_convite_adendo_ibfk_2` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`),
  ADD CONSTRAINT `itens_convite_adendo_ibfk_3` FOREIGN KEY (`id_convite`) REFERENCES `convite` (`id`);

--
-- Limitadores para a tabela `itens_convite_orcamento`
--
ALTER TABLE `itens_convite_orcamento`
  ADD CONSTRAINT `itens_convite_orcamento_ibfk_1` FOREIGN KEY (`id_orcamento`) REFERENCES `orcamento` (`id_orcamento`),
  ADD CONSTRAINT `itens_convite_orcamento_ibfk_2` FOREIGN KEY (`id_convite`) REFERENCES `convite` (`id`);

--
-- Limitadores para a tabela `itens_produto`
--
ALTER TABLE `itens_produto`
  ADD CONSTRAINT `fk_id_produto` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`);

--
-- Limitadores para a tabela `orcamento`
--
ALTER TABLE `orcamento`
  ADD CONSTRAINT `orcamento_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id`),
  ADD CONSTRAINT `orcamento_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Limitadores para a tabela `papel`
--
ALTER TABLE `papel`
  ADD CONSTRAINT `papel_ibfk_1` FOREIGN KEY (`categoria_papel_id`) REFERENCES `categoria_papel` (`id`);

--
-- Limitadores para a tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD CONSTRAINT `pessoa_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_produto_categoria_id` FOREIGN KEY (`produto_categoria_id`) REFERENCES `produto_categoria` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

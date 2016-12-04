-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 04-Dez-2016 às 20:56
-- Versão do servidor: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `academia`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `cpf` varchar(50) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `dataNasc` date NOT NULL,
  `genero` char(1) NOT NULL,
  `altura` float NOT NULL,
  `biotipo` varchar(100) NOT NULL,
  `frequenciaSem` int(11) NOT NULL,
  `codigo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`cpf`, `nome`, `dataNasc`, `genero`, `altura`, `biotipo`, `frequenciaSem`, `codigo`) VALUES
('122121231', 'feeffe', '1990-06-28', 'M', 1.8, 'feeffe', 2, '220245'),
('123321', 'fernando', '2016-12-13', 'M', 1.32, 'efefe', 2, '224008'),
('1232132132', 'felipe', '1999-06-28', 'M', 1.8, 'ectomorfo', 4, '613006'),
('1232123', 'aaa', '1980-02-20', 'M', 1.23, 'ectomorfo', 2, '805184'),
('1231233', 'roberta', '1999-02-25', 'F', 1.9, 'ectomorfo', 5, '989508');

-- --------------------------------------------------------

--
-- Estrutura da tabela `exercicio`
--

CREATE TABLE `exercicio` (
  `id` int(11) NOT NULL,
  `nome` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `exerc_treino`
--

CREATE TABLE `exerc_treino` (
  `treino` int(11) NOT NULL,
  `exercicio` int(11) NOT NULL,
  `repeticoes` varchar(100) DEFAULT NULL,
  `carga` varchar(100) DEFAULT NULL,
  `series` varchar(100) DEFAULT NULL,
  `tempo` varchar(100) DEFAULT NULL,
  `equipamento` varchar(100) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `instrutor`
--

CREATE TABLE `instrutor` (
  `login` varchar(255) NOT NULL,
  `senha` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `instrutor`
--

INSERT INTO `instrutor` (`login`, `senha`) VALUES
('felipecechin', '$2a$08$XfgVDvxHrkgONuPcjYC18.l7u7RMLNS6b0V58m.TuqMY4a1rW5V7u');

-- --------------------------------------------------------

--
-- Estrutura da tabela `treino`
--

CREATE TABLE `treino` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `objetivo` varchar(100) DEFAULT NULL,
  `aluno` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `treino`
--

INSERT INTO `treino` (`id`, `nome`, `objetivo`, `aluno`) VALUES
(13, '1', NULL, '805184'),
(14, '2', NULL, '805184');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`codigo`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Indexes for table `exercicio`
--
ALTER TABLE `exercicio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Indexes for table `exerc_treino`
--
ALTER TABLE `exerc_treino`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_treino_has_exercicio_exercicio1_idx` (`exercicio`),
  ADD KEY `fk_treino_has_exercicio_treino1_idx` (`treino`);

--
-- Indexes for table `instrutor`
--
ALTER TABLE `instrutor`
  ADD PRIMARY KEY (`login`);

--
-- Indexes for table `treino`
--
ALTER TABLE `treino`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_treino_aluno_idx` (`aluno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exercicio`
--
ALTER TABLE `exercicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exerc_treino`
--
ALTER TABLE `exerc_treino`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `treino`
--
ALTER TABLE `treino`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `exerc_treino`
--
ALTER TABLE `exerc_treino`
  ADD CONSTRAINT `fk_treino_has_exercicio_exercicio1` FOREIGN KEY (`exercicio`) REFERENCES `exercicio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_treino_has_exercicio_treino1` FOREIGN KEY (`treino`) REFERENCES `treino` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `treino`
--
ALTER TABLE `treino`
  ADD CONSTRAINT `fk_treino_aluno` FOREIGN KEY (`aluno`) REFERENCES `aluno` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

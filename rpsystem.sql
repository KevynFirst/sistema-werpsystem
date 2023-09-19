

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `tipo_pessoa` varchar(20) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `estadual` varchar(150) DEFAULT NULL,
  `social` varchar(150) DEFAULT NULL,
  `telefone` varchar(30) NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `funcionario` varchar(20) NOT NULL,
  `produto` int(11) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `data` date NOT NULL,
  `id_conta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `contas_pagar` (
  `id` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `valor` int(11) NOT NULL,
  `funcionario` varchar(20) NOT NULL,
  `data` date NOT NULL,
  `data_venc` date NOT NULL,
  `pago` varchar(5) NOT NULL,
  `imagem` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `contas_receber` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `adiantamento` decimal(8,2) DEFAULT NULL,
  `cliente` varchar(20) NOT NULL,
  `funcionario` varchar(20) DEFAULT NULL,
  `data` date NOT NULL,
  `pago` varchar(5) NOT NULL,
  `id_servico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `fornecedores` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `tipo_pessoa` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `funcionarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `dtadmissao` varchar(20) NOT NULL,
  `salario` varchar(30) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `movimentacoes` (
  `id` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `funcionario` text NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `orcamentos` (
  `id` int(11) NOT NULL,
  `funcionario` varchar(20) NOT NULL,
  `cliente` varchar(20) NOT NULL,
  `veiculo` int(11) NOT NULL,
  `motorista` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `servico` int(11) NOT NULL,
  `data_aberta` date NOT NULL,
  `data_prazo` date NOT NULL,
  `obs` text NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `orc_prod` (
  `id` int(11) NOT NULL,
  `orcamento` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `qtd` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `os` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `funcionario` varchar(20) NOT NULL,
  `cliente` varchar(20) NOT NULL,
  `data_prazo` date NOT NULL,
  `concluido` varchar(5) DEFAULT NULL,
  `valor_mao_obra` decimal(8,2) NOT NULL,
  `data` date NOT NULL,
  `veiculo` int(11) NOT NULL,
  `obs` text DEFAULT NULL,
  `tipo` varchar(20) NOT NULL,
  `id_orc` int(11) DEFAULT NULL,
  `data_fecha` date DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `categoria` int(11) NOT NULL,
  `fornecedor` int(11) NOT NULL,
  `valor_compra` decimal(8,2) NOT NULL,
  `valor_venda` decimal(8,2) NOT NULL,
  `estoque` int(11) NOT NULL,
  `descricao` text DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `nivel_estoque` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `servicos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `nivel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `vales` (
  `id` int(11) NOT NULL,
  `funcionario` int(11) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `veiculos` (
  `id` int(11) NOT NULL,
  `marca` varchar(30) NOT NULL,
  `modelo` varchar(30) NOT NULL,
  `cor` varchar(30) NOT NULL,
  `placa` varchar(20) NOT NULL,
  `cliente` varchar(20) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `funcionario` varchar(20) NOT NULL,
  `data` date NOT NULL,
  `id_orc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `contas_pagar`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `contas_receber`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `movimentacoes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `orcamentos`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `orc_prod`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `os`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `vales`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `contas_pagar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `contas_receber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `fornecedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `movimentacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `orcamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=387;

ALTER TABLE `orc_prod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `os`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `vales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `veiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

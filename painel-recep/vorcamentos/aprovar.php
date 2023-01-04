<?php 
require_once("../../conexao.php"); 

$id = $_POST['id'];

//BUSCAR O VALOR DO ORÇAMENTO
$query_orc = $pdo->query("SELECT * FROM orcamentos where id = '$id' ");
$res_orc = $query_orc->fetchAll(PDO::FETCH_ASSOC);
$valor_orc = $res_orc[0]['valor'];
$cliente = $res_orc[0]['cliente'];
$funcionario = $res_orc[0]['funcionario'];
$data_prazo = $res_orc[0]['data_prazo'];
$servico = $res_orc[0]['servico'];
$veiculo = $res_orc[0]['veiculo'];
$obs = $res_orc[0]['obs'];

$query = $pdo->query("SELECT * FROM servicos where id = '$servico' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_servico = $res[0]['nome'];

$total_prod = 0;

$query = $pdo->query("SELECT * FROM orc_prod where orcamento = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

if(@count($res) == 0){
$total_pagar = $valor_orc;
}else{

for ($i=0; $i < @count($res); $i++) { 
	foreach ($res[$i] as $key => $value) {
	}
	$prod = $res[$i]['produto'];

	$query_pro = $pdo->query("SELECT * FROM produtos where id = '$prod' ");
	$res_pro = $query_pro->fetchAll(PDO::FETCH_ASSOC);
	$valor_prod = $res_pro[0]['valor_venda'];

	$query2 = $pdo->query("SELECT * FROM orc_prod where produto = '$prod' and  orcamento = '$id'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$qtd = $res2[0]['qtd'];
	$estoque = $res_pro[0]['estoque'] - $qtd;
	
	$valor_prod_qtd = $valor_prod*$qtd;

	@$total_prod = $valor_prod_qtd + @$total_prod;
	$total_pagar = @$total_prod + $valor_orc;


	//ABATER DO ESTOQUE E LANÇAR NA VENDA
	$pdo->query("UPDATE produtos SET estoque = '$estoque' where id = '$prod' ");

	$pdo->query("INSERT INTO vendas SET produto = '$prod', valor = '$valor_prod', funcionario = '$funcionario', data = curDate(), id_orc = '$id' ");



}
}

//INSERIR NA TABELA DE CONTAS A RECEBER
	$pdo->query("INSERT INTO contas_receber SET descricao = 'Orçamento', valor = '$total_pagar', adiantamento = '0', funcionario = '$funcionario', cliente = '$cliente', data = curDate(), pago = 'Não', id_servico = '$id' ");

//INSERIR NA TABELA DE OS
	$pdo->query("INSERT INTO os SET descricao = '$nome_servico', valor = '$total_prod', funcionario = '$funcionario', cliente = '$cliente', data_prazo = '$data_prazo', concluido = 'Não', valor_mao_obra = '$valor_orc', data = curDate(), veiculo = '$veiculo', obs = '$obs', tipo = 'Orçamento', id_orc = '$id' ");


	$pdo->query("UPDATE orcamentos SET status = 'Aprovado' WHERE id = '$id'");

	echo 'Aprovado com Sucesso!';

	?>
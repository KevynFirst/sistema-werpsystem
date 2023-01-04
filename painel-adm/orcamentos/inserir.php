<?php 
require_once("../../conexao.php"); 
@session_start();

$cliente = $_POST['cliente'];
$veiculo = $_POST['veiculo'];
$motorista = $_POST['motorista'];
$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$servico = $_POST['servico'];
$data_prazo = $_POST['data_prazo'];
$obs = $_POST['obs'];

$valor = str_replace(',', '.', $valor);

$id = $_POST['txtid2'];




//VERIFICAR SE O CLIENTE EXISTE
$query = $pdo->query("SELECT * FROM clientes where cpf = '$cliente' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg == 0){
		echo 'O Cliente não está cadastrado ou o CPF está incorreto!';
		exit();
}

if($cliente == ""){
	echo 'O CPF do Cliente é Obrigatório!';
	exit();
}

if($veiculo == ""){
	echo 'Você precisa selecionar um Veiculo';
	exit();
}

if($valor == ""){
	echo 'O Valor é Obrigatório!';
	exit();
}



if($id == ""){
	$res = $pdo->prepare("INSERT INTO orcamentos SET 
							funcionario = '$_SESSION[cpf_usuario]',
							cliente = :cliente, 
							veiculo = :veiculo, 
							motorista = :motorista,
							descricao = :descricao, 
							valor = :valor, 
							servico = :servico, 
							data_aberta = curDate(), 
							data_prazo = :data_prazo, 
							obs = :obs, 
							status = 'Aberto'");	

}else{
	$res = $pdo->prepare("UPDATE orcamentos SET 
							funcionario = '$_SESSION[cpf_usuario]',
							cliente = :cliente, 
							veiculo = :veiculo, 
							motorista = :motorista,
							descricao = :descricao, 
							valor = :valor, 
							servico = :servico,
							data_prazo = :data_prazo, 
							obs = :obs 
							WHERE id = '$id'");
	
}

$res->bindValue(":cliente", $cliente);
$res->bindValue(":veiculo", $veiculo);
$res->bindValue(":motorista", $motorista);
$res->bindValue(":descricao", $descricao);
$res->bindValue(":valor", $valor);
$res->bindValue(":servico", $servico);
$res->bindValue(":data_prazo", $data_prazo);
$res->bindValue(":obs", $obs);

$res->execute();


echo 'Salvo com Sucesso!';

?>
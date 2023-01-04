<?php 
require_once("../../conexao.php"); 
@session_start();

$fornecedor = $_POST['fornecedor'];
$valor_compra = $_POST['valor_compra'];
$valor_venda = $_POST['valor_venda'];
$estoque = $_POST['quantidade'];
$id = $_POST['txtid2'];

$valor_total = $valor_compra * $estoque;

$query = $pdo->query("SELECT * FROM produtos where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$tot_estoque = $res[0]['estoque'];
$estoque = $tot_estoque + $estoque;

if($valor_venda == ""){
	echo 'O Valor da venda é Obrigatório!';
	exit();
}

if($valor_compra == ""){
	echo 'O Valor da compra é Obrigatório!';
	exit();
}

if($estoque == ""){
	echo 'O Estoque é Obrigatório!';
	exit();
}


$res = $pdo->prepare("UPDATE produtos SET 
						fornecedor = :fornecedor, 
						valor_compra = :valor_compra, 
						valor_venda = :valor_venda, 
						estoque = :estoque 
						WHERE id = '$id'");

$res2 = $pdo->prepare("INSERT INTO contas_pagar SET 
						descricao = 'Compra de Produtos', 
						valor = :valor, 
						funcionario = :funcionario, 
						data = curDate(), 
						data_venc = curDate(), 
						pago = 'Não' ");

$res3 = $pdo->prepare("INSERT INTO compras SET 
						produto = '$id', 
						valor = :valor, 
						funcionario = :funcionario, 
						data = curDate(), 
						id_conta = :id_conta ");

$res->bindValue(":fornecedor", $fornecedor);
$res->bindValue(":valor_compra", $valor_compra);
$res->bindValue(":valor_venda", $valor_venda);
$res->bindValue(":estoque", $estoque);
$res2->bindValue(":valor", $valor_total);
$res2->bindValue(":funcionario", $_SESSION['cpf_usuario']);

$res->execute();
$res2->execute();

$id_conta = $pdo->lastInsertId();

$res3->bindValue(":valor", $valor_total);
$res3->bindValue(":funcionario", $_SESSION['cpf_usuario']);
$res3->bindValue(":id_conta", $id_conta);

$res3->execute();

echo 'Salvo com Sucesso!';
?>

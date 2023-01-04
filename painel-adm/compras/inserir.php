<?php 
require_once("../../conexao.php"); 
@session_start();

$funcionario = $_POST['funcionario'];
$valor = $_POST['valor'];
$id = $_POST['txtid2'];



if($valor == ""){
	echo 'O Valor é Obrigatório!';
	exit();
}

if($funcionario == ""){
	echo 'O Funcionário é Obrigatório!';
	exit();
}
if($id = ""){
$res = $pdo->prepare("INSERT INTO vales SET  
						valor = :valor, 
						funcionario = :funcionario, 
						data = curDate()");
}else{
	$res = $pdo->prepare("UPDATE vales SET 
						valor = :valor, 
						funcionario = :funcionario
						WHERE id = '$id'");
}
$res->bindValue(":fornecedor", $funcionario);
$res->bindValue(":valor_compra", $valor);

$res->execute();

echo 'Salvo com Sucesso!';
?>

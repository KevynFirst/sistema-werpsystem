<?php 
require_once("../../conexao.php"); 

$funcionario = $_POST['funcionario'];
$valor = $_POST['valor'];

$id = $_POST['txtid2'];

$valor = str_replace(',', '.', $valor);

if($funcionario == ""){
	echo 'O Funcionario é Obrigatório!';
	exit();
}


if($valor == ""){
	echo 'O Valor é Obrigatório!';
	exit();
}


if($id == ""){
	$res = $pdo->prepare("INSERT INTO vales SET 
							funcionario = :funcionario, 
							valor = :valor, 
							data = curDate() ");

}else{
	$res = $pdo->prepare("UPDATE vales SET 
	funcionario = :funcionario, 
	valor = :valor
	WHERE id = '$id'");

}


$res->bindValue(":funcionario", $funcionario);
$res->bindValue(":valor", $valor);


$res->execute();

echo 'Salvo com Sucesso!';
?>
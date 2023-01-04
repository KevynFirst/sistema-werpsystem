<?php 
require_once("../../conexao.php"); 

$nome = $_POST['nome-cat'];
$id = $_POST['txtid2'];

if($nome == ""){
	echo 'O nome é Obrigatório!';
	exit();
}

//VERIFICAR SE O REGISTRO JÁ EXISTE NO BANCO
if($id == ""){
	$res = $pdo->prepare("INSERT INTO categorias SET nome = :nome");	
}else{
	$res = $pdo->prepare("UPDATE categorias SET nome = :nome WHERE id = '$id'");
		
}

$res->bindValue(":nome", $nome);
$res->execute();

echo 'Salvo com Sucesso!';
?>

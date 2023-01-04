<?php 
require_once("../../conexao.php"); 

$nome = $_POST['nome_reg'];

$antigo = $_POST['antigo'];
$id = $_POST['txtid2'];

if($nome == ""){
	echo 'O nome é Obrigatório!';
	exit();
}



//VERIFICAR SE O REGISTRO JÁ EXISTE NO BANCO
if($antigo != $nome){
	$query = $pdo->query("SELECT * FROM servicos where nome = '$nome' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		echo 'Serviço já está Cadastrado!';
		exit();
	}
}


if($id == ""){
	$res = $pdo->prepare("INSERT INTO servicos SET nome = :nome");	

}else{
	$res = $pdo->prepare("UPDATE servicos SET nome = :nome WHERE id = '$id'");
		
}

$res->bindValue(":nome", $nome);
$res->execute();


echo 'Salvo com Sucesso!';

?>
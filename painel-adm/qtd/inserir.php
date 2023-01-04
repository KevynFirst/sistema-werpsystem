<?php 
require_once("../../conexao.php"); 

$orcamento = $_POST['orcamento'];
$produto = $_POST['produto'];    
$qtd = $_POST['qtd'];

$id = $_POST['txtid2'];


if($id == ""){
	$res = $pdo->prepare("INSERT INTO orc_prod SET orcamento = :orcamento, produto = :produto,  qtd = :qtd");	

}else{
	$res = $pdo->prepare("UPDATE orc_prod SET orcamento = :orcamento, produto = :produto, qtd = :qtd WHERE id = '$id'");
		
}
$res->bindValue(":orcamento", $orcamento);
$res->bindValue(":produto", $produto);
$res->bindValue(":qtd", $qtd);
$res->execute();


echo 'Salvo com Sucesso!';

?>
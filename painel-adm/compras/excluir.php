<?php 
require_once("../../conexao.php"); 

$id = $_POST['id'];

$pdo->query("DELETE FROM compras WHERE id = '$id'");
	
echo 'Excluído com Sucesso!';
?>
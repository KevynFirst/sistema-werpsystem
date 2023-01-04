<?php 
require_once("../../conexao.php"); 

$id = $_POST['id'];
$pdo->query("DELETE FROM produtos WHERE id = '$id'");
echo 'Excluído com Sucesso!';
?>
<?php 
require_once("../../conexao.php"); 

$id = $_POST['id'];

$pdo->query("DELETE FROM veiculos WHERE id = '$id'");

echo 'Excluído com Sucesso!';

?>
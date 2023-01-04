<?php 
require_once("../../conexao.php"); 
@session_start();
$valor = $_POST['valor'];
$id = $_POST['txtid2'];

$pdo->query("UPDATE contas_receber SET adiantamento = '$valor' WHERE id = '$id'");


echo 'Salvo com Sucesso!';

?>
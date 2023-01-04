<?php 
require_once("../../conexao.php"); 

$id = $_POST['id'];


$query = $pdo->query("SELECT * FROM compras where id_conta = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_compra = @$res[0]['id'];


$pdo->query("DELETE FROM compras WHERE id = '$id_compra'");
$pdo->query("DELETE FROM contas_pagar WHERE id = '$id'");

echo 'Excluído com Sucesso!';

?>
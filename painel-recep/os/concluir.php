<?php 
require_once("../../conexao.php"); 

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM os where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$valor_mao_obra = $res[0]['valor_mao_obra'];
$funcionario = $res[0]['funcionario'];
$tipo = $res[0]['tipo'];
$id_orc = $res[0]['id_orc'];

$query2 = $pdo->query("SELECT * FROM produtos where id = '$id' ");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$id_prod = $res[0]['id'];




//CONCLUIR STATUS DO ORÇAMENTO

$pdo->query("UPDATE os SET concluido = 'Sim', data_fecha = curDate() WHERE id = '$id'");

if($tipo == 'Orçamento'){
	$pdo->query("UPDATE orcamentos SET status = 'Concluido' WHERE id = '$id_orc'");
	$pdo->query("DELETE FROM orcamentos WHERE id = '$id_orc'");
	$pdo->query("DELETE FROM orc_prod WHERE orcamento = '$id_orc'");
}


echo 'Concluído com Sucesso!';

?>
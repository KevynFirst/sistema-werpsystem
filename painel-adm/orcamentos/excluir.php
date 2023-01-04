<?php 
require_once("../../conexao.php"); 

$id = $_POST['id'];


//EXCLUIR TAMBÉM OS PRODUTOS RELACIONADOS AO ORÇAMENTO
$query = $pdo->query("SELECT * FROM orc_prod where orcamento = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i=0; $i < @count($res); $i++) { 
	foreach ($res[$i] as $key => $value) {
	}
	$id_orc_prod = $res[$i]['id'];

	$pdo->query("DELETE FROM orc_prod WHERE id = '$id_orc_prod'");
}

$pdo->query("DELETE FROM orcamentos WHERE id = '$id'");

echo 'Excluído com Sucesso!';

?>
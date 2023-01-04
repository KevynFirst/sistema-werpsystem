<?php 
require_once("../../conexao.php"); 

$id = $_POST['id'];

/*
//EXCLUIR SOMENTE SE NÃO TIVER REGISTROS RELACIONADOS
$query_tot = $pdo->query("SELECT * FROM produtos where categoria = '$id'");
$res_tot = $query_tot->fetchAll(PDO::FETCH_ASSOC);
$total_produtos = @count($res_tot);

if($total_produtos == 0){
	$pdo->query("DELETE FROM categorias WHERE id = '$id'");
	echo 'Excluído com Sucesso!';
}else{
	echo 'Você possui produtos relacionados a esta categoria, primeiro exclua os produtos para depois excluir a categoria!';
}

*/

$pdo->query("DELETE FROM servicos WHERE id = '$id'");
	echo 'Excluído com Sucesso!';


?>
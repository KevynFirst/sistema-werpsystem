<?php 
require_once("../../conexao.php"); 

$cpf = $_POST['cpf'];
$veiculo = $_POST['veiculo'];

$query = $pdo->query("SELECT * FROM clientes where cpf = '$cpf'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) == 0){
	echo 'O cliente não existe, CPF/CNPJ Incorreto';
	exit();
}

echo '<select name="veiculo" class="form-control" id="veiculo">';

$query = $pdo->query("SELECT * FROM veiculos where cliente = '$cpf' order by id desc ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i=0; $i < @count($res); $i++) {
	foreach ($res[$i] as $key => $value) {
	}
	$nome_reg = $res[$i]['modelo'] . ' ' . $res[$i]['cor']." [".$res[$i]['placa']."]";
	$id_reg = $res[$i]['id'];
	
	if(@$veiculo == $id_reg){
		$selected = 'selected';
	}else{
		$selected = '';
	}

	echo '<option value=" '.$id_reg. '" '.$selected.'>'.$nome_reg.'</option>';
 } 

echo '</select>';

?>
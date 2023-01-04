<?php 
require_once("../../conexao.php"); 

$nome = $_POST['nome_mec'];
$tipo_pessoa = $_POST['tipo_pessoa'];
$telefone = $_POST['telefone_mec'];
$cpf = $_POST['cpf_mec'];
$cnpj = $_POST['cnpj_mec'];
$email = $_POST['email_mec'];
$endereco = $_POST['endereco_mec'];

$antigo = $_POST['antigo'];
$antigo2 = $_POST['antigo2'];
$id = $_POST['txtid2'];

if($tipo_pessoa != "Física"){
	$cpf = $cnpj;
}

if($nome == ""){
	echo 'O nome é Obrigatório!';
	exit();
}

if($cpf == ""){
	echo $cpf . 'O CPF/CNPJ é Obrigatório!';
	exit();
}


//VERIFICAR SE O REGISTRO JÁ EXISTE NO BANCO
if($antigo != $cpf){
	$query = $pdo->query("SELECT * FROM fornecedores where cpf = '$cpf' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		echo 'O CPF/CNPJ já está Cadastrado!';
		exit();
	}
}


if($id == ""){
	$res = $pdo->prepare("INSERT INTO fornecedores SET nome = :nome, cpf = :cpf, email = :email, endereco = :endereco, telefone = :telefone, tipo_pessoa = :pessoa");	

}else{
	$res = $pdo->prepare("UPDATE fornecedores SET nome = :nome, cpf = :cpf, email = :email, endereco = :endereco, telefone = :telefone, tipo_pessoa = :pessoa WHERE id = '$id'");

}

$res->bindValue(":nome", $nome);
$res->bindValue(":cpf", $cpf);
$res->bindValue(":telefone", $telefone);
$res->bindValue(":email", $email);
$res->bindValue(":endereco", $endereco);
$res->bindValue(":pessoa", $tipo_pessoa);

$res->execute();

echo 'Salvo com Sucesso!';

?>
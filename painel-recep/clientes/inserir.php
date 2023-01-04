<?php 
require_once("../../conexao.php"); 

$nome = $_POST['nome_mec'];
$tipo_pessoa = $_POST['tipo_pessoa'];

$cpf = $_POST['cpf_mec'];
$cnpj = $_POST['cnpj_mec'];

$estadual = $_POST['estadual'];
$social = $_POST['social'];

$telefone = $_POST['telefone_mec'];
$email = $_POST['email_mec'];

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
	$query = $pdo->query("SELECT * FROM clientes where cpf = '$cpf' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		echo 'O CPF/CNPJ já está Cadastrado!';
		exit();
	}
}

if($id == ""){
	$res = $pdo->prepare("INSERT INTO clientes SET 
							nome = :nome, 
							tipo_pessoa = :pessoa,
							cpf = :cpf, 
							estadual = :estadual, 
							social = :social, 
							telefone = :telefone,
							email = :email
							");	

}else{
	$res = $pdo->prepare("UPDATE clientes SET 
							nome = :nome, 
							tipo_pessoa = :pessoa,
							cpf = :cpf, 
							estadual = :estadual, 
							social = :social, 
							telefone = :telefone,
							email = :email
							WHERE id = '$id'
							");

}

$res->bindValue(":nome", $nome);
$res->bindValue(":pessoa", $tipo_pessoa);
$res->bindValue(":cpf", $cpf);

$res->bindValue(":estadual", $estadual);
$res->bindValue(":social", $social);

$res->bindValue(":telefone", $telefone);
$res->bindValue(":email", $email);

$res->execute();

echo 'Salvo com Sucesso!';

?>
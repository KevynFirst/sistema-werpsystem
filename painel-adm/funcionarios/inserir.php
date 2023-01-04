<?php
require_once("../../conexao.php");
@session_start();

$nome = $_POST['nome-func'];
$cpf = $_POST['cpf-func'];
$dtadmissao = $_POST['dtadmissao-func'];
$salario = $_POST['salario-func'];
$telefone = $_POST['telefone-func'];
$endereco = $_POST['endereco-func'];
$email = $_POST['email-func'];

$antigo = $_POST['antigo'];
$antigo2 = $_POST['antigo2'];
$id = $_POST['txtid2'];
	
//Tratamento dos DADOS
if($nome == ""){
	echo 'O NOME é Obrigatório!';
	exit();
}

if($email == ""){
	echo 'O email é Obrigatório!';
	exit();
}

if($cpf == ""){
	echo 'O CPF é Obrigatório!';
	exit();
}

//Verificar Registro JÁ EXISTE NO BANCO
if($antigo != $cpf){
	$query = $pdo->query("SELECT * FROM funcionarios where cpf = '$cpf' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		echo 'O CPF já está Cadastrado!';
		exit();
	} 
}
	
//VERIFICAR SE O REGISTRO COM MESMO EMAIL JÁ EXISTE NO BANCO
if($antigo2 != $email){
	$query = $pdo->query("SELECT * FROM fornecedores where email = '$email' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		echo 'O Email já está Cadastrado!';
		exit();
	}
}

if($id == ""){
	$res = $pdo->prepare("INSERT INTO funcionarios SET 
							nome = :nome, 
							cpf = :cpf,
							dtadmissao = :dtadmissao,
							salario = :salario, 
							telefone = :telefone, 
							endereco = :endereco,
							email = :email");
		
	$res2 = $pdo->prepare("INSERT INTO usuarios SET 
							nome = :nome, 
							cpf = :cpf, 
							email = :email, 
							senha = :senha, 
							nivel = :nivel");
							$res2->bindValue(":senha", '123');
							$res2->bindValue(":nivel", 'funcionario');		

}else{
	$res = $pdo->prepare("UPDATE funcionarios SET 
							nome = :nome, 
							cpf = :cpf, 
							dtadmissao = :dtadmissao, 
							salario = :salario, 
							telefone = :telefone, 
							endereco = :endereco,
							email = :email
							WHERE id = '$id'");

	$res2 = $pdo->prepare("UPDATE usuarios SET 
							nome = :nome, 
							cpf = :cpf, 
							email = :email 
							WHERE cpf = '$antigo'");
}

$res->bindValue(":nome", $nome);
$res->bindValue(":cpf", $cpf);
$res->bindValue(":dtadmissao", $dtadmissao);
$res->bindValue(":salario", $salario);
$res->bindValue(":telefone", $telefone);
$res->bindValue(":endereco", $endereco);
$res->bindValue(":email", $email);

$res2->bindValue(":nome", $nome);
$res2->bindValue(":cpf", $cpf);
$res2->bindValue(":email", $email);

$res->execute();
$res2->execute();

echo 'Salvo com Sucesso!';
?>
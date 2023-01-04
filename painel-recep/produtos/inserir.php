<?php 
require_once("../../conexao.php"); 

$nome = $_POST['nome_reg'];
$categoria = $_POST['categoria'];
$fornecedor = $_POST['fornecedor'];
$valor_compra = $_POST['valor_compra'];
$valor_venda = $_POST['valor_venda'];
$descricao = $_POST['descricao'];
$estoque = $_POST['estoque'];
$nivel_estoque = $_POST['nivel_estoque'];
$antigo = $_POST['antigo'];
$id = $_POST['txtid2'];

$valor_compra = str_replace(',', '.', $valor_compra);
$valor_venda = str_replace(',', '.', $valor_venda);

//SCRIPT PARA SUBIR FOTO NO BANCO
$nome_img = preg_replace('/[ -]+/' , '-' , @$_FILES['imagem']['name']);
$caminho = '../../img/produtos/' .$nome_img;
if (@$_FILES['imagem']['name'] == ""){
  $imagem = "sem-foto.jpg";
}else{
    $imagem = $nome_img;
}

$imagem_temp = @$_FILES['imagem']['tmp_name']; 
$ext = pathinfo($imagem, PATHINFO_EXTENSION);   
if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 
move_uploaded_file($imagem_temp, $caminho);
}else{
	echo 'Extensão de Imagem não permitida!';
	exit();
}


if($nome == ""){
	echo 'O nome é Obrigatório!';
	exit();
}

if($valor_venda == ""){
	echo 'O Valor da venda é Obrigatório!';
	exit();
}

if($valor_compra == ""){
	echo 'O Valor da compra é Obrigatório!';
	exit();
}

if($estoque == ""){
	echo 'O Estoque é Obrigatório!';
	exit();
}

//VERIFICAR SE O REGISTRO JÁ EXISTE NO BANCO
if($antigo != $nome){
	$query = $pdo->query("SELECT * FROM produtos where nome = '$nome' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		echo 'O Produto já está Cadastrado!';
		exit();
	}
}

if($id == ""){
	$res = $pdo->prepare("INSERT INTO produtos SET 
							nome = :nome, 
							categoria = :categoria, 
							fornecedor = :fornecedor, 
							valor_compra = :valor_compra, 
							valor_venda = :valor_venda, 
							estoque = :estoque, 
							nivel_estoque = :nivel_estoque, 
							descricao = :descricao, 
							imagem = :imagem");
	
	$res->bindValue(":imagem", $imagem);
}else{

	if($imagem == "sem-foto.jpg"){
		$res = $pdo->prepare("UPDATE produtos SET 
								nome = :nome, 
								categoria = :categoria, 
								fornecedor = :fornecedor, 
								valor_compra = :valor_compra, 
								valor_venda = :valor_venda, 
								estoque = :estoque, 
								nivel_estoque = :nivel_estoque, 
								descricao = :descricao 
								WHERE id = '$id'");
	}else{
		$res = $pdo->prepare("UPDATE produtos SET 
								nome = :nome, 
								categoria = :categoria, 
								fornecedor = :fornecedor, 
								valor_compra = :valor_compra, 
								valor_venda = :valor_venda, 
								estoque = :estoque, 
								nivel_estoque = :nivel_estoque, 
								descricao = :descricao, 
								imagem = :imagem 
								WHERE id = '$id'");
		$res->bindValue(":imagem", $imagem);
	}
}

$res->bindValue(":nome", $nome);
$res->bindValue(":categoria", $categoria);
$res->bindValue(":fornecedor", $fornecedor);
$res->bindValue(":valor_compra", $valor_compra);
$res->bindValue(":valor_venda", $valor_venda);
$res->bindValue(":estoque", $estoque);
$res->bindValue(":nivel_estoque", $nivel_estoque);
$res->bindValue(":descricao", $descricao);

$res->execute();

echo 'Salvo com Sucesso!';
?>